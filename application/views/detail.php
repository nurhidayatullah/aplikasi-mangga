<div class="main">
	<div class="container">
		<div class="row" style="margin-top:10px;margin-bottom:10px">
			<div class="page-slider">
				<div class="fullwidthbanner-container revolution-slider">
					<div class="fullwidthabnner3">
						<ul id="revolutionul">
							<li data-transition="fade" data-slotamount="1" data-masterspeed="700" data-delay="9400" data-thumb="<?php echo $this->config->item('theme_url');?>frontend/pages/img/revolutionslider/thumbs/thumb2.jpg">
								<div class="col-lg-12 caption lfb" data-x="0" data-speed="700" data-start="1000" data-easing="easeOutExpo">
									<div class="col-lg-12" style="background-color:rgba(255,255,255,0.7);min-height:460px">
										<div class="row">
											<div class="col-lg-12"><hr/>
												<div class="alert alert-info" role="alert">
													<div class="row">
														<div class="col-lg-12"><h4 style="text-align:center"><strong>Detail Proses</h4></strong><hr/></div>
														<?php 
														$keterangan = array('Gambar Asli', 'Normalisasi Histogram','Obyek Daun','Tepi Daun');
														$histori = explode(',',$data['history']);
														$y = 0;
														foreach($histori as $x){
														?>
														<div class="col-lg-3">
															<?php echo "<p><strong>".($y+1).". ".$keterangan[$y]."</p></strong>";?>
															<img src="<?=base_url()?>/assets/data-uji/<?php echo $x;?>" id="foto" class="img-responsive"><br/>
														</div>
														<?php
														$y++;
														}
														?>
														<div class="col-lg-12">
															<p><strong> Fitur Citra</p></strong>
															<table class="table">
																<tr>
																	<td>Mean Green</td>
																	<td>:</td>
																	<td><?php echo $data['mean_g'];?></td>
																</tr>
																<tr>
																	<td>Momen nth Green</td>
																	<td>:</td>
																	<td><?php echo $data['momen_g'];?></td>
																</tr>
																<tr>
																	<td>Standart Deviasi Green</td>
																	<td>:</td>
																	<td><?php echo $data['dev_g'];?></td>
																</tr>
																<tr>
																	<td>Circularity</td>
																	<td>:</td>
																	<td><?php echo $data['circularity'];?></td>
																</tr>
																<tr>
																	<td>Compactness</td>
																	<td>:</td>
																	<td><?php echo $data['compactness'];?></td>
																</tr>
															</table>
															<a href="<?php echo base_url('classification/index/'.$biner);?>" class="btn blue pull-right"><i class="m-icon-swapleft m-icon-white"></i> Back </a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>