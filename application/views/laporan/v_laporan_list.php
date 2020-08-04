<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Laporan
  </h1>
</section>

<section class="content">
  <div id="message">
    <?php echo @$this->session->userdata('message') <> '' ? @$this->session->userdata('message') : ''; ?>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a href="<?php echo site_url('laporan/create') ?>" class="btn btn-flat btn-primary">Tambah Laporan</a>
          <button type="button" class="btn btn-flat btn-danger pull-right" data-toggle="modal" data-target="#print-mod"><i class="fa fa-print" aria-hidden="true"></i> Print</button>&nbsp;&nbsp;&nbsp;
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
                <th style="width: 10px;">Action</th>
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
                <td class="text-center">
                    <a href="<?php echo site_url('laporan/update/'.$data->id_laporan) ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                    <?php 
                    if ($this->session->userdata('role')==1) {
                      echo '<span data-toggle="tooltip" title="Delete"><a href="#modal-fade'.$data->id_laporan.'" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></span>';
                    }
                    ?>
                </td>
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


