	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>Group</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('admin/admin');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Group</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">New Data Group</div>
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
											<a href="<?php echo base_url('admin/user/index/'.$menu);?>" class="btn btn-danger">Cancel <i class="fa fa-mail-reply"></i></a>
										</div>
									</div>
								</div>
							</div>
							<form class="" method="post" role="form" action="<?php echo base_url('admin/user/save/');?>">
								<div class="form-group">
									<label for="first_name">First Name
									<input class="form-control" type="text" name="first_name" required />
									<input type="hidden" name="menu" value="<?php echo $menu;?>" required />
								</div>
								<div class="form-group">
									<label for="last_name">Last Name
									<input class="form-control" type="text" name="last_name" required />
								</div>
								<div class="form-group">
									<label for="email">Email
									<input class="form-control" type="email" name="email" required />
								</div>
								<div class="form-group">
									<label for="last_name">Group
									<select class="form-control" name="group">
									<?php if(!empty($group)){
										foreach($group as $data){ ?>
										<option value="<?php echo $data['kode_group'];?>"><?php echo $data['nama_group'];?></option>
										<?php }
									}?>
									</select>
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
</body>
</html>