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
											if($hapus){?>
												<button type="button" class="btn btn-danger" id="stop">Stop</button>
											<?php } ?>
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
											</div>
											<div class="col-md-1"></div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="input-inline input-medium">
														<div class="input-group">
															<span class="input-group-addon">Epoch Ke </span>
															<input type="number" class="form-control" id="iterasi" value="0" readonly />
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-1"></div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="input-inline input-medium">
														<div class="input-group">
															<span class="input-group-addon">Max Epoch</span>
															<input type="number" class="form-control" id="max" value="1"/>
														</div>
													</div>
												</div>
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
												<th>V14</th>
												<th>V21</th>
												<th>V22</th>
												<th>V23</th>
												<th>V24</th>
												<th>V31</th>
												<th>V32</th>
												<th>V33</th>
												<th>V34</th>
												<th>V41</th>
												<th>V42</th>
												<th>V43</th>
												<th>V44</th>
												<th>V51</th>
												<th>V52</th>
												<th>V53</th>
												<th>V54</th>
												<th>C</th>
											</tr>
										</thead>
										<tbody id="vektor">
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer');?>
		<script>
			var data;
			var vektor;
			var k;
			var benar = 0;
			var jml_data = 0;
			function start(){
				$('#stop').removeClass('disabled');
				$('#start').addClass('disabled');
				pelatihan(1);
			}
			function pelatihan(epoch){
				var max_epoch = $("#max").val();
				if(epoch <= max_epoch){
					$('#load').html("Running...<img src='<?php echo base_url()?>/assets/img/gloader.gif' />");
					$('#iterasi').val(epoch);
					benar = 0;
					hitung(0,epoch,max_epoch);
				}else{
					selesai();
				}
			}
			function hitung(num_data,epoch,max_epoch){
				if(num_data < jml_data){
					$.ajax({
						type:"POST",data:{data_latih:data[num_data],v:vektor[k]},dataType:"json",
						url:"<?php echo base_url();?>voted/pelatihan/train/",
						success:function(result){
							if(result[20]==0){
								k = k + 1;
								vektor[k] = result;
							}else{
								benar = benar + 1;
								vektor[k][20] = result[20];
							}
							$('#k').val(k);
							$("#vektor").append("<tr>");
							$("#vektor").append("<td>"+(num_data+1)+"</td><td>"+vektor[k][0]+"</td><td>"+vektor[k][1]+"</td><td>"+vektor[k][2]+"</td><td>"+vektor[k][3]+"</td><td>"+vektor[k][4]+"</td><td>"+vektor[k][5]+"</td><td>"+vektor[k][6]+"</td><td>"+vektor[k][7]+"</td><td>"+vektor[k][8]+"</td><td>"+vektor[k][9]+"</td><td>"+vektor[k][10]+"</td><td>"+vektor[k][11]+"</td><td>"+vektor[k][12]+"</td><td>"+vektor[k][13]+"</td><td>"+vektor[k][14]+"</td><td>"+vektor[k][15]+"</td><td>"+vektor[k][16]+"</td><td>"+vektor[k][17]+"</td><td>"+vektor[k][18]+"</td><td>"+vektor[k][19]+"</td><td>"+vektor[k][20]+"</td>");
							$("#vektor").append("</tr>");
							num_data = num_data+1;
							hitung(num_data,epoch,max_epoch);
						}
					});
				}else{
					if(benar == num_data){
						selesai();
					}else{
						epoch = epoch+1;
						pelatihan(epoch);
					}
				}
			}
			function selesai(){
				$('#stop').removeClass('disabled');
				$('#start').addClass('disabled');
				$('#load').html("Done...");
				$.ajax({
					type:"POST",data:{v:vektor},dataType:"json",
					url:"<?php echo base_url();?>voted/pelatihan/save/",
					success:function(out){
						
					}
				});
			}
			$(function(){
				$('#stop').addClass('disabled');
				$.ajax({
					type:"GET",
					url:"<?php echo base_url();?>voted/pelatihan/get_data_latih/",
					success:function(result){
						data = JSON.parse(result);
						for(var i in data){
							jml_data = jml_data + 1;
						}
						k = 0;
						$('#k').val(k);
					}
				});
				$.ajax({
					type:"GET",
					url:"<?php echo base_url();?>voted/pelatihan/get_vektor/",
					success:function(result2){
						vektor = JSON.parse(result2);
						$("#vektor").append("<tr>");
						$("#vektor").append("<td>0</td><td>"+vektor[0][0]+"</td><td>"+vektor[0][1]+"</td><td>"+vektor[0][2]+"</td><td>"+vektor[0][3]+"</td><td>"+vektor[0][4]+"</td><td>"+vektor[0][5]+"</td><td>"+vektor[0][6]+"</td><td>"+vektor[0][7]+"</td><td>"+vektor[0][8]+"</td><td>"+vektor[0][9]+"</td><td>"+vektor[0][10]+"</td><td>"+vektor[0][11]+"</td><td>"+vektor[0][12]+"</td><td>"+vektor[0][13]+"</td><td>"+vektor[0][14]+"</td><td>"+vektor[0][15]+"</td><td>"+vektor[0][16]+"</td><td>"+vektor[0][17]+"</td><td>"+vektor[0][18]+"</td><td>"+vektor[0][19]+"</td><td>"+vektor[0][20]+"</td>");
						$("#vektor").append("</tr>");
					}
				});
			});
		</script>
	</body>
</html>