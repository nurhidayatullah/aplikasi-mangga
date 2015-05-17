<?php 
foreach($group as $data){
	$id = $this->my_encrypt->encode($data['kode_group']);
	$nama = $data['nama_group'];
}?>
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									<h4 class="modal-title">Modal title</h4>
								</div>
								<div class="modal-body">
									 Widget settings form goes here
								</div>
								<div class="modal-footer">
									<button type="button" class="btn blue">Save changes</button>
									<button type="button" class="btn default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- BEGIN PAGE HEADER-->
					<h3 class="page-title">
					Dashboard <small>Group</small>
					</h3>
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="index.html">Home</a>
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
									<div class="caption">Edit Data Group</div>
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
													<a href="<?php echo base_url('admin/group/index/'.$menu);?>" class="btn btn-danger">Cancel <i class="fa fa-mail-reply"></i></a>
												</div>
											</div>
										</div>
									</div>
									<form class="" method="post" role="form" action="<?php echo base_url('admin/group/update/'.$id);?>">
										<div class="form-group">
											<label for="nama">Nama Group
											<input class="form-control" type="text" name="nama" value="<?php echo $nama;?>" required />
											<input type="hidden" name="menu" value="<?php echo $menu;?>" required />
										</div></hr>
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