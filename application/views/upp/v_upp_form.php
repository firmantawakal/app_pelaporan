
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
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
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="f_id_upp" value="<?php echo @$id_upp ?>" class="form-control">
            <div class="form-group">
                <label class="col-md-3 control-label" >Nama UPP</label>
                <div class="col-md-9">
                    <input type="text" name="f_nama_upp" class="form-control" value="<?php echo @$nama_upp ?>" placeholder="Nama UPP">
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
