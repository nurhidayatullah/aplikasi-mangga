<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Aplikasi Manga | Login </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo $this->config->item('theme_url');?>global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo $this->config->item('theme_url');?>global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo $this->config->item('theme_url');?>admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->config->item('theme_url');?>admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<h2 style="color:red"><strong>APLIKASI MANGGA</strong></h2>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo base_url('admin/do_login');?>" method="post">
		<h3 class="form-title">Login to your account</h3>
		<?php if(!empty($msg)){?>
		<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<span><?php echo $msg;?></span>
		</div>
		<?php } ?>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Your Email" name="email"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<a href="<?php echo base_url();?>" class="btn red pull-left"><i class="fa fa-home"></i> Home</a>
			<button type="submit" class="btn blue pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2015 &copy; Nur Hidayatullah - Universitas Bhayangkara Surabaya
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/respond.min.js"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->config->item('theme_url');?>global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo $this->config->item('theme_url');?>global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('theme_url');?>admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
  Login.init();
  Demo.init();
       // init background slide images
       $.backstretch([
        "<?php echo $this->config->item('theme_url');?>admin/pages/media/bg/1.jpg",
        "<?php echo $this->config->item('theme_url');?>admin/pages/media/bg/2.jpg",
        "<?php echo $this->config->item('theme_url');?>admin/pages/media/bg/3.jpg",
        "<?php echo $this->config->item('theme_url');?>admin/pages/media/bg/4.jpg"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>