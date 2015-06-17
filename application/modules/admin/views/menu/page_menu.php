<?php foreach($priv as $akses){
	$tambah = $akses['itambah'];
	$edit = $akses['iupdate'];
	$hapus = $akses['idelete'];
}?>
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<h3 class="page-title">
					Dashboard <small>Menu</small>
					</h3>
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo base_url('admin/admin');?>">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Menu</a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="portlet box green-haze tasks-widget">
								<div class="portlet-title">
									<div class="caption">Data Menu</div>
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
													<a href="<?php echo base_url('admin/menu/new_data/'.$url);?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
												</div>
											<?php } ?>
												<?php if(!empty($msg)){ 
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
											</div>
										</div>
									</div>
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="tb">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Menu</th>
												<th>Controller</th>
												<th>Create Date</th>
												<th>Update Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($menu)){
											$i=1;
											foreach($menu as $data){
												?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $data['nama_menu'];?></td>
												<td><?php echo $data['controller'];?></td>
												<td><?php echo $data['create_at'];?></td>
												<td><?php echo $data['update_at'];?></td>
												<td>
												<?php if($edit){?>
													<a href="<?php echo base_url('admin/menu/edit/'.$url.'/'.$this->my_encrypt->encode($data['kode_menu']));?>" class="btn btn-warning btn-sm">Edit <i class="fa fa-pencil-square-o"></i></a>&nbsp;
												<?php } 
												if($hapus){
												?>
													<a href="<?php echo base_url('admin/menu/hapus/'.$url.'/'.$this->my_encrypt->encode($data['kode_menu']));?>" class="btn btn-danger btn-sm">Hapus <i class="fa fa-trash"></i></a></td>
												<?php } ?>
											</tr>
											<?php $i++;
											}
										}?>
										</tbody>
									</table>
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
</body>
</html>