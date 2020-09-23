$(document).ready(function(){
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
			url: 'distribusi/getListDistribusi',
		},
		columns: [
			{ data: 'name', name:'name' },
			{ data: 'nama_jur', name:'nama_jur' },
			{ data: 'nama_prodi', name:'nama_prodi' },
			{ data: 'angkatan', name:'angkatan' },
			{ data: 'jumlah_alumni', name:'jumlah_alumni' },
			{ data: 'jumlah_mengisi', name:'jumlah_mengisi' },
			{ data: 'action', name:'action', orderable:false },
		],
		columnDefs : [
			{
				"targets": 0, // your case first column
				"className": "text-center",
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
				"className": "text-center",
                "searchable": false,
				"width": "8%"
			},	   
		],
		select: {
			style:    'multi',
			selector: 'td:first-child'
		},
		order : [[ 0, 'asc' ]],
	} );
	var tableAlumniFree = $('#table_alumni_free').DataTable( {		
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
			url: Url.table,
		},
		columns: [
			{ data: null, orderable:false },
			{ data: 'npm', name:'npm' },
			{ data: 'name', name:'name' },
			{ data: 'nama_jur', name:'nama_jur' },
			{ data: 'nama_prodi', name:'nama_prodi' },
			{ data: 'wisuda', name:'wisuda' }
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
		  	}  
		],
		select: {
			style:    'multi',
			selector: 'td:first-child'
		},
		order : [[ 1, 'asc' ]],
	} );
	var tableAlumniSurveyor = $('#table_alumni_surveyor').DataTable( {		
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
				npm_surveyor : function ( d ) {
					return $('#npm_surveyor').val();
				}
			},
			dataType:"json",
			url: Url.table,
		},
		columns: [
			{ data: null, orderable:false },
			{ data: 'npm', name:'npm' },
			{ data: 'name', name:'name' },
			{ data: 'nama_jur', name:'nama_jur' },
			{ data: 'nama_prodi', name:'nama_prodi' },
			{ data: 'wisuda', name:'wisuda' },
			{ data: 'status', name:'status' }
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
			}  
		],
		select: {
			style:    'multi',
			selector: 'td:first-child'
		},
		order : [[ 1, 'asc' ]],
	} );
	

	$("#pilihFakultas").change(function(){
		tableDistribusi.ajax.reload();
		tableAlumniFree.ajax.reload();		
		tableAlumniSurveyor.ajax.reload();
		comboJurusan();
		$("#pilihProdi").html('<option value="%">Pilih Program Studi</option>');
	});
	comboJurusan();
	function comboJurusan(){
		$.ajax({
			type	: "GET",
			url		: Url.combo.jurusan,	
			data	: {fak:$('#pilihFakultas').val()},
			success	: function(data){
				$("#pilihJurusan").html(data.option);		
			}
		});
	}
	$("#pilihJurusan").change(function(){
		tableDistribusi.ajax.reload();
		tableAlumniFree.ajax.reload();
		tableAlumniSurveyor.ajax.reload();
		comboProdi();
	});
	comboProdi();
	function comboProdi(){
		$.ajax({
			type	: "GET",
			url		: Url.combo.prodi,
			data	: {jur:$('#pilihJurusan').val()},
			success	: function(data){
				$("#pilihProdi").html(data.option);			
			}
		});
	}
	$("#pilihProdi").change(function(){
		tableDistribusi.ajax.reload();
		tableAlumniFree.ajax.reload();
		tableAlumniSurveyor.ajax.reload();
	});

	$(document).on("click", "#add", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var idTable = tableDistribusi.row($tr).id();
		window.location.href = 'distribusi_alumni/add/'+idTable;
	});	
	$(document).on("click", "#edit", function() {
		$tr = $(this).closest('tr');
		if($($tr).hasClass('child')){
			$tr = $tr.prev('.parent');
		}
		var idTable = tableDistribusi.row($tr).id();
		window.location.href = 'distribusi_alumni/edit/'+idTable;
	});	

	
	$('#addCheck').click( function () {
		var arrNPM = new Array();
		arrNPM = tableAlumniFree.rows({ selected: true }).ids().toArray();
		var i = 0;

		var nodeP = document.createElement("p");
		var nodePLama = document.getElementById("modal-text");
		var text = document.createTextNode('Apakah anda yakin akan menambah '+arrNPM.length+' data ?');
		nodeP.appendChild(text);
		nodeP.setAttribute('id','modal-text');
		document.getElementById("modal-body").replaceChild(nodeP,nodePLama);

		$('#modal-add-select').modal('show');
	});		
	$(document).on("click", "#konfirmAddSelect", function() {	
		$('#modal-add-select').modal('hide');      
		var arrNPM = new Array();
		arrNPM = tableAlumniFree.rows({ selected: true }).ids().toArray();
		var i = 0;
		
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: Url.post.addSelect,
			data	: {
				id:JSON.stringify(arrNPM),
				npm_surveyor:$('#npm_surveyor').val(),
				_token:token},
			dataType: "json",			
			success	: function(data){
				if(data.status == 'duplicate'){
					alert('Gagal menambahkan')
				}
				location.reload();
			},
			error	: function(data){
			    alert("Please check your content" + data);
			}
		});
	});
	$('#removeCheck').click( function () {
		var arrNPM = new Array();
		arrNPM = tableAlumniSurveyor.rows({ selected: true }).ids().toArray();
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
		arrNPM = tableAlumniSurveyor.rows({ selected: true }).ids().toArray();
		var i = 0;
		
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		$.ajax({
			type	: "POST",
			url		: Url.post.removeSelect,
			data	: {
				id:JSON.stringify(arrNPM),
				_token:token},
			dataType: "json",			
			success	: function(data){
				if(data.status == 'duplicate'){
					alert('Gagal menghapus')
				}
				location.reload();
			},
			error	: function(data){
			    alert("Please check your content" + data);
			}
		});
	});

});