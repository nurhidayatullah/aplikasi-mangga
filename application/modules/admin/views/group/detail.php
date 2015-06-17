<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"Hak Akses</h4>
		</div>
		<div class="modal-body">
			 <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">Hak Akses</div>
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
							<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="tb">
								<thead>
									<tr>
										<th>No.</th>
										<th>Menu</th>
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
										<?php 
										if($data['view'] ==1){
											$status='checked';
											$read="";
										}else{
											$status='';
											$read="readonly";
										}
										?>
										<td>
											<div class="icheck-inline">
												<label>
													<input type="checkbox" name="delete"<?php echo $status;?> id="view-<?php echo $i;?>" class="icheck" onclick="view(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')" value="1"/> Enable
												</label>
											</div>
										</td>
										<td>
										<?php
											$add=$data['itambah'] ==1 ? 'checked' : '';?>
											<div class="icheck-inline">
												<label>
													<input type="checkbox" name="add" class="icheck" id="add-<?php echo $i;?>" <?php echo $read;echo $add;?> onclick="add(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')"/> Enable
												</label>
											</div>
										</td>
										<td>
										<?php
											$edit=$data['iupdate'] ==1 ? 'checked' : '';?>
											<div class="icheck-inline">
												<label>
													<input type="checkbox" name="edit" class="icheck" id="edit-<?php echo $i;?>"<?php echo $read;echo $edit;?> onclick="edit(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')"/> Enable
												</label>
											</div>
										</td>
										<td>
										<?php
											$delete=$data['idelete'] ==1 ? 'checked' : '';?>
											<div class="icheck-inline">
												<label>
													<input type="checkbox" name="delete" class="icheck" id="delete-<?php echo $i;?>"<?php echo $read;echo $delete;?> onclick="del(<?php echo $i;?>,'<?php echo $this->my_encrypt->encode($data['kode_role']);?>')"/> Enable
												</label>
											</div>
										</td>
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
		</div>
		<div class="modal-footer">
			<button type="button" class="btn default" data-dismiss="modal">Close</button>
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