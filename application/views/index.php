<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>Identifikasi Mangga</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Identifikasi jenis mangga berdasarkan daun" name="description">
  <meta content="voted percptron" name="keywords">
  <meta content="Nur Hidayatullah" name="author">

  <link rel="shortcut icon" href="favicon.ico">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="<?php echo $this->config->item('theme_url');?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="<?php echo $this->config->item('theme_url');?>global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="<?php echo $this->config->item('theme_url');?>global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css" rel="stylesheet">
  <link href="<?php echo $this->config->item('theme_url');?>global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="<?php echo $this->config->item('theme_url');?>global/css/components.css" rel="stylesheet">
  <link href="<?php echo $this->config->item('theme_url');?>frontend/layout/css/style.css" rel="stylesheet">
  <link href="<?php echo $this->config->item('theme_url');?>frontend/pages/css/style-revolution-slider.css" rel="stylesheet"><!-- metronic revo slider styles -->
  <link href="<?php echo $this->config->item('theme_url');?>frontend/layout/css/style-responsive.css" rel="stylesheet">
  <link href="<?php echo $this->config->item('theme_url');?>frontend/layout/css/themes/green.css" rel="stylesheet" id="style-color">
  <link href="<?php echo $this->config->item('theme_url');?>frontend/layout/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
</head>
<body class="corporate" style="background-image: url('<?php echo $this->config->item('theme_url');?>img/mango2.jpg')">

    <div class="pre-header" style="background-color:rgba(255,255,255,0.3)">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <li>
							<a href="<?php echo base_url('admin');?>" class="btn blue pull-right">Login <i class="m-icon-swapright m-icon-white"></i></a>
						
                    </ul>
                </div>
            </div>
        </div>        
    </div>
    <div class="header">
      <div class="container">
        <a class="site-logo" href="index.html">Identifikasi Jenis Mangga</a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
		
        <div class="header-navigation pull-right font-transform-inherit">
          <ul>  
			<?php
			foreach($menu as $menu){
			?>
				<li class="<?php echo $menu['class'];?>"><a href="<?php echo $menu['url'];?>"><?php echo $menu['name'];?></a></li>
			<?php
			}
			?>
          </ul>
        </div>
      </div>
    </div>
	
    <?php $this->load->view($content) ?>
	
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 padding-top-10">
            2015 © <a href="#">Universitas Bhayangkara Surabaya.</a>
          </div>
          <div class="col-md-6 col-sm-6">
            <ul class="social-footer list-unstyled list-inline pull-right">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-github"></i></a></li>
            </ul>  
          </div>
        </div>
      </div>
    </div>
	<input type="hidden" id="url" value="<?php echo $this->config->item('theme_url');?>"/>
    <!--[if lt IE 9]>
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/respond.min.js"></script>
    <![endif]--> 
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo $this->config->item('theme_url');?>frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->

    <!-- BEGIN RevolutionSlider -->
  
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script> 
    <script src="<?php echo $this->config->item('theme_url');?>global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script> 
    <script src="<?php echo $this->config->item('theme_url');?>frontend/pages/scripts/revo-slider-init.js" type="text/javascript"></script>
    <!-- END RevolutionSlider -->

    <script src="<?php echo $this->config->item('theme_url');?>frontend/layout/scripts/layout.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            RevosliderInit.initRevoSlider();
            Layout.initTwitter();
        });
    </script>
</body>
</html>