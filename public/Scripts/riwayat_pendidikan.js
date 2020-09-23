$(document).ready(function(){
	var tableDaftar = $('#table_daftar').DataTable( {		
		paging: true,
		lengthChange: false,
		searching: false,
		ordering: true,
		info: true,
		autoWidth: false,
		responsive: true,
		
		processing:true,
		serverSide:true,
		ajax: {
			url: 'riwayat_pendidikan/getData',
		},
		columns: [
			{ data: 'jenjang', name:'jenjang', orderable:false },
			{ data: 'school', name:'school' },
			{ data: 'tahun', name:'tahun' },
			{ data: 'action', name:'action', orderable:false },
			{ data: 'id', name:'id', visible: false },
		],
		columnDefs : [
			{
				"targets": 0, // your case first column
				"className": "text-center",
				"width": "4%"
		   	},
		   	{
			   "targets": 2, // your case first column
			   "className": "text-center",
			   "width": "15%"
		  	},
		   	{
			   "targets": 3, // your case first column
			   "className": "text-center",
			   "width": "10%"
		  	}
		],
		order : [[ 2, 'asc' ]],
	} );

	$('#add').click(function(){
		$(".required").each(function(){
			$(this).closest('.form-group').removeClass('valid-msg');
			$('#'+$(this).attr('id')+'msg').html('');
		});			
        $('#id').val('');
        $('#jenjang').val('');
        $('#school').val('');
        $('#tahun').val('');
		$('#modal-pendidikan').modal('show');
	});	
    $(document).on("click", "#edit", function() {
		$(".required").each(function(){
			$(this).closest('.form-group').removeClass('valid-msg');
			$('#'+$(this).attr('id')+'msg').html('');
		});	
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var dataPendidikan = tableDaftar.row($tr).data();
		console.log(dataPendidikan);

        $('#id').val(dataPendidikan['id']);
        $('#jenjang').val(dataPendidikan['jenjang']);
		$('#tahun').val(dataPendidikan['tahun']);		
		$('#school').val(dataPendidikan['school']);
		$('#modal-pendidikan').modal('show');
	});	
	$(document).on("click", "#save", function() {	
		var num = 0;
		$(".required").each(function(){
			if($(this).val().length == 0 || $(this).val() == '0')
	   		{	
				$(this).closest('.form-group').addClass('valid-msg');
				$('#'+$(this).attr('id')+'msg').html('Tidak Boleh Dikosongkan');				
				num= num+1;					
			}else{
				$(this).closest('.form-group').removeClass('valid-msg');
				$('#'+$(this).attr('id')+'msg').html('');
			}			
		});	
		if (num > 0){
			return false;	
		}		
		$('#modal-pendidikan').modal('hide');
        id = encodeURIComponent($('#id').val());
		jenjang = $('#jenjang').val();
		school = $('#school').val();
		tahun = $('#tahun').val();
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "riwayat_pendidikan/save",
			data	: {
                id:id,
                jenjang:jenjang,
				school:school,
				tahun:tahun,
				_token:token},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#modal-pendidikan').modal('show');
					return false;
				}
				tableDaftar.ajax.reload();
			},
			failed	: function(data){
				alert("Please check your content");
			}
		});		
	});		
	$(document).on("click", "#remove", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableDaftar.row($tr).data();
		console.log(data);
		
		var konfirm =  confirm("Apakah yakin akan menghapus '"+data.school+"' ?");		
		if(konfirm){
			token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
			$.ajax({
				type	: "POST",
				url		: "riwayat_pendidikan/remove",
				data	: {
					id:data['id'],
					_token:token},
				dataType: "json",			
				success	: function(data){
					if(data.status == 'duplicate'){
						alert('Gagal menghapus')
					}
					tableDaftar.ajax.reload();
					//$("#loading-time").hide();
				},
				error	: function(data){
					alert("Please check your content" + data);
				}
			});
		}
	});
});