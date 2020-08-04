<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    profil
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
                <td>Username</td>
                <td>:</td>
                <td><?php echo $profil->username ?></td>
              </tr>
              <tr>
                <td>Nama User</td>
                <td>:</td>
                <td><?php echo $profil->nama_user ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <a href="<?php echo site_url('profil/update/1') ?>" class="btn btn-primary"><i class="fa fa-pencil"> Edit</i></a>
        </div>
      </div>
    </div>
  </div>
</section>