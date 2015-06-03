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
			Dashboard <small>Mangga</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('admin/admin');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Mangga</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">New Data Mangga</div>
							<div class="tools">
								<a href="javascript:;" class="fullscreen">
								</a>
							</div>
						</div>
						<div class="portlet-body">
						<?php if(!empty($msg)){?>
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<strong>Error</strong><?php echo $msg;?>
							</div>
						<?php } ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a href="<?php echo base_url('mangga/mangga/index/'.$menu);?>" class="btn btn-danger">Cancel <i class="fa fa-mail-reply"></i></a>
										</div>
									</div>
								</div>
							</div>
							<form class="" method="post" role="form" action="<?php echo base_url('mangga/mangga/save/');?>" enctype="multipart/form-data">
								<div class="form-group">
									<label for="nama">Nama Mangga
									<input class="form-control" type="text" name="nama" required />
									<input type="hidden" name="menu" value="<?php echo $menu;?>" required />
								</div>
								<div class="form-group">
									<label for="biner">Biner
									<select class="form-control" name="biner">
									<?php if(!empty($biner)){
										foreach($biner as $data){ ?>
										<option value="<?php echo $data;?>"><?php echo $data;?></option>
										<?php }
									}?>
									</select>
								</div>
								<div class="form-group">
								<label for="foto">Foto
									<div class='controls'>
										<img src="<?=base_url()?>/assets/img/up.jpg" id="gambar" width="100px">
										<span class="btn btn-default btn-file">
											Browse Image <input id="foto" class="btn" type="file" name="foto" onchange="return preview_gambar();"/>
										</span>
									</div>
								</div>
								<div class="form-group">
								  <button type="submit" class="btn btn-success">Submit <i class="fa fa-download"></i></button>
								</div>
							</form>
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
<?php $this->load->view('admin/footer');?>
<script>
	function preview_gambar(){
		var reader = new FileReader();
		reader.readAsDataURL(document.getElementById("foto").files[0]);
		reader.onload = function(oFREvent){
			document.getElementById('gambar').src = oFREvent.target.result;
		};
	}
</script>
</body>
</html>