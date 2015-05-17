<div class="clearfix"></div>
	<div class="page-container">
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<li class="sidebar-toggler-wrapper">
						<div class="sidebar-toggler">
						</div>
					</li>
					<li class="sidebar-search-wrapper">
						</br></br></br></br>
					</li>
					<li class="start">
						<a href="<?php echo base_url('admin/admin');?>"><i class="icon-home"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
						</a>
					</li>
					<?php 
					$menu = $this->menu_model->get_menu(0,$this->session->userdata('kode_group'));
					foreach($menu as $data){
					?>
					<li>
						<a href="javascript:;">
							<i class="icon-rocket"></i>
							<span class="title"><?php echo $data['nama_menu'];?></span>
							<span class="arrow"></span>
						</a>
						<ul class="sub-menu">
						<?php
						$submenu = $this->menu_model->get_menu($data['kode_menu'],$this->session->userdata('kode_group'));
						foreach($submenu as $subdata){
						?>
						<li>
							<a href="<?php echo base_url($subdata['controller']."/".$subdata['kode_menu']);?>">
								<span class="fa fa-sign-in"></span>
								<?php echo $subdata['nama_menu'];?>
							</a>
						</li>
						<?php 
						}
						?>
						</ul>
					</li>
					<?php 
					}
					?>
				</ul>
			</div>
		</div>