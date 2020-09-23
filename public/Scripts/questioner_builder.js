$(document).ready(function(){
	var tableKuesioner = $('#table_kuesioner').DataTable( {		
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
			url: 'questioner_builder/getKuesioner',
		},
		columns: [
			{ data: 'kode', name:'kode' },
			{ data: 'nama', name:'nama' },
			{ data: 'kategori', name:'kategori' },
			{ data: 'action', name:'action', orderable:false },
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
	} );

	var tableDistribusi = $('#table_distribusi').DataTable( {		
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
			url: 'questioner_builder/getDistribusi',
		},
		columns: [
			{ data: 'tahun', name:'tahun' },
			{ data: 'perusahaan', name:'perusahaan' },
			{ data: 'pekerjaan', name:'pekerjaan' },
			{ data: 'kompetensi', name:'kompetensi' },
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
			   "targets": 2, // your case first column
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

	var tableKuesionerPS = $('#table_kuesionerPS').DataTable( {		
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
			url: 'questioner_builder/getKuesioner',
		},
		columns: [
			{ data: 'kode', name:'kode' },
			{ data: 'nama', name:'nama' },
			{ data: 'action', name:'action', orderable:false },
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
			   "width": "10%"
		  	}
		],
	} );

	var tableDistribusiPS = $('#table_distribusiPS').DataTable( {		
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
			url: 'questioner_builder/getDistribusi',
		},
		columns: [
			{ data: 'tahun', name:'tahun' },
			{ data: 'kode', name:'kode' },
			{ data: 'action', name:'action', orderable:false },
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
			   "width": "10%"
			}
		],
	} );

	var tablePertanyaan = $('#table_pertanyaan').DataTable( {		
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
				kode_questioner : function ( d ) {
					return $('#pilihKuesioner').val();
				}
			},
			dataType:"json",
			url: 'questioner_builder/getPertanyaan',
		},
		columns: [
			{ data: 'kode', name:'kode' },
			{ data: 'question', name:'question' },
			{ data: 'action', name:'action', orderable:false },
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
			   "width": "10%"
			}
		],
	} );

	$('#addKuesioner').click(function(){
		$(".requiredKuesioner").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	

		$('#idKuesioner').val('');
		$('#kodeKuesioner').val('');
		$('#namaKuesioner').val('');
		$('#pilihKategori').val('');
		$('#modal-kuesioner').modal('show');
	});	
	$(document).on("click", "#editKuesioner", function() {
		$(".requiredKuesioner").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	

		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var aData = tableKuesioner.row($tr).data();
		console.log(aData);

		$('#idKuesioner').val(aData['kode']);
		$('#kodeKuesioner').val(aData['kode']);
		$('#namaKuesioner').val(aData['nama']);
		$('#pilihKategori').val(aData['kategori']);
		$('#modal-kuesioner').modal('show');			
	});
	$(document).on("click", "#saveKuesioner", function() {	
		var num = 0;
		$(".requiredKuesioner").each(function(){
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

		$('#modal-kuesioner').modal('hide');
		$.ajax({
			type	: "POST",
			url		: "questioner_builder/saveKuesioner",
			data	: {
                id : encodeURIComponent($('#idKuesioner').val()),
                kode : encodeURIComponent($('#kodeKuesioner').val()),
                nama : $('#namaKuesioner').val(),
                kategori : $('#pilihKategori').val(),
				_token:encodeURIComponent($('meta[name="csrf-token"]').attr('content'))},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#kodeKuesioner').closest('.form-group').addClass('has-error');
					$('#kodeKuesionermsg').html('Kode Sudah Digunakan');
					$('#modal-kuesioner').modal('show');
					return false;
				}
				if(data.tabel == "tableKuesioner"){
					tableKuesioner.ajax.reload();
				}else{
					tableKuesionerPS.ajax.reload();
				}				
				comboKuesioner();
				comboKPerusahaan();
				comboKPekerjaan();
				comboKKompetensi();
			},
			failed	: function(data){
				alert("Please check your content");
			}
		});		
	});	
	$(document).on("click", "#removeKuesioner", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tableKuesioner.row($tr).data();
		console.log(data);
		
		var konfirm =  confirm("Apakah yakin akan menghapus '"+data.nama+"' ?");		
		if(konfirm){
			token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
			$.ajax({
				type	: "POST",
				url		: "questioner_builder/removeKuesioner",
				data	: {
					kode:data['kode'],
					_token:token},
				dataType: "json",			
				success	: function(data){
					if(data.status == 'duplicate'){
						alert('Gagal menghapus')
					}
					tableKuesioner.ajax.reload();
					comboKuesioner();
					comboKPerusahaan();
					comboKPekerjaan();
					comboKKompetensi();
				},
				error	: function(data){
					alert("Please check your content" + data);
				}
			});
		}
	});


	$('#addDistribusi').click(function(){
		$(".requiredDistribution").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	

		document.getElementById('pilihTahun').removeAttribute('disabled');
		$('#pilihTahun').val('');
		$('#pilihKPerusahaan').val('');
		$('#pilihKPekerjaan').val('');
		$('#pilihKKompetensi').val('');
		$('#modal-distribusi').modal('show');
	});	
	$(document).on("click", "#editDistribusi", function() {
		$(".requiredDistribution").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	

		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var aData = tableDistribusi.row($tr).data();
		console.log(aData);
		select = document.getElementById('pilihTahun');
        option = document.createElement("option");
        option.setAttribute("value",aData['tahun']);
        select.appendChild( option );
        option.appendChild( document.createTextNode(aData['tahun']) );
		$('#pilihTahun').val(aData['tahun']);
		select.setAttribute("disabled","disabled");
		$('#pilihKPerusahaan').val(aData['perusahaan']);
		$('#pilihKPekerjaan').val(aData['pekerjaan']);
		$('#pilihKKompetensi').val(aData['kompetensi']);
		$('#modal-distribusi').modal('show');			
	});
	$(document).on("click", "#saveDistribusi", function() {		
		var num = 0;
		$(".requiredDistribution").each(function(){
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
		
		$('#modal-distribusi').modal('hide');
		$.ajax({
			type	: "POST",
			url		: "questioner_builder/saveDistribusi",
			data	: {
				tahun : encodeURIComponent($('#pilihTahun').val()),
				KPerusahaan : encodeURIComponent($('#pilihKPerusahaan').val()),
				KPekerjaan : encodeURIComponent($('#pilihKPekerjaan').val()),
				KKompetensi : encodeURIComponent($('#pilihKKompetensi').val()),
				KProgramStudi : encodeURIComponent($('#pilihKProgramStudi').val()),
				_token:encodeURIComponent($('meta[name="csrf-token"]').attr('content'))},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#pilihTahun').closest('.form-group').addClass('has-error');
					$('#pilihTahunmsg').html('Kode Sudah Digunakan');
					$('#modal-distribusi').modal('show');
					return false;
				}else{
					if(data.tabel == "tableDistribusi"){
						tableDistribusi.ajax.reload();
					}else{
						tableDistribusiPS.ajax.reload();
					}	
				}
				comboKPerusahaan();
				comboKPekerjaan();
				comboKKompetensi();
				comboKProgramStudi();							
			},
			failed	: function(data){
				alert("Please check your content");
			}
		});				
	});

	$('#addPertanyaan').click(function(){
		$(".requiredPertanyaan").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	

		$.ajax({
			type	: "GET",
			url		: "questioner_builder/getKategori",
			data	: {kuesioner:encodeURIComponent($('#pilihKuesioner').val())},
			dataType:"json",			
			success	: function(data){
				if(data.kategori == 'Pekerjaan'){					
					$('#QuesLevel').val('');
					$('.QuesLevel-form').show();
				}else{
					$('#QuesLevel').val('Wajib');
					$('.QuesLevel-form').hide();
				}
			}
		});	

		var kuesioner = $("#pilihKuesioner").val();	
		if(kuesioner!==''){
			$('#QuesID').val('');
			$('#QuesKode').val('');
			$('#QuesPertanyaan').val('');
			$('#QuesBantuan').val('');
			$('#QuesJenis').val('');
			$('#QuesTableAdd').hide();
			$('#QuesTable tbody').html('');
			$('#modal-pertanyaan').modal('show');
		}else{
			alert('Plih Kuesioner Terlebih Dahulu');	  
		}
	});	
	$(document).on("click", "#editPertanyaan", function() {
		$(".requiredPertanyaan").each(function(){
			$(this).closest('.form-group').removeClass('has-error');
			$('#'+$(this).attr('id')+'msg').html('');
		});	
		

		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var aData = tablePertanyaan.row($tr).data();
		
		$.ajax({
			type	: "GET",
			url		: "questioner_builder/getKategori",
			data	: {kuesioner:encodeURIComponent($('#pilihKuesioner').val())},
			dataType:"json",			
			success	: function(data1){
				if(data1.kategori == 'Pekerjaan'){	
					$('.QuesLevel-form').show();
				}else{
					$('.QuesLevel-form').hide();
				}
				$.ajax({
					type	: "GET",
					url		: "questioner_builder/editPertanyaan",
					data	: {kuesioner:encodeURIComponent($('#pilihKuesioner').val()),
						kode:encodeURIComponent(aData['kode'])
						},
					dataType:"json",			
					success	: function(data){
						$('#QuesID').val(data.id);
						$('#QuesKode').val(aData['kode']);
						$('#QuesLevel').val(data.level);
						$('#QuesPertanyaan').val(aData['question']);
						$('#QuesBantuan').val(data.bantuan);
						$('#QuesJenis').val(data.jenis);
						if(data1.kategori == 'Pekerjaan'){					
							$('#QuesLevel').val(data.level);
						}else{
							$('#QuesLevel').val('Wajib');
						}
						$('#QuesKodemsg').html('');
						$('#QuesTable>tbody').html(data.tabel);
						if(data.jenis=='Radio' || data.jenis=='Checkbox' || data.jenis=='Combobox'){	
							$('#QuesTableAdd').show();
						}else{
							$('#QuesTableAdd').hide();
						}
						$('#modal-pertanyaan').modal('show');
					}
				});	
			}
		});	

		
	});
	$("#QuesJenis").change(function(){
		$('#QuesTable tbody').html('');
		$('#QuesTextJenis').show();
		$('#QuesTableAdd').trigger("click");
		if($("#QuesJenis").val()=='Radio' || $("#QuesJenis").val()=='Checkbox' || $("#QuesJenis").val()=='Combobox'){	
			$('#QuesTableAdd').show();
		}else{
			$('#QuesTableAdd').hide();
		}
	});
	$('#QuesTableAdd').click(function(){
		if($("#QuesJenis").val()=='Radio'){			
			$('<tr>'
			+'<td width="20" class="center"><input class="form-control" type="radio" disabled></input></td>'
			+'<td><input class="form-control" size=25 type="text" id="QuesValue" name="QuesValue"/></td>'
			+'<td><button class="btn btn-block btn-danger btn-xs deleteLink" title="Remove" id="QuesTableDelete"><span class="fa fa-times"></span></button></td>'
			+'<td width="20"></td>'
			+'<td width="40"><input type="text" size="10" id="latbox" placeholder="Opsi Jawaban" disabled/></td>'
			+'<td width="150"><input class="form-control" type="text" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub"/></td>'
			+'<td width="10"></td>'
			+'<td width="120">Tampilkan : </td>'
			+'<td><input class="form-control" size=5 type="text" id="QuesGoto" name="QuesGoto" value=""/></td>'
			+'<td width="120"> Sembunyikan : </td>'
			+'<td><input class="form-control" size=5 type="text" id="QuesSkip" name="QuesSkip" value=""/></td>'
			+'</tr>').appendTo("#QuesTable tbody");
		}
		if($("#QuesJenis").val()=='Combobox'){			
			$('<tr>'
			+'<td><input class="form-control" size=80 type="text" id="QuesValue" name="QuesValue"/></td>'
			+'<td><button class="btn btn-block btn-danger btn-xs deleteLink" title="Remove" id="QuesTableDelete"><span class="fa fa-times"></span></button></td>'
			+'<td width="150"><input type="hidden" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub"/></td>'
			+'<td><input size=5 type="hidden" id="QuesGoto" name="QuesGoto" value=""/></td>'
			+'<td><input size=5 type="hidden" id="QuesSkip" name="QuesSkip" value=""/></td>'
			+'</tr>').appendTo("#QuesTable tbody");
		}
		if($("#QuesJenis").val()=='Checkbox'){			
			$('<tr>'
			+'<td width="20" class="center"><input class="form-control" type="checkbox" disabled></input></td>'
			+'<td><input class="form-control" size=25 type="text" id="QuesValue" name="QuesValue"/></td>'
			+'<td><button class="btn btn-block btn-danger btn-xs  deleteLink" title="Remove" id="QuesTableDelete"><span class="fa fa-times"></button></td>'
			+'<td width="20"></td>'
			+'<td width="40"><input type="text" size="10" placeholder="Opsi Jawaban" disabled/></td>'
			+'<td width="150"><input class="form-control" type="text" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub"/></td>'
			+'<td></td>'
			+'<td></td>'
			+'<td><input type="hidden" id="QuesGoto" name="QuesGoto"/></td>'
			+'<td><input type="hidden" id="QuesSkip" name="QuesSkip"/></td>'
			+'</tr>').appendTo("#QuesTable tbody");
		}
		if($("#QuesJenis").val()=='Text'){			
			$('<tr>'
			+'<td></td>'
			+'<td><input class="form-control" size=50 type="text" id="QuesValue" name="QuesValue"/></td>'
			+'<td width="150"><input class="form-control" type="text" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub"/></td>'
			+'<td><input type="hidden" id="QuesGoto" name="QuesGoto"/></td>'
			+'<td><input type="hidden" id="QuesSkip" name="QuesSkip"/></td>'
			+'</tr>').appendTo("#QuesTable tbody");
		}
		if($("#QuesJenis").val()=='Textarea'){			
			$('<tr>'
			+'<td></td>'
			+'<td><textarea class="form-control" id="QuesValue" name="QuesValue"/></textarea></td>'
			+'<td><input type="hidden" placeholder="Text Keterangan" style="border:none;" id="QuesSub" name="QuesSub"/></td>'
			+'<td><input type="hidden" id="QuesGoto" name="QuesGoto"/></td>'
			+'<td><input type="hidden" id="QuesSkip" name="QuesSkip"/></td>'
			+'</tr>').appendTo("#QuesTable tbody");
		}
	});
	$(document).on("click", ".deleteLink", function() {	
		var tr = $(this).closest('tr');
		tr.css("background-color","#FF3700");

		tr.fadeOut(400, function(){
			tr.remove();
		});
		return false;
	});	
	$(document).on("click", "#savePertanyaan", function() {		
		var num = 0;
		$(".requiredPertanyaan").each(function(){
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
		
		$('#modal-pertanyaan').modal('hide');
		$.ajax({
			type	: "POST",
			url		: "questioner_builder/savePertanyaan",
			data: {
				id : encodeURIComponent($('#QuesID').val()),
				kuesioner : encodeURIComponent($('#pilihKuesioner').val()),
				kode : encodeURIComponent($('#QuesKode').val()),
				pertanyaan : $('#QuesPertanyaan').val(),
				help : $('#QuesBantuan').val(),
				level : $('#QuesLevel').val(),
				jenis : encodeURIComponent($('#QuesJenis').val()),
				_token:encodeURIComponent($('meta[name="csrf-token"]').attr('content'))},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#QuesKode').closest('.form-group').addClass('has-error');
					$('#QuesKodemsg').html('Kode Sudah Digunakan');
					$('#modal-pertanyaan').modal('show');
					return false;
				}else{
					var nomor = 0;
					$("#QuesTable>tbody>tr").each(function(){		
						$.ajax({
							type	: "POST",
							url		: "questioner_builder/savePertanyaanDetails",
							data	: {
								kuesioner : encodeURIComponent($('#pilihKuesioner').val()),
								kode : encodeURIComponent($('#QuesKode').val()),
								type : encodeURIComponent($('#QuesJenis').val()),
								nomor : encodeURIComponent(nomor),
								optionvalue : $(this).find('input[name=QuesValue]').val(),
								suboption : $(this).find('input[name=QuesSub]').val(),
								goto : $(this).find('input[name=QuesGoto]').val(),
								skip : $(this).find('input[name=QuesSkip]').val(),
								_token:encodeURIComponent($('meta[name="csrf-token"]').attr('content'))},
							dataType:"json",			
							success	: function(data){
							}
						});
						nomor = nomor+1;
					});	
					tablePertanyaan.ajax.reload();	
				}	
			},
			failed	: function(data){
				alert("Please check your content");
			}
		});
	});
	$(document).on("click", "#removePertanyaan", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var data = tablePertanyaan.row($tr).data();
		console.log(data);
		
		var konfirm =  confirm("Apakah yakin akan menghapus pertanyaan '"+data.kode+"' ?");		
		if(konfirm){
			token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
			$.ajax({
				type	: "POST",
				url		: "questioner_builder/removePertanyaan",
				data	: {
					kode:data['kode'],
					_token:token},
				dataType: "json",			
				success	: function(data){
					if(data.status == 'duplicate'){
						alert('Gagal menghapus')
					}
					tablePertanyaan.ajax.reload();
					//$("#loading-time").hide();
				},
				error	: function(data){
					alert("Please check your content" + data);
				}
			});
		}
	});

	comboKuesioner();
	comboTahun();			
	comboKPerusahaan();
	comboKPekerjaan();
	comboKKompetensi();
	function comboKuesioner(){
		$.ajax({
			type	: "GET",
			url		: "questioner_builder/comboKuesioner",	
			success	: function(data){
				$("#pilihKuesioner").html(data.option);			
			}
		});
	}	
	$("#pilihKuesioner").change(function(){
		tablePertanyaan.ajax.reload();
	});
	function comboTahun(){
		$.ajax({
			type	: "GET",
			url		: "questioner_builder/comboTahun",	
			success	: function(data){
				$("#pilihTahun").html(data.option);			
			}
		});
	}
	function comboKPerusahaan(){
		$.ajax({
			type	: "GET",
			url		: "questioner_builder/comboKPerusahaan",	
			success	: function(data){
				$("#pilihKPerusahaan").html(data.option);			
			}
		});
	}
	function comboKPekerjaan(){
		$.ajax({
			type	: "GET",
			url		: "questioner_builder/comboKPekerjaan",	
			success	: function(data){
				$("#pilihKPekerjaan").html(data.option);			
			}
		});
	}
	function comboKKompetensi(){
		$.ajax({
			type	: "GET",
			url		: "questioner_builder/comboKKompetensi",	
			success	: function(data){
				$("#pilihKKompetensi").html(data.option);			
			}
		});
	}
	function comboKProgramStudi(){
		$.ajax({
			type	: "GET",
			url		: "questioner_builder/comboKProgramStudi",	
			success	: function(data){
				$("#pilihKProgramStudi").html(data.option);			
			}
		});
	}

});