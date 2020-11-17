
      <aside class="main-sidebar">

        <section class="sidebar">


          <ul class="sidebar-menu">

            <!--<li >iStock.id v1.1.0</li>-->
			 <?php $session = $this->session->userdata('login');?>



				<li class="header"><center>
<?php $path = $this->model_menu->selectperusahaan($session['id_perusahaan']); ?>
          <img src="<?= base_url()?>assets/img/logos.png" class="img" alt="" width="150">

        </center></li>
            <li><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <?php foreach ($this->model_menu->getAllMenugroups($session_level)->result() as $rows) { ?>
            <li class="treeview">
              <a href="#">
                <i class="<?= $rows->icon?>"></i> <span><?= $rows->nm_menu_groups?></span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php foreach ($this->model_menu->getAllMenudetails($rows->id_menu_groups, $session_level)->result() as $rows) { ?>
                <li><a href="<?=base_url();?><?= $rows->url?>"><i class="fa fa-circle-o"></i> <?= $rows->nm_menu_details?></a></li>
                <?php } ?>
              </ul>
            </li>
            <?php } ?>
            
<!-- 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Office Supplies</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Pengajuan</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Pengadaan <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Pemesanan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Penerimaan</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->

          </ul>
        </section>

      </aside>
