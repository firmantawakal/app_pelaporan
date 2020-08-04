<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Setting Surat
  </h1>
</section>

<section class="content">
  <div id="message">
    <?php echo @$this->session->userdata('message') <> '' ? @$this->session->userdata('message') : ''; ?>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-hover">
              <tr>
                <td>Nama Ketua</td>
                <td>:</td>
                <td><?php echo $setting->nama_ketua ?></td>
              </tr>
              <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?php echo $setting->jabatan ?></td>
              </tr>
              <tr>
                <td>Logo Surat</td>
                <td>:</td>
                <td><img width="70" src="<?= base_url().'assets/images/'.$setting->logo_surat ?>"></td>
              </tr>
            </tbody>
          </table>
          <br>
          <a href="<?php echo site_url('setting/update/1') ?>" class="btn btn-primary"><i class="fa fa-pencil"> Edit</i></a>
        </div>
      </div>
    </div>
  </div>
</section>