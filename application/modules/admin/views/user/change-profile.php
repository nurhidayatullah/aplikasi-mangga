<?php 
foreach($user as $data){
	$first = $data['first_name'];
	$last = $data['last_name'];
	$email = $data['email'];
}	
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>Change Profile</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('admin/admin');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Change Profile</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">Change User Profile</div>
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
											<a href="<?php echo base_url('admin/admin');?>" class="btn btn-danger">Cancel <i class="fa fa-mail-reply"></i></a>
										</div>
									</div>
								</div>
							</div>
							<?php if(!empty($msg)){ ?>
							<div class="alert alert-danger">
								<button class="close" data-close="alert"></button>
								<?php echo $this->my_encrypt->decode($msg);?>
							</div>
							<?php } ?>
							<form class="" method="post" role="form" action="<?php echo base_url('admin/user/update_profile/');?>">
								<div class="form-group">
									<label for="first_name">First Name
									<input class="form-control" type="text" name="first_name" value="<?php echo $first;?>"required />
								</div>
								<div class="form-group">
									<label for="last_name">Last Name
									<input class="form-control" type="text" name="last_name" value="<?php echo $last;?>" required />
								</div>
								<div class="form-group">
									<label for="email">Email
									<input class="form-control" type="email" name="email"value="<?php echo $email;?>" required />
								</div>
								<div class="form-group">
									<label for="old-password">Old Password
									<input class="form-control" type="password" name="old-password" required />
								</div>
								<div class="form-group">
									<label for="new-password">New Password
									<input class="form-control" type="password" name="new-password" required />
								</div>
								<div class="form-group">
									<label for="re-new">Rewrite New Password
									<input class="form-control" type="password" name="re-new" required />
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