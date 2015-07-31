<?php foreach($priv as $akses){
	$tambah = $akses['itambah'];
	$edit = $akses['iupdate'];
	$hapus = $akses['idelete'];
}?>
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<h3 class="page-title">
					Dashboard <small> Voted Perceptron</small>
					</h3>
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo base_url('admin/admin');?>">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Pelatihan</a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="portlet box green-haze tasks-widget">
								<div class="portlet-title">
									<div class="caption">Pelatihan Voted Perceptron</div>
									<div class="tools">
										<a href="javascript:;" class="fullscreen">
										</a>
									</div>
								</div>
								<div class="portlet-body" style="overflow-x:hidden;height:400px;">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-3">
											<?php if($tambah){?>
												<button type="button" class="btn btn-primary" id="start" onclick="start()">Start</button>
											<?php }
											if($edit){?>
												<button type="button" class="btn btn-danger" id="stop" onclick="stop()">Stop</button>
											<?php }
											if($hapus){?>
												<a href="<?php echo base_url('voted/pelatihan/kosongkan/'.$menu)?>" class="btn btn-warning">Clear All</a>
											<?php }?>
											<span id="load"></span>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="input-inline input-medium">
														<div class="input-group">
															<span class="input-group-addon">
															K : 
															</span>
															<input type="text" class="form-control" id="k" readonly />
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="input-inline input-medium">
														<div class="input-group">
															<span class="input-group-addon">Last Train </span>
															<input type="text" class="form-control" id="last" value="<?php echo $tanggal;?>" readonly />
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-1">
												
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="input-inline input-medium">
														<div class="input-group">
															<span class="input-group-addon">Epoch Ke </span>
															<input type="number" class="form-control" id="iterasi" value="<?php echo $epoch;?>" readonly />
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="input-inline input-medium">
														<div class="input-group">
															<span class="input-group-addon">Max Epoch</span>
															<input type="number" class="form-control" id="max" value="1"/>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-1"></div>
											<div class="col-md-2">
												
											</div>
										</div>
									</div>
									<div class="table-responsive">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th>Data</th>
												<th>V11</th>
												<th>V12</th>
												<th>V13</th>
												<th>V21</th>
												<th>V22</th>
												<th>V23</th>
												<th>V31</th>
												<th>V32</th>
												<th>V33</th>
												<th>V41</th>
												<th>V42</th>
												<th>V43</th>
												<th>V51</th>
												<th>V52</th>
												<th>V53</th>
												<th>C</th>
											</tr>
										</thead>
										<tbody id="vektor">
										</tbody>
									</table>
									<input type="hidden" class="form-control" id="url" value="<?php echo base_url();?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer');?>
		<script src="<?php echo $this->config->item('theme_url');?>global/scripts/voted.js" type="text/javascript"></script>
	</body>
</html>