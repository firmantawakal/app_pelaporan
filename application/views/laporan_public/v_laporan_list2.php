
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Top Navigation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/dist/css/skins/_all-skins.min.css">

  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
            <span class="logo-mini"><img src="<?php echo base_url(); ?>assets/images/logo-web.png" style="width:70%"></span>
        </div>

        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="<?php echo base_url('login') ?>">Login</a>
            </li>
            <!-- /.messages-menu -->
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Data Laporan
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
      <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <!-- <a href="<?php echo site_url('laporan/create') ?>" class="btn btn-flat btn-primary">Tambah Laporan</a>
          <button type="button" class="btn btn-flat btn-danger pull-right" data-toggle="modal" data-target="#print-mod"><i class="fa fa-print" aria-hidden="true"></i> Print</button>&nbsp;&nbsp;&nbsp; -->
          <?php
          $role = $this->session->userdata('role'); 
          if ($role == 1) {
            echo '<button style="margin-right:10px !important" type="button" class="btn btn-flat btn-warning pull-right" data-toggle="modal" data-target="#print-mod2"><i class="fa fa-print" aria-hidden="true"></i> Print Rekap</button>';
          }
          ?>

          <div class="modal fade" id="print-mod">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Print Laporan</h4>
              </div>
              <div class="modal-body">
                <form action="<?php echo site_url('laporan/print_laporan') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="form-group">
                      <label class="col-md-3 control-label" >Tanggal Laporan</label>
                      <div class="col-md-9">
                          <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="f_tgl" class="form-control pull-right" id="rangepicker2" required>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Print</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.modal -->

          <div class="modal fade" id="print-mod2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Print Rekap Laporan</h4>
              </div>
              <div class="modal-body">
                <form action="<?php echo site_url('laporan/print_laporan_rekap') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="form-group">
                      <label class="col-md-3 control-label" >Tanggal Laporan</label>
                      <div class="col-md-9">
                          <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="f_tgl" class="form-control pull-right" id="rangepicker" required>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Print</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.modal -->

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover" style="width:100%">
            <thead>
              <tr>
                <th style="width: 10px;">No</th>
                <!-- <th style="width: 10px;">Action</th> -->
                <th style="min-width: 100px;">Waktu</th>
                <th>UPP</th>
                <th>Kegiatan</th>
                <th>Tempat</th>
                <th>Peserta</th>
                <th>Pelaksana</th>
                <th style="min-width: 300px;">Uraian Kegiatan</th>
                <th>Dokumentasi</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $no=1;
                foreach($laporan as $data){
            ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $this->fungsi->tanggal_indo($data->waktu_tgl, true).'<br>'.$data->waktu_jam1.' s/d '.$data->waktu_jam2.' WIB' ?></td>
                <td><?php echo $data->nama_upp ?></td>
                <td><?php echo $data->nama_kegiatan ?></td>
                <td><?php echo $data->tempat ?></td>
                <td><?php echo $data->peserta ?></td>
                <td><?php echo $data->pelaksana ?></td>
                <td><?php echo $data->uraian_kegiatan ?></td>
                <td><button type="button" class="btn btn-sm btn-flat btn-success" data-toggle="modal" data-target="#images<?php echo $no ?>">View</button></td>

                <div class="modal fade" id="images<?php echo $no ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <center><img class="img-responsive" src="<?= base_url().'assets/images/laphar/'.$data->dokumentasi ?>"></center>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.modal -->
              </tr>
              <div id="modal-fade<?php echo $data->id_laporan; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title"><strong>Konfirmasi</strong></h3>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menghapus data?
                        </div>
                        <div class="modal-footer">
                            <a href="<?php echo site_url('laporan/delete/'.$data->id_laporan) ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
                            <button type="button" class="btn btn-effect-ripple btn-default" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
              <?php 
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
            
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      'scrollX'     : true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
