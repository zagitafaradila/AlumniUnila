$(document).ready(function(){
	var tableMahasiswa = $('#table_user').DataTable( {		
		paging: true,
		lengthChange: false,
		searching: false,
		ordering: true,
		info: true,
		autoWidth: false,
		responsive: true,
		
		processing:true,
		serverSide:true,
		rowId: 'npm',
		ajax: {
			type	: "GET",
			data	: {
				fak : function ( d ) {
					return $('#pilihFakultas').val();
				},
				jur : function ( d ) {
					return $('#pilihJurusan').val();
				},
				prodi : function ( d ) {
					return $('#pilihProdi').val();
				}
			},
			dataType:"json",
			url: 'mahasiswa/getMahasiswa',
		},
		columns: [
			{ data: null, orderable:false },
			{ data: 'npm', name:'npm' },
			{ data: 'name', name:'name' },
			{ data: 'nama_jur', name:'nama_jur' },
			{ data: 'nama_prodi', name:'nama_prodi' },
			{ data: 'angkatan', name:'angkatan' },
			{ data: 'telp', name:'telp' },
			{ data: 'action', name:'action', orderable:false },
			{ data: 'fak', name:'fak', visible: false },
			{ data: 'jur', name:'jur', visible: false },
			{ data: 'prodi', name:'prodi', visible: false },
			{ data: 'birthday', name:'birthday', visible: false },
		],
		columnDefs : [
			{
				"targets": 0, // your case first column
				"className": "text-center",
				"width": "4%",
				'checkboxes': {
					'selectRow': true
				}
		   	},
			{
				"targets": 1, // your case first column
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
			    "className": "text-center"
		  	},
			{
				"targets": 6, // your case first column
				"className": "text-center"
			},
			{
				"targets": 7, // your case first column
				"className": "text-center",
				"width": "8%"
			},
			{
			   	"targets": 8, // your case first column
                "searchable": false
			},
			{
			   	"targets": 9, // your case first column
                "searchable": false
			},
			{
			   	"targets": 10, // your case first column
                "searchable": false
			},
			{
			   	"targets": 11, // your case first column
                "searchable": false
			}			   
		],
		select: {
			style:    'multi',
			selector: 'td:first-child'
		},
		order : [[ 1, 'asc' ]],
	} );
	$('#select_all').click(function(){
		if ($('#select_all:checked').val() === 'on')
			tableMahasiswa.rows().select();
		else
			tableMahasiswa.rows().deselect();
	});	

	$('#add').click(function(){
		$(".required").each(function(){
			$(this).closest('.form-group').removeClass('valid-msg');
			$('#'+$(this).attr('id')+'msg').html('');
		});			
        $('#npm').val('');
        $('#npmLama').val('');
		$('#nama').val('');		
		$('#birthday').val('');
		$('#pilihFakultasModal').val('0');
		$('#pilihJurusanModal').val('0');
        $('#pilihJurusanModal').prop('disabled', true);
        $('#pilihProdiModal').val('0');
        $('#pilihProdiModal').prop('disabled', true);
		$('#angkatan').val('');
		$('#telp').val('');
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
		var dataMahasiswa = tableMahasiswa.row($tr).data();
		console.log(dataMahasiswa);

        $.ajax({
			type	: "GET",
			url		: "mahasiswa/comboJurusanModal",	
			data	: {fak:dataMahasiswa['fak']},
			success	: function(data){
				$("#pilihJurusanModal").html(data.option);

				$.ajax({
					type	: "GET",
					url		: "mahasiswa/comboProdiModal",	
					data	: {jur:dataMahasiswa['jur']},
					success	: function(data){
						$("#pilihProdiModal").html(data.option);	
						
						$('#pilihJurusanModal').val(dataMahasiswa['jur']);
						$('#pilihProdiModal').val(dataMahasiswa['prodi']);
						$('#pilihJurusanModal').prop('disabled', false);
						$('#pilihProdiModal').prop('disabled', false);
					}
				});	
			}
		});       
        $('#npm').val(dataMahasiswa['npm']);
        $('#npmLama').val(dataMahasiswa['npm']);
		$('#nama').val(dataMahasiswa['name']);		
		$('#birthday').val(dataMahasiswa['birthday']);
		$('#pilihFakultasModal').val(dataMahasiswa['fak']);
		$('#angkatan').val(dataMahasiswa['angkatan']);
		$('#telp').val(dataMahasiswa['telp']);
		$('#modal-add').modal('show');
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
		$('#modal-add').modal('hide');
        npm = encodeURIComponent($('#npm').val());
		npmLama = encodeURIComponent($('#npmLama').val());
		nama = $('#nama').val();
		fak = encodeURIComponent($('#pilihFakultasModal').val());
		jur = encodeURIComponent($('#pilihJurusanModal').val());
		prodi = encodeURIComponent($('#pilihProdiModal').val());
		birthday = encodeURIComponent($('#birthday').val());
		angkatan = encodeURIComponent($('#angkatan').val());
		telp = encodeURIComponent($('#telp').val());
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "mahasiswa/save",
			data	: {
                npm:npm,
                npmLama:npmLama,
				nama:nama,
				fak:fak,
				jur:jur,
				prodi:prodi,
				birthday:birthday,
				angkatan:angkatan,
				telp:telp,
				_token:token},
			dataType:"json",			
			success	: function(data){
				if(data.status=="duplicate"){
					$('#npm').closest('.form-group').addClass('has-error');
					$('#npmmsg').html('NPM Sudah Digunakan');
					$('#modal-add').modal('show');
					return false;
				}
				tableMahasiswa.ajax.reload();
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
		var data = tableMahasiswa.row($tr).data();
		console.log(data);

		$('#npm').val(data['npm']);
		$('#modal-remove').modal('show');
	});	
	$(document).on("click", "#konfirmRemove", function() {	
		$('#modal-remove').modal('hide');      
		npm = $('#npm').val();
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "mahasiswa/hapusData",
			data	: {
				npm:npm,
				_token:token},
			dataType: "json",			
			success	: function(data){
				if(data.status == 'duplicate'){
					alert('Gagal menghapus')
				}
				tableMahasiswa.ajax.reload();
				//$("#loading-time").hide();
			},
			error	: function(data){
			    alert("Please check your content" + data);
			}
		});
	});
	$('#removeCheck').click( function () {
		var arrNPM = new Array();
		arrNPM = tableMahasiswa.rows({ selected: true }).ids().toArray();
		var i = 0;

		var nodeP = document.createElement("p");
		var nodePLama = document.getElementById("modal-text");
		var text = document.createTextNode('Apakah anda yakin akan menghapus '+arrNPM.length+' data ?');
		nodeP.appendChild(text);
		nodeP.setAttribute('id','modal-text');
		document.getElementById("modal-body").replaceChild(nodeP,nodePLama);

		$('#modal-remove-select').modal('show');
	});		
	$(document).on("click", "#konfirmRemoveSelect", function() {	
		$('#modal-remove-select').modal('hide');      
		var arrNPM = new Array();
		arrNPM = tableMahasiswa.rows({ selected: true }).ids().toArray();
		var i = 0;
		
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: "mahasiswa/hapusDataSelect",
			data	: {
				id:JSON.stringify(arrNPM),
				_token:token},
			dataType: "json",			
			success	: function(data){
				if(data.status == 'duplicate'){
					alert('Gagal menghapus')
				}
				tableMahasiswa.ajax.reload();
				tableMahasiswa.rows().deselect();
			},
			error	: function(data){
			    alert("Please check your content" + data);
			}
		});
	});
	
	
	function comboJurusanModal(){
		$.ajax({
			type	: "GET",
			url		: "mahasiswa/comboJurusanModal",	
			data	: {fak:$('#pilihFakultasModal').val()},
			success	: function(data){
				$("#pilihJurusanModal").html(data.option);		
			}
		});
	}
	function comboProdiModal(){
		$.ajax({
			type	: "GET",
			url		: "mahasiswa/comboProdiModal",	
			data	: {jur:$('#pilihJurusanModal').val()},
			success	: function(data){
				$("#pilihProdiModal").html(data.option);			
			}
		});
	}
	$("#pilihFakultasModal").change(function(){
		$('#pilihJurusanModal').prop('disabled', false);
		$('#pilihProdiModal').prop('disabled', true);
		comboJurusanModal();
		comboProdiModal();
	});
	$("#pilihJurusanModal").change(function(){
		$('#pilihProdiModal').prop('disabled', false);
		comboProdiModal();
	});


	$("#pilihFakultas").change(function(){
		tableMahasiswa.ajax.reload();
		comboJurusan();
		$("#pilihProdi").html('<option value="%">Pilih Program Studi</option>');
	});
	comboJurusan();
	function comboJurusan(){
		$.ajax({
			type	: "GET",
			url		: "mahasiswa/comboJurusan",	
			data	: {fak:$('#pilihFakultas').val()},
			success	: function(data){
				$("#pilihJurusan").html(data.option);		
			}
		});
	}
	$("#pilihJurusan").change(function(){
		tableMahasiswa.ajax.reload();
		comboProdi();
	});
	comboProdi();
	function comboProdi(){
		$.ajax({
			type	: "GET",
			url		: "mahasiswa/comboProdi",	
			data	: {jur:$('#pilihJurusan').val()},
			success	: function(data){
				$("#pilihProdi").html(data.option);			
			}
		});
	}
	$("#pilihProdi").change(function(){
		tableMahasiswa.ajax.reload();
	});
});