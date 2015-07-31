<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Aplikasi Mangga</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="aplikasi mangga,klasifikasi mangga,jenis mangga" name="description"/>
		<meta content="Nur Hidayatullah" name="author"/>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo $this->config->item('theme_url');?>global/css/style_home.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<h3>Aplikasi Mangga</h3>
				</div>
			</div>
			<div class="navbar-home alert-info">
				<ul class="nav nav-pills">
				<?php
				foreach($menu as $menu){
				?>
					<li role="presentation" class="<?php echo $menu['class'];?>"><a href="<?php echo $menu['url'];?>"><?php echo $menu['name'];?></a></li>
				<?php
				}
				?>
				  <li class="navbar-right">
					<ul class="nav">
						<li><a href="<?php echo base_url('admin');?>">Login</a></li>
					</ul>
				  </li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row" style="padding-left:17px;padding-right:17px">
				<div class="col-lg-12 col-md-12 canvas">
					<?php $this->load->view($content) ?>
				</div>
			</div>
		</div>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	</body>
</html>