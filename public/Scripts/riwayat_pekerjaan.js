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
			url: 'riwayat_pekerjaan/getData',
		},
		columns: [
			{ data: 'tahun', name:'tahun' },
			{ data: 'perusahaan', name:'perusahaan' },
			{ data: 'posisi', name:'posisi' },
			{ data: 'action', name:'action', orderable:false },
			{ data: 'id', name:'id', visible:false },
			{ data: 'nama_atasan', name:'nama_atasan', visible:false },
			{ data: 'telp_atasan', name:'telp_atasan', visible:false },
			{ data: 'email_atasan', name:'email_atasan', visible:false },
		],
		columnDefs : [
			{
				"targets": 0, // your case first column
				"className": "text-center",
				"width": "10%"
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
	} );

	$('#add').click(function(){
		$(".required").each(function(){
			$(this).closest('.form-group').removeClass('valid-msg');
			$('#'+$(this).attr('id')+'msg').html('');
		});			
        $('#id').val('');
        $('#tahun').val('');
        $('#perusahaan').val('');
        $('#posisi').val('');
        $('#nama').val('');
        $('#telp').val('');
        $('#email').val('');
        $('#emailold').val('');
		$('#modal-pekerjaan').modal('show');
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
		var dataPekerjaan = tableDaftar.row($tr).data();
		console.log(dataPekerjaan);

        $('#id').val(dataPekerjaan.id);
		$('#tahun').val(dataPekerjaan.tahun);
		$('#perusahaan').val(dataPekerjaan.perusahaan);
		$('#posisi').val(dataPekerjaan.posisi);
		$('#nama').val(dataPekerjaan.nama_atasan);
		$('#telp').val(dataPekerjaan.telp_atasan);
		$('#email').val(dataPekerjaan.email_atasan);
		$('#emailold').val(dataPekerjaan.email);
		$('#modal-pekerjaan').modal('show');
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
		$('#modal-pekerjaan').modal('hide');

        id = encodeURIComponent($('#id').val());
		tahun = $('#tahun').val();
		perusahaan = $('#perusahaan').val();
		posisi = $('#posisi').val();
		nama = $('#nama').val();
		telp = $('#telp').val();
		email = $('#email').val();
		emailold = $('#emailold').val();
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "riwayat_pekerjaan/save",
			data	: {
				id:id,
				tahun:tahun,
				perusahaan:perusahaan,
				posisi:posisi,
				nama:nama,
				telp:telp,
				email:email,
				emailold:emailold,
				_token:token},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#modal-pekerjaan').modal('show');
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
		
		var konfirm =  confirm("Apakah yakin akan menghapus '"+data.perusahaan+"' ?");		
		if(konfirm){
			token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
			$.ajax({
				type	: "POST",
				url		: "riwayat_pekerjaan/remove",
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