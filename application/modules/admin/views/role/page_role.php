
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<h3 class="page-title">
					Dashboard <small>Role</small>
					</h3>
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="index.html">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Role</a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="portlet box green-haze tasks-widget">
								<div class="portlet-title">
									<div class="caption">Data Role</div>
									<div class="tools">
										<a href="javascript:;" class="fullscreen">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
										</div>
									</div>
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>No.</th>
												<th>Menu</th>
												<th>Group</th>
												<th>View</th>
												<th>Add</th>
												<th>Edit</th>
												<th>Delete</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($role)){
											$i=1;
											foreach($role as $data){
												?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $data['nama_menu'];?></td>
												<td><?php echo $data['nama_group'];?></td>
												<?php 
												if($data['view'] ==1){
													$status='checked';
													$read="";
												}else{
													$status='';
													$read="readonly";
												}
												?>
												<td><input type="checkbox" name="delete"<?php echo $status;?> id="view-<?php echo $i;?>" class="form-control" onclick="view(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')" value="1"/>Enable</td>
												<td>
												<?php $add=$data['itambah'] ==1 ? 'checked' : '';?>
												<input type="checkbox" name="add" class="form-control" id="add-<?php echo $i;?>" <?php echo $read;echo $add;?> onclick="add(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')"/>Enable</td>
												<td>
												<?php $edit=$data['iupdate'] ==1 ? 'checked' : '';?>
												<input type="checkbox" name="edit" class="form-control" id="edit-<?php echo $i;?>"<?php echo $read;echo $edit;?> onclick="edit(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')"/>Enable</td>
												<td>
												<?php $delete=$data['idelete'] ==1 ? 'checked' : '';?>
												<input type="checkbox" name="delete" class="form-control" id="delete-<?php echo $i;?>"<?php echo $read;echo $delete;?> onclick="del(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')"/>Enable</td>
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
					<!-- END DASHBOARD STATS -->
					<div class="clearfix">
					</div>
				</div>
			</div>
		</div>
		<script>
		function add(id,role){
			var value = $('#add-'+id+':checked').val()?1:0;
			$.ajax({
				url:"<?php echo base_url();?>admin/role/add/"+role+"/"+value,
				type:"GET",
				success:function(data){
					
				}
			});
		}
		function edit(id,role){
			var value = $('#edit-'+id+':checked').val()?1:0;
			$.ajax({
				url:"<?php echo base_url();?>admin/role/edit/"+role+"/"+value,
				type:"GET",
				success:function(data){
					
				}
			});
		}
		function del(id,role){
			var value = $('#delete-'+id+':checked').val()?1:0;
			$.ajax({
				url:"<?php echo base_url();?>admin/role/delete/"+role+"/"+value,
				type:"GET",
				success:function(data){
					
				}
			});
		}
		function view(id,role){
			var value = $('#view-'+id+':checked').val()?1:0;
			$.ajax({
				url:"<?php echo base_url();?>admin/role/view/"+role+"/"+value,
				type:"GET",
				success:function(data){
					if(value==0){
						$('#add-'+id).attr('readonly',true);
						$('#delete-'+id).attr('readonly',true);
						$('#edit-'+id).attr('readonly',true);
					}else{
						$('#add-'+id).attr('readonly',false);
						$('#delete-'+id).attr('readonly',false);
						$('#edit-'+id).attr('readonly',false);
					}
				}
			});
		}; 
		</script>
<?php $this->load->view('admin/footer');