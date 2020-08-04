<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li><a href="<?php echo site_url('laporan') ?>"><i class="fa fa-file"></i><span> Laporan</span></a></li>
        <li><a href="<?php echo site_url('pengaduan') ?>"><i class="fa fa-file"></i><span> Pengaduan</span></a></li>
        <?php if ($this->session->userdata('role')==1) {
            echo '<li><a href="'.site_url('upp').'"><i class="fa fa-map-o"></i><span> UPP</span></a></li>';
            echo '<li><a href="'.site_url('kegiatan').'"><i class="fa fa-suitcase"></i><span> Kegiatan</span></a></li>';
            echo '<li><a href="'.site_url('user').'"><i class="fa fa-user"></i><span> User</span></a></li>';
            echo '<li><a href="'.site_url('setting').'"><i class="fa fa-gear"></i><span> Setting</span></a></li>';
        } ?>
      </ul>
        
    </section>
    <!-- /.sidebar -->
  </aside>