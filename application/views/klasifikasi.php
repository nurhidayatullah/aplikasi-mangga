<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
<div class="main">
	<div class="container">
		<div class="row" style="margin-top:10px;margin-bottom:10px">
		<div class="page-slider">
			<div class="fullwidthbanner-container revolution-slider">
				<div class="fullwidthabnner2">
					<ul id="revolutionul">
						<li data-transition="fade" data-slotamount="1" data-masterspeed="700" data-delay="9400" data-thumb="<?php echo $this->config->item('theme_url');?>frontend/pages/img/revolutionslider/thumbs/thumb2.jpg">
							
							<div class="caption col-lg-3 lft"
							data-speed="400"
							data-start="1500"
							data-easing="easeOutExpo">
								<div class="panel"style="background-color:rgba(255,255,255,0)">
									<div class="panel-body" style="background-color:rgba(255,255,255,0.6);min-height:460px;">
										<div class="col-lg-12" style="background-color:rgba(255,255,255,0);min-height:300px;">
											<img src="<?=base_url()?>/assets/img/up.jpg" id="foto" class="img-responsive"><br/>
										</div>
										<div class="col-lg-12"><hr/>
											<form id="upload">
												<div class="form-group">
													<span class="btn btn-warning btn-block btn-file">
														Browse Image <input id="gambar" class="btn" type="file" name="userfile" onchange="return preview_gambar();"/>
													</span>
												</div>
												<button type="button" onClick='return upload_gambar()' class="btn btn-success btn-block">Upload</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							
						  <div class="col-lg-9 caption lfb"
							data-x="270" 
							data-speed="700" 
							data-start="1000" 
							data-easing="easeOutExpo">
							<div class="col-lg-12" style="background-color:rgba(255,255,255,0.7);min-height:460px">
								<div id="load"></div>
								<div class="row">
								<?php
								if($data){
								?>&nbsp;
								<div class="col-lg-12">
									<div class="alert alert-info" role="alert">
										<div class="row">
											<div class="col-lg-12"><h4 style="text-align:center"><strong>Hasil</h4></strong><hr/></div>
											<div class="col-lg-3">
												<img src="<?=base_url()?>/assets/mangga/<?php echo $data['foto'];?>" id="foto" class="img-responsive">
											</div>
											<div class="col-lg-9">
												<table class="table">
													<tr>
														<td>Jenis Mangga</td>
														<td><?php echo $data['nama_mangga'];?></td>
													</tr>
													<tr>
														<td>Keterangan</td>
														<td><?php echo $data['keterangan'];?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<a href="<?php echo base_url('classification/detail/'.$id);?>" class="btn blue pull-right"> Detail <i class="m-icon-swapright m-icon-white"></i></a>
								</div>
								<?php
								}else{
								?><hr/>
								<div class="col-lg-12">
									<div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
									  <div class="col-md-4 col-sm-4 front-step-col">
										<div class="front-step front-step1">
										  <h2>Pilih Citra Daun</h2>
										  <p> Klik tombol Browse Image untuk memilih<br/> citra daun mangga</p>
										</div>
									  </div>
									  <div class="col-md-4 col-sm-4 front-step-col">
										<div class="front-step front-step2">
										  <h2>Upload</h2>
										  <p>Klik tombol upload untuk mengunggah foto<br/> dan tunggu beberapa saat.</p>
										</div>
									  </div>
									  <div class="col-md-4 col-sm-4 front-step-col">
										<div class="front-step front-step3">
										  <h2>Hasil</h2>
										  <p>Sistem akan menampilkan hasil analisanya<br/> untuk anda.</p>
										</div>
									  </div>
									</div>
									<div class="alert alert-info" role="alert">
										<h4> Note :</h4><hr/>
										<p><i class="m-icon-swapright"></i>&nbsp;Citra hanya berisi daun mangga.</p>
										<p><i class="m-icon-swapright"></i>&nbsp;Satu citra berisi satu jenis daun mangga.</p>
										<p><i class="m-icon-swapright"></i>&nbsp;Jenis citra berextensi .jpg.</p>
									</div>
								</div>
								<?php
								}
								?>
								</div>
							</div>
						  </div>
						</li> 
					</ul>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
	var vektor;
	$(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo base_url();?>classification/get_vektor",
			success:function(result){
				vektor = JSON.parse(result);
				console.log(vektor);
			}
		});
	});
	function preview_gambar(){
		var reader = new FileReader();
		reader.readAsDataURL(document.getElementById("gambar").files[0]);
		reader.onload = function(oFREvent){
			document.getElementById('foto').src = oFREvent.target.result;
		};
	}
	function upload_gambar(){
		var form = new FormData(document.getElementById('upload'));
		var file = document.getElementById('gambar').files[0];
		form.append('userfile',file);
		$('#load').html("Uploading...<img src='<?php echo base_url()?>/assets/img/gloader.gif' />");
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>classification/upload",
			data:form,cache:false,
			contentType:false,processData:false,
			success:function(data){
				var arr = JSON.parse(data);
				if(arr['status'] == 0){
					$('#load').html(arr['pesan']);
				}else{
					$('#load').html("Get Data...<img src='<?php echo base_url()?>/assets/img/gloader.gif' />");
					$.ajax({
						type:"POST",data:{dt:data},dataType:"json",
						url:"<?php echo base_url();?>file_upload/get_data/",
						success:function(data2){
							$('#load').html("Calculate Data...<img src='<?php echo base_url()?>/assets/img/gloader.gif' />");
							 $.ajax({
								type:"POST",data:{dta:data2,vektor:vektor},dataType:"json",
								url:"<?php echo base_url();?>classification/calculate",
								success:function(response){
									window.location.assign("<?php echo base_url();?>classification/index/"+response);
								}
							});
							$('#load').html("<div class='alert alert-success'><button class='close' data-dismiss='alert'>x</button><strong>Upload Success...!!</strong></div>");
						}
					});
				}
			}
		}); 
	}
</script>