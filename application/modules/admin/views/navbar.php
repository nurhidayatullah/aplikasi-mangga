<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<div class="page-logo">
			<a href="<?php echo base_url('admin/admin');?>">
			<!--<img src="<?php echo $this->config->item('theme_url');?>admin/layout/img/logo.png" alt="logo" class="logo-default"/>-->
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="username username-hide-on-mobile"><?php echo $this->session->userdata('first_name');?></span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="<?php echo base_url('admin/user/change_profile/');?>">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="<?php echo base_url('admin/logout');?>">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>