$(document).ready(function(){
	var tableFakultas = $('#table_fakultas').DataTable( {		
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
			url: 'master_data/getFakultas',
		},
		columns: [
			{ data: 'urutan', name:'urutan' },
			{ data: 'kode', name:'kode' },
			{ data: 'nama', name:'nama' },
			{ data: 'active', name:'active' },
			{ data: 'action', name:'action', orderable:false },
		],
		columnDefs : [
			{
				"targets": 0, // your case first column
				"className": "text-center",
				"width": "4%"
		   	},
		   	{
			   "targets": 1, // your case first column
			   "className": "text-center",
			   "width": "15%"
		  	},
		   	{
			   "targets": 3, // your case first column
			   "className": "text-center",
			   "width": "10%"
		  	},
		   	{
			   "targets": 4, // your case first column
			   "className": "text-center",
			   "width": "10%"
		  	}
		],
	} );

	$('#addFak').click(function(){
		$(".requiredFak").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});			
		$('#idFak').val('');
		$('#namaFak').val('');
		$('#urutFak').val('');
		$('#modalFak').modal('show');
	});	
	$(document).on("click", "#editFak", function() {
		$(".requiredFak").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableFakultas.row($tr).data();
		console.log(data);

		$('#urutFak').val(data['urutan']);
		$('#idFak').val(data['kode']);
		$('#namaFak').val(data['nama']);
		$('#modal-fakultas').modal('show');
	});	
	$(document).on("click", "#removeFak", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableFakultas.row($tr).data();
		console.log(data);

		$('#kode').val(data['kode']);
		$('#kategori').val('Fakultas');
		$('#modal-remove').modal('show');
	});	
    $(document).on("click", "#saveFak", function() {		
		var num = 0;
		$(".requiredFak").each(function(){
			if($(this).val().length == 0){	
				$(this).closest('.form-group').addClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('Tidak Boleh Dikosongkan');
				num= num+1;					
			}else{
				$(this).closest('.form-group').removeClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('');
			}			
		});	
		if (num > 0){
			return false;	
        }
		$('#modal-fakultas').modal('hide');      
		id = encodeURIComponent($('#idFak').val());
		nama = $('#namaFak').val();
		urut = encodeURIComponent($('#urutFak').val())
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "master_data/saveFakultas",
			data	: {
				id:id,
				nama:nama,
				urut:urut,
				_token:token},
			dataType: "json",			
			success	: function(data){
		    	if(data.status=="duplicate"){
			    	$('#namaFak').closest('.form-group').addClass('has-error');
					$('#namaFakmsg').html('Nama Fakultas Sudah Digunakan');
					$("#loading-time").hide();
					$('#modalProdi').modal('show');
					return false;
				}
				tableFakultas.ajax.reload();
				comboFakultas();
				//$("#loading-time").hide();
			},
			error	: function(data){
			    alert("Please check your content");
			}
		});
	});
	$(document).on("click", "#konfirmRemove", function() {	
		$('#modal-remove').modal('hide');      
		kode = encodeURIComponent($('#kode').val());
		kategori = encodeURIComponent($('#kategori').val())
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "master_data/hapusData",
			data	: {
				kode:kode,
				kategori:kategori,
				_token:token},
			dataType: "json",			
			success	: function(data){
				if(data.status == 'duplicate'){
					alert('Tidak dapat menghapus karena '+kategori+' sedang digunakan')
				}
				if(kategori=='Fakultas'){
					tableFakultas.ajax.reload();
				}
				if(kategori=="Jurusan"){
					tableJurusan.ajax.reload();
				}
				if(kategori=='Prodi'){
					tableProdi.ajax.url('master_data/getProdi').load();
				}
				
				comboFakultas();
				//$("#loading-time").hide();
			},
			error	: function(data){
			    alert("Please check your content" + data);
			}
		});
	});
	$(document).on("click", "#activeFak", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableFakultas.row($tr).data();
		console.log(data);
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		//$("#loading-time").show();
		$.ajax({
			type	: "POST",
			url		: "master_data/activeFakultas",
			data	: {
				kode:data['kode'],
				_token:token},
			dataType:"json",			
			success	: function(data){
				tableFakultas.ajax.reload();
				comboFakultas();
				//$("#loading-time").hide();
			}
		});
	});
	
	comboFakultas();
	function comboFakultas(){
		$.ajax({
			type	: "GET",
			url		: "master_data/comboFakultas",	
			success	: function(data){
				$("#pilihFakultas").html(data.option);
				$("#fakJur").html(data.option);
				$("#fakProdi").html(data.option);				
			}
		});
	}
	var tableJurusan = $('#table_jurusan').DataTable( {		
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
			type	: "GET",
			data	: {
				fak : function ( d ) {
					return $('#pilihFakultas').val();
				}
			},
			dataType:"json",
			url: 'master_data/getJurusan',
		},
		columns: [
			{ data: 'urutan', name:'urutan' },
			{ data: 'kode', name:'kode' },
			{ data: 'nama', name:'nama' },
			{ data: 'active', name:'active' },
			{ data: 'action', name:'action', orderable:false },
		],
		columnDefs : [
			{
				"targets": 0, // your case first column
				"className": "text-center",
				"width": "4%"
		   	},
		   	{
			   "targets": 1, // your case first column
			   "className": "text-center",
			   "width": "15%"
		  	},
		   	{
			   "targets": 3, // your case first column
			   "className": "text-center",
			   "width": "10%"
		  	},
		   	{
			   "targets": 4, // your case first column
			   "className": "text-center",
			   "width": "10%"
		  	}
		],
	} );
	$("#pilihFakultas").change(function(){
		tableJurusan.ajax.reload();
		tableProdi.ajax.url('master_data/getProdiClear').load();
		comboJurusan();
	});
	$('#addJur').click(function(){
		if($('#pilihFakultas').val() != ''){
			$(".requiredJur").each(function(){
				$(this).closest('.form-group').removeClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('');
			});	
			$('#idJur').val('');
			$('#fakJur').val($("#pilihFakultas").val());
			$('#fakJur').prop('disabled', true);
			$('#namaJur').val('');
			$('#urutJur').val('');
			//$("#loading-time").hide();
			$('#modal-jurusan').modal('show');
		}else{
			alert('bootstrap dialog blm aktif');
			BootstrapDialog.show({
				title: '<i class="fas fa-warning-sign"></i> Warning',
				message: 'Pilih Kode Fakultas Terlebih Dahulu',
				buttons: [{
        		label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
					}
				}]
			});
		}
	});
	$(document).on("click", "#editJur", function() {
		$(".requiredJur").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableJurusan.row($tr).data();
		console.log(data);

		$('#urutJur').val(data['urutan']);
		$('#idJur').val(data['kode']);
		$('#namaJur').val(data['nama']);
		$('#fakJur').val($("#pilihFakultas").val());
		$('#fakJur').prop('disabled', true);
		$('#modal-jurusan').modal('show');
	});	
	$(document).on("click", "#removeJur", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableJurusan.row($tr).data();
		console.log(data);

		$('#kode').val(data['kode']);
		$('#kategori').val('Jurusan');
		$('#modal-remove').modal('show');
	});	
	$(document).on("click", "#saveJur", function() {	
		if($("#fakJur").val()==""){
			$("#fakJurmsg").html("Pilih Fakultas Terlebih Dahulu");
			return false;
		}
		
		var num = 0;
		$(".requiredJur").each(function(){
			if($(this).val().length == 0)
	   		{	
				$(this).closest('.form-group').addClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('Tidak Boleh Dikosongkan');				
				num= num+1;					
			}else{
				$(this).closest('.form-group').removeClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('');
			}			
		});	
		if (num > 0){
			return false;	
		}		
		$('#modal-jurusan').modal('hide');
		id = encodeURIComponent($('#idJur').val());
		fak = encodeURIComponent($('#fakJur').val());
		nama = $('#namaJur').val();
		urut = encodeURIComponent($('#urutJur').val())
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		//$("#loading-time").show();
		$.ajax({
			type	: "POST",
			url		: "master_data/saveJurusan",
			data	: {
				id:id,
				nama:nama,
				fak:fak,
				urut:urut,
				_token:token},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#namaJur').closest('.form-group').addClass('has-error');
					$('#namaJurmsg').html('Nama Jurusan Sudah Digunakan');
					//$("#loading-time").hide();
					$('#modal-jurusan').modal('show');
					return false;
				}
				tableJurusan.ajax.reload();
				comboJurusan();
				//$("#loading-time").hide();
			},
			failed	: function(data){
				alert("Please check your content");
			}
		});		
	});		
	$(document).on("click", "#activeJur", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableJurusan.row($tr).data();
		console.log(data);
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		//$("#loading-time").show();
		$.ajax({
			type	: "POST",
			url		: "master_data/activeJurusan",
			data	: {
				kode:data['kode'],
				_token:token},
			dataType:"json",			
			success	: function(data){
				tableJurusan.ajax.reload();
				comboJurusan();
				//$("#loading-time").hide();
			}
		});
	});

	comboJurusan();
	function comboJurusan(){
		$.ajax({
			type	: "GET",
			url		: "master_data/comboJurusan",	
			data	: {fak:$('#pilihFakultas').val()},
			success	: function(data){
				$("#pilihJurusan").html(data.option);	
				$("#jurProdi").html(data.option);		
			}
		});
	}
	var tableProdi = $('#table_prodi').DataTable( {		
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
			type	: "GET",
			data	: {
				jur : function ( d ) {
					return $('#pilihJurusan').val();
				}
			},
			dataType:"json",
			url: 'master_data/getProdi',
		},
		columns: [
			{ data: 'urutan', name:'urutan' },
			{ data: 'kode', name:'kode' },
			{ data: 'nama', name:'nama' },
			{ data: 'active', name:'active' },
			{ data: 'action', name:'action', orderable:false },
		],
		columnDefs : [
			{
				"targets": 0, // your case first column
				"className": "text-center",
				"width": "4%"
		   	},
		   	{
			   "targets": 1, // your case first column
			   "className": "text-center",
			   "width": "15%"
		  	},
		   	{
			   "targets": 3, // your case first column
			   "className": "text-center",
			   "width": "10%"
		  	},
		   	{
			   "targets": 4, // your case first column
			   "className": "text-center",
			   "width": "10%"
		  	}
		],
	} );
	$("#pilihJurusan").change(function(){
		tableProdi.ajax.url('master_data/getProdi').load();
	});
	$('#addProdi').click(function(){
		if($('#pilihJurusan').val() != ''){
			$(".requiredProdi").each(function(){
				$(this).closest('.form-group').removeClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('');
			});	
			$('#idProdi').val('');
			$('#fakProdi').val($("#pilihFakultas").val());
			$('#jurProdi').val($("#pilihJurusan").val());
			$('#fakProdi').prop('disabled', true);
			$('#jurProdi').prop('disabled', true);
			$('#namaProdi').val('');
			$('#urutProdi').val('');
			//$("#loading-time").hide();
			$('#modal-prodi').modal('show');
		}else{
			alert('bootstrap dialog blm aktif');
			BootstrapDialog.show({
				title: '<i class="fas fa-warning-sign"></i> Warning',
				message: 'Pilih Kode Fakultas Terlebih Dahulu',
				buttons: [{
        		label: 'Close',
				action: function(dialogItself){
					dialogItself.close();
					}
				}]
			});
		}
	});
	$(document).on("click", "#editProdi", function() {
		$(".requiredProdi").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableProdi.row($tr).data();
		console.log(data);

		$('#urutProdi').val(data['urutan']);
		$('#idProdi').val(data['kode']);
		$('#namaProdi').val(data['nama']);
		$('#fakProdi').val($("#pilihFakultas").val());
		$('#jurProdi').val($("#pilihJurusan").val());
		$('#fakProdi').prop('disabled', true);
		$('#jurProdi').prop('disabled', true);
		$('#modal-prodi').modal('show');
	});	
	$(document).on("click", "#removeProdi", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableProdi.row($tr).data();
		console.log(data);

		$('#kode').val(data['kode']);
		$('#kategori').val('Prodi');
		$('#modal-remove').modal('show');
	});	
	$(document).on("click", "#saveProdi", function() {	
		if($("#fakProdi").val()==""){
			$("#fakProdimsg").html("Pilih Fakultas Terlebih Dahulu");
			return false;
		}
		if($("#jurProdi").val()==""){
			$("#jurProdimsg").html("Pilih Jurusan Terlebih Dahulu");
			return false;
		}
		
		var num = 0;
		$(".requiredProdi").each(function(){
			if($(this).val().length == 0)
	   		{	
				$(this).closest('.form-group').addClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('Tidak Boleh Dikosongkan');				
				num= num+1;					
			}else{
				$(this).closest('.form-group').removeClass('has-error');
				$('#'+$(this).attr('id')+'msg').html('');
			}			
		});	
		if (num > 0){
			return false;	
		}		
		$('#modal-prodi').modal('hide');
		id = encodeURIComponent($('#idProdi').val());
		fak = encodeURIComponent($('#fakProdi').val());
		jur = encodeURIComponent($('#jurProdi').val());
		nama = $('#namaProdi').val();
		urut = encodeURIComponent($('#urutProdi').val());
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "master_data/saveProdi",
			data	: {
				id:id,
				nama:nama,
				fak:fak,
				jur:jur,
				urut:urut,
				_token:token},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#namaProdi').closest('.form-group').addClass('has-error');
					$('#namaProdimsg').html('Nama Prodi Sudah Digunakan');
					$('#modal-prodi').modal('show');
					return false;
				}
				tableProdi.ajax.url('master_data/getProdi').load();
			},
			failed	: function(data){
				alert("Please check your content");
			}
		});		
	});	
	$(document).on("click", "#activeProdi", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableProdi.row($tr).data();
		console.log(data);
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "master_data/activeProdi",
			data	: {
				kode:data['kode'],
				_token:token},
			dataType:"json",			
			success	: function(data){
				tableProdi.ajax.url('master_data/getProdi').load();
			}
		});
	});
});