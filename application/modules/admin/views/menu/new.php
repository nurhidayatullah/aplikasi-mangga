
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>Menu</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('admin/admin');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Menu</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">New Data Menu</div>
							<div class="tools">
								<a href="javascript:;" class="fullscreen">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a href="<?php echo base_url('admin/menu/index/'.$url);?>" class="btn btn-danger">Cancel <i class="fa fa-mail-reply"></i></a>
										</div>
									</div>
								</div>
							</div>
							<form class="" method="post" role="form" action="<?php echo base_url('admin/menu/save/');?>">
								<div class="form-group">
									<label for="nama">Nama Menu
									<input class="form-control" type="text" name="nama" required />
									<input type="hidden" name="url" value="<?php echo $url;?>" required />
								</div>
								<div class="form-group">
									<label for="nama">Controller
									<input class="form-control" type="text" name="controller"/>
								</div>
								<div class="form-group">
									<label for="child">Child Menu
									<input class="form-control" type="checkbox" name="child" id="child" />
								</div>
								<div class="form-group" id="parent">
									<label for="parent">Parent
									<select class="form-control" name="parent">
									<?php foreach($menu as $data){?>
										<option value="<?php echo $data['kode_menu'];?>"><?php echo $data['nama_menu'];?></option>
									<?php }?>
									</select>
								</div>
								</hr>
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
$(function(){
	$('#parent').hide();
	$('#child').click(function(){
		var value = $('#child:checked').val()?1:0;
		if(value==1){
			$('#parent').show();
		}else{
			$('#parent').hide();
		}
	});
});
</script>
</body>
</html>