<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Page Not Found</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>admin/pages/css/error.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/css/plugins.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
		<link id="style_color" href="<?php echo $this->config->item('theme_url');?>admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="favicon.ico"/>
	</head>
	<body class="page-404-3">
		<div class="page-inner">
			<img src="<?php echo $this->config->item('theme_url');?>admin/pages/media/bg/earth.jpg" class="img-responsive" alt="">
		</div>
		<div class="container error-404">
			<h1>404</h1>
			<h2>Oopss...your url is incorrect</h2>
			<p>Actually, the page you are looking for does not exist.</p>
			<p><a href="<?php echo base_url('admin');?>">Return home </a><br></p>
		</div>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
		<script src="<?php echo $this->config->item('theme_url');?>global/scripts/metronic.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/layout.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/demo.js" type="text/javascript"></script>
		<script>
		jQuery(document).ready(function() {    
			Metronic.init();
			Layout.init(); 
			QuickSidebar.init();
			Demo.init(); 
		});
		</script>
	</body>
</html>