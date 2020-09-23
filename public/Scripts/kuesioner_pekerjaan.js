$(document).ready(function(){
	
	$(document).on("click", "#save", function() {
		console.log('Button Berfungsi');
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		
		var konfirm =  confirm("Anda mungkin memerlukan waktu sesaat untuk menyimpan seluruh data Kuesioner, pastikan koneksi internet Anda tidak terputus selama penyimpanan berlangsung. Apakah Anda akan melanjutan proses penyimpanan?");		
		if(konfirm){
			$.ajax({
				type	: "POST",
				url		: "kuesioner_pekerjaan/remove",
				data 	: {_token:token},
				dataType:"json",			
				success	: function(data){
					if(data.status=='success'){
						var sel = $("select").length;
						if(sel==0){
							savecheck();
						}
						else{
							$("select").each(function(){
								var id = this.id;
								var val = $(this).val();
								if($(this).closest("div.row").css('display')!=='none'){
									if(val =='' ){
										sel--;
										if(sel==0){
											savecheck();
										}
									}else{
										$.ajax({
											type	: "POST",
											url		: "kuesioner_pekerjaan/save",
											data	: {
												id:id,
												sub:encodeURIComponent($("#subvalue"+id).val()),
												_token:token},		
											complete: function(){
												sel--;
												if(sel==0){
													savecheck();
												}
											}
										});
									}
								}else{
									sel--;
									if(sel==0){
										savecheck();
									}
								}
							});
						}
					}	
				}
		});
		}
	});

	function savecheck(){
		var check = $("input[type='radio']:checked").length;
		if(check==0){
			savebox();
		}
		$("input[type='radio']:checked").each(function(){
			var id = encodeURIComponent($(this).val());
			if($(this).closest("div.row").css('display')!=='none'){
				if(id !==''){
					$.ajax({
						type	: "POST",
						url		: "kuesioner_pekerjaan/save",
						data	: {
							id:id,
							sub:encodeURIComponent($("#subvalue"+id).val()),
							_token:token},
						complete: function(){
							check--;
							if(check==0){
								savebox();
							}
						}
					});
				}else{
					check--;
					if(check==0){
						savebox();
					}
				}	
			}	else{
				check--;
				if(check==0){
					savebox();
				}
			}												
		});	
	}

	function savebox(){
		var box = $("input[type='checkbox']:checked").length;
		if(box==0){
			savecomplete();
		}
		$("input[type='checkbox']:checked").each(function(){
			var id = $(this).val();
			if($(this).closest("div.row").css('display')!=='none'){
				if(id !==''){
					$.ajax({
						type	: "POST",
						url		: "kuesioner_pekerjaan/save",
						data	: {
							id:id,
							sub:encodeURIComponent($("#subvalue"+id).val()),
							_token:token},
						complete: function(){
							box--;
							if(box==0){
								savecomplete();
							}
						}
					});
				}else{
					box--;
					if(box==0){
						savecomplete();
					}
				}	
			}else{
				box--;
				if(box==0){
					savecomplete();
				}
			}	
		});
	}

	function savecomplete(){		
		$.ajax({
			type	: "GET",
			url		: "distribusi_alumni/update_status_pekerjaan",
			dataType: "json",			
			success	: function(data){
				alert('Data Kuesioner Berhasil disimpan <br><br> Pastikan Anda tetap mengupdate informasi personal dan jawaban kuesioner Anda');
			},
			failed	: function(data){
				alert("Please check your content");
			}
		});		
	}
});