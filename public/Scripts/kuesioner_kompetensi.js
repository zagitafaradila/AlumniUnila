$(document).ready(function(){
	
	$(document).on("click", "#save", function() {
		console.log('Button Berfungsi');
		token = encodeURIComponent($('meta[name="csrf-token"]').attr('content'));
		
		var konfirm =  confirm("Anda mungkin memerlukan waktu sesaat untuk menyimpan seluruh data Kuesioner, pastikan koneksi internet Anda tidak terputus selama penyimpanan berlangsung. Apakah Anda akan melanjutan proses penyimpanan?");		
		if(konfirm){
			$.ajax({
				type	: "POST",
				url		: "kuesioner_kompetensi/remove",
				data 	: {_token:token},
				dataType:"json",			
				success	: function(data){
					if(data.status=='success'){
						var check = $("input[type='radio']:checked").length;
						$("input[type='radio']:checked").each(function(){
							var id = $(this).val();
							if($(this).closest("div.row").css('display')!=='none'){
								if(id !==''){
								$.ajax({
									type	: "POST",
									url		: "kuesioner_kompetensi/save",
									data	: {id:id,
										_token:token},
									complete: function(){
										check--;
										if(check == 0){ 
											savecomplete();	
										}
									}
								});
							}else{
								check=check-1;
							}	
						}else{
							check=check-1;
						}
					});	
				}	
			}
		});
		}
	});

	function savecomplete(){		
		$.ajax({
			type	: "GET",
			url		: "distribusi_alumni/update_status_kompetensi",
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