
		<!-- BEGIN FOOTER -->
		<div class="page-footer">
			<div class="page-footer-inner">
				 2014 &copy; Aplikasi Mangga by Nur Hidayatullah.
			</div>
			<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
		<!--[if lt IE 9]>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/respond.min.js"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/excanvas.min.js"></script> 
		<![endif]-->
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
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/scripts/metronic.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/layout.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/layout/scripts/demo.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/pages/scripts/index.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/pages/scripts/tasks.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>admin/pages/scripts/table-managed.js"></script>
		<script>
		jQuery(document).ready(function() {    
		   Metronic.init();
		   Layout.init();
		   QuickSidebar.init();
		   Demo.init(); 
		   Index.init(); 
		   Tasks.initDashboardWidget();
		});
		</script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('theme_url');?>global/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function() {
			$("#tb").dataTable({
				"oLanguage": {
						   "sLengthMenu": 'Display <select class="form-control">'+ 
							 '<option value="5">5</option>'+
							'<option value="10">10</option>'+
							'<option value="20">20</option>'+
							'<option value="30">30</option>'+
							'<option value="40">40</option>'+
							'<option value="50">50</option>'+
							'<option value="-1">All</option>'+
							'</select> records'
						}
			});
		});
		</script>