
		<div class="page-content-wrapper">
			<div class="page-content">
				<h3 class="page-title">
				Dashboard <small>reports & statistics</small>
				</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url('admin/admin');?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN DASHBOARD STATS -->
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue-madison">
							<div class="visual">
								<i class="fa fa-comments"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php echo $data;?>
								</div>
								<div class="desc">
									 Data Latih
								</div>
							</div>
							<a class="more" href="#">&nbsp; </a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat red-intense">
							<div class="visual">
								<i class="fa fa-bar-chart-o"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php echo $class;?>
								</div>
								<div class="desc">
									 Total Class
								</div>
							</div>
							<a class="more" href="#">&nbsp; </a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green-haze">
							<div class="visual">
								<i class="fa fa-shopping-cart"></i>
							</div>
							<div class="details">
								<div class="number">
									 <h4><?php echo $tanggal;?></h4>
								</div>
								<div class="desc">
									 Last Train
								</div>
							</div>
							<a class="more" href="#">&nbsp; </a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat purple-plum">
							<div class="visual">
								<i class="fa fa-globe"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php echo $epoch;?>
								</div>
								<div class="desc">
									 Last Epoch
								</div>
							</div>
							<a class="more" href="#">&nbsp; </a>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="portlet solid bordered grey-cararra">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-bar-chart-o"></i>Bobot Vektor Input
								</div>
							</div>
							<div class="portlet-body">
								<div id="statistic">
								
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
	<?php $this->load->view('admin/footer');?>
	<script src="<?php echo $this->config->item('theme_url');?>global/scripts/highcharts.js" type="text/javascript"></script>
	<script>
		$(function () { 
			$('#statistic').highcharts({
				chart: {
					type: 'line'
				},
				title: {
					text: 'Bobot Vektor Input'
				},
				xAxis: {
					categories: <?php echo json_encode($k);?>
				},
				yAxis: {
					title: {
						text: 'Nilai'
					}
				},
				series: [{
					name: 'C',
					data: <?php echo json_encode($c);?>
				}]
			});
		});
	</script>
</body>
</html>