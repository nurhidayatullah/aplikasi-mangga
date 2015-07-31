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
			<div class="col-lg-3">
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
			<div class="col-lg-9" style="background-color:rgba(255,255,255,0.7);min-height:460px">
					<h3 style="text-align:center">Result</h3><hr/>
					<div id="load"></div>
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