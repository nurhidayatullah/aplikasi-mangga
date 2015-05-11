<?php foreach($priv as $akses){
	$tambah = $akses['itambah'];
	$edit = $akses['iupdate'];
	$hapus = $akses['idelete'];
}?>
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<h3 class="page-title">
					Dashboard <small>Data Latih</small>
					</h3>
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="index.html">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Data Latih</a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="portlet box green-haze tasks-widget">
								<div class="portlet-title">
									<div class="caption">Data Latih</div>
									<div class="tools">
										<a href="javascript:;" class="fullscreen">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
											<?php if($tambah){?>
												<div class="btn-group">
													<a href="<?php echo base_url('mangga/data_latih/new_data/'.$menu);?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
												</div>
											<?php }
											 if(!empty($msg)){ 
												if($msg==0){
													?>
												<div class="alert alert-warning alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
													<strong>Failed</strong>
												</div>
												<?php }else if($msg==1){?>
												<div class="alert alert-success alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
													<strong>Success</strong>
												</div>
												<?php }} ?>
											</div>
											<div class="col-md-6">
												<div class="btn-group pull-right">
													<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu pull-right">
														<li><a href="#">Print </a></li>
														<li><a href="#">Save as PDF </a></li>
														<li><a href="#">Export to Excel </a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<table class="table table-striped table-bordered table-hover" id="tb">
										<thead>
											<tr>
												<th>No.</th>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Email</th>
												<th>Password</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php/* if(isset($user)){
											$i=1;
											foreach($user as $data){
											*/	?>
											<tr>
												<td>1</td>
												<td>tes</td>
												<td>dsfdfdsfds</td>
												<td>dfdsdssd</td>
												<td>dcsscdscsd</td>
												<td>
												<?php if($edit){?>
													<a href="<?php echo base_url('admin/user/edit/'.$menu.'/');?>" class="btn btn-warning">Edit <i class="fa fa-pencil-square-o"></i></a>&nbsp;
												<?php } 
												if($hapus){
												?>	
													<a href="<?php echo base_url('admin/user/hapus/'.$menu.'/');?>" class="btn btn-danger">Hapus <i class="fa fa-trash"></i></a></td>
												<?php } ?>
											</tr>
											<?php/* $i++;
											}
										}*/?>
										</tbody>
									</table>
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
<?php $this->load->view('admin/footer');