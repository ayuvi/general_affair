<!DOCTYPE html>
<html>

  <head>
    <?= $this->load->view('head'); ?>

  </head>


  <body class="sidebar-mini wysihtml5-supported <?= $this->config->item('color')?>">

    <div class="wrapper">

      <?= $this->load->view('nav'); ?>
      <?= $this->load->view('menu_groups'); ?>


      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            <!-- <img src="<?= base_url()?>assets/img/b1.jpeg" class="img" alt="" width="300">
            <img src="<?= base_url()?>assets/img/b2.jpeg" class="img" alt="" width="300">
            <img src="<?= base_url()?>assets/img/b3.jpeg" class="img" alt="" width="300"> -->
          </h1>
          <div class="row">
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h2 id='rinbox'>0</h2>
                  <p>Barang</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="#" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h2 id='rdisposisi'>0</h2>
                  <p>Pemesanan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="#" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i> </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h2 id='rapproval'>0</h2>
                  <p>Penerimaan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <a href="#" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h2 id=''>Pengeluaran</h2>
                  <p>Pengeluaran</p>
                </div>
                <div class="icon">
                  <i class="fa fa-group"></i>
                </div>
                <a href="#" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h2 id=''>Stok</h2>
                  <p>Stok</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tasks"></i>
                </div>
                <a href="#" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
          </div>
        </section>

       
		  </div>
    </div>

			<?= $this->load->view('basic_js'); ?>
      <script type='text/javascript'>
      
    </script>
	</body>
</html>
