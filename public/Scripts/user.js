$(document).ready(function(){

    var tableUser = $('#table_user').DataTable( {		
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
			url: 'user/getUser',
		},
		columns: [
			{ data: 'id', name:'id' },
			{ data: 'nama_fak', name:'nama_fak' },
			{ data: 'nama_jur', name:'nama_jur' },
			{ data: 'nama_prodi', name:'nama_prodi' },
			{ data: 'access', name:'access' },
			{ data: 'action', name:'action', orderable:false },
			{ data: 'fak', name:'fak' },
			{ data: 'jur', name:'jur' },
			{ data: 'prodi', name:'prodi' },
		],
		columnDefs : [
			{
				"targets": 1, // your case first column
				"className": "text-center"
		   	},
		   	{
			    "targets": 2, // your case first column
			    "className": "text-center"
		  	},
		   	{
			    "targets": 3, // your case first column
			    "className": "text-center"
		  	},
            {
                "targets": 4, // your case first column
                "className": "text-center"
            },
		   	{
			    "targets": 5, // your case first column
			    "className": "text-center",
			    "width": "7%"
		  	},
			{
			   	"targets": 6, // your case first column
			   	"visible": false,
                "searchable": false
			},
			{
			   	"targets": 7, // your case first column
			   	"visible": false,
                "searchable": false
			}	,
			{
			   	"targets": 8, // your case first column
			   	"visible": false,
                "searchable": false
			}			   
		],
	} );

    $('#addUser').click(function(){
		$(".required").each(function(){
			$(this).closest('.form-group').removeClass('valid-msg');
			$('#'+$(this).attr('id')+'msg').html('');
		});			
        $('#id').val('');
        $('#idlama').val('');
		$('#password').val('');
		$('#repassword').val('');
		$('#pilihLevel').val('');
		$('#pilihFakultas').val('0');
        $('#pilihJurusan').val('0');
        $('#pilihJurusan').prop('disabled', true);
        $('#pilihProdi').val('0');
        $('#pilihProdi').prop('disabled', true);
		$('#modal-add').modal('show');
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
		var dataUser = tableUser.row($tr).data();
		console.log(dataUser);

        $.ajax({
			type	: "GET",
			url		: "user/comboJurusan",	
			data	: {fak:dataUser['fak']},
			success	: function(data){
				$("#pilihJurusan").html(data.option);

				$.ajax({
					type	: "GET",
					url		: "user/comboProdi",	
					data	: {jur:dataUser['jur']},
					success	: function(data){
						$("#pilihProdi").html(data.option);	
						
						$('#pilihJurusan').val(dataUser['jur']);
						$('#pilihProdi').val(dataUser['prodi']);
						$('#pilihJurusan').prop('disabled', false);
						$('#pilihProdi').prop('disabled', false);
					}
				});	
			}
        });
        
        
        $('#idlama').val(dataUser['id']);
        $('#id').val(dataUser['id']);
		$('#password').val('********');
		$('#repassword').val('********');
		$('#pilihLevel').val(dataUser['access']);
		$('#pilihFakultas').val(dataUser['fak']);
		$('#modal-add').modal('show');
	});		
	$(document).on("click", "#save", function() {	
		var num = 0;
		$(".required").each(function(){
			if($(this).val().length == 0)
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
		$('#modal-add').modal('hide');
        id = $('#id').val();
		idlama = $('#idlama').val();
		fak = encodeURIComponent($('#pilihFakultas').val());
		jur = encodeURIComponent($('#pilihJurusan').val());
		prodi = encodeURIComponent($('#pilihProdi').val());
		access = $('#pilihLevel').val();
		password = encodeURIComponent($('#password').val());
		repassword = encodeURIComponent($('#repassword').val());
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "user/save",
			data	: {
                id:id,
                idlama:idlama,
				fak:fak,
				jur:jur,
				prodi:prodi,
				access:access,
				password:password,
				repassword:repassword,
				_token:token},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#id').closest('.form-group').addClass('has-error');
					$('#idmsg').html('Username Sudah Digunakan');
					$('#modal-add').modal('show');
					return false;
				}
				tableUser.ajax.reload();
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
		var data = tableUser.row($tr).data();
		console.log(data);

		$('#id').val(data['id']);
		$('#modal-remove').modal('show');
	});	
	$(document).on("click", "#konfirmRemove", function() {	
		$('#modal-remove').modal('hide');      
		id = $('#id').val();
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "user/hapusData",
			data	: {
				id:id,
				_token:token},
			dataType: "json",			
			success	: function(data){
				if(data.status == 'duplicate'){
					alert('Gagal menghapus')
				}
				tableUser.ajax.reload();
				//$("#loading-time").hide();
			},
			error	: function(data){
			    alert("Please check your content" + data);
			}
		});
	});
    
    $("#pilihFakultas").change(function(){
		$('#pilihJurusan').prop('disabled', false);
		$.ajax({
			type	: "GET",
			url		: "user/comboJurusan",	
			data	: {fak:$('#pilihFakultas').val()},
			success	: function(data){
				$("#pilihJurusan").html(data.option);	
			}
		});
		$('#pilihProdi').prop('disabled', true);
		$("#pilihProdi").html('<option value="0">Semua Program Studi</option>');	
    });
    $("#pilihJurusan").change(function(){
        $('#pilihProdi').prop('disabled', false);
		$.ajax({
			type	: "GET",
			url		: "user/comboProdi",	
			data	: {jur:$('#pilihJurusan').val()},
			success	: function(data){
				$("#pilihProdi").html(data.option);	
			}
		});
    });

        
});