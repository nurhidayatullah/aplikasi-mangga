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
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>Data Latih</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('admin/admin');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Data Latih</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">New Data Latih</div>
							<div class="tools">
								<a href="javascript:;" class="fullscreen">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
							<div class="row">
								<div class="col-md-1">
									<div class="btn-group">
										<a href="<?php echo base_url('mangga/data_latih/index/'.$menu);?>" class="btn btn-danger">Back</a>
									</div>
								</div>
								<div class="col-md-6">
									<div id="load"></div>
								</div>
							</div>
							</div>
							<div class="row container">
								<div class="col-md-11">
									<form class="form form-horizontal" id="upload">
										<div class="form-group">
											<img src="<?=base_url()?>/assets/img/up.jpg" id="foto" width="100px">
										</div>
										<div class="form-group">
											<span class="btn btn-default btn-file">
												Browse Image <input id="gambar" class="btn" type="file" name="userfile" onchange="return preview_gambar();"/>
											</span>
										</div>
										<div class="form-group">
											<label>Jenis Mangga
											<select class="form-control" name="jenis" required>
											<?php foreach($mangga as $data){?>
												<option value="<?php echo $data['kode_mangga'];?>"><?php echo $data['nama_mangga'];?></option>
											<?php } ?>
											</select>
										</div>
										<button type="button" onClick='return upload_gambar()' class="btn btn-success">Upload</button>
									</form>
								</div>
								<div class="col-md-11"></br>
									<div class="panel panel-success">
										<div class="panel-heading">
											<h3 class="panel-title">Demo Notes</h3>
										</div>
										<div class="panel-body">
											<ul>
												<li>
													 Citra hanya berisi daun mangga.
												</li>
												<li>
													 Satu citra berisi satu jenis daun mangga.
												</li>
												<li>
													 Jenis citra berextensi .jpg.
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
		</div>
	</div>
</div>
<script>
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
			url:"<?php echo base_url();?>file_upload/upload",
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
							$('#load').html("Saving Data...<img src='<?php echo base_url()?>/assets/img/gloader.gif' />");
							$.ajax({
								type:"POST",data:{dta:data2},dataType:"json",
								url:"<?php echo base_url();?>mangga/data_latih/save",
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
<?php $this->load->view('admin/footer');?>
