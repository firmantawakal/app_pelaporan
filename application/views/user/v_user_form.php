
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
</section>

<section class="content">
  <div id="message">
    <?php //echo @$this->session->userdata('message') <> '' ? @$this->session->userdata('message') : ''; ?>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="f_username_hid" value="<?php echo $username_hid ?>" class="form-control">
            <div class="form-group">
                <label class="col-md-3 control-label" >Username</label>
                <div class="col-md-9">
                    <input type="text" name="f_username" class="form-control" value="<?php echo $username ?>" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" >Nama User</label>
                <div class="col-md-9">
                    <input type="text" name="f_nama_user" class="form-control" value="<?php echo $nama_user ?>" placeholder="Nama User">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" >Password</label>
                <div class="col-md-9">
                    <input type="password" name="f_password" class="form-control" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" >Role</label>
                <div class="col-md-9">
                    <select name="f_role_upp" id="kegiatan" class="form-control" required>
                        <option>-- pilih --</option>
                        <?php foreach($upp as $r){ ?>
                            <option value="<?php echo $r->id_upp; ?>" <?php if ($r->id_upp == @$role_upp) : ?> selected<?php endif; ?>><?php echo @$r->nama_upp ?></option>  
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-9 col-md-offset-3">
                    <a type="button" href="javascript:history.go(-1)" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                </div>
            </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</section>
