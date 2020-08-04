
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
            <input type="hidden" name="f_username_ybs" value="<?php echo $this->session->userdata('username'); ?>" class="form-control">
            <div class="form-group">
                <label class="col-md-3 control-label" >Username</label>
                <div class="col-md-9">
                    <input type="text" name="f_username" class="form-control" value="<?php echo @$username ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" >Nama User</label>
                <div class="col-md-9">
                    <input type="text" name="f_nama_user" class="form-control" value="<?php echo @$nama_user ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" >Password</label>
                <div class="col-md-9">
                    <input type="password" name="f_password" class="form-control" required>
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
<script>
	var uploadField = document.getElementById("file");

	// Allowing file type 
	var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

	uploadField.onchange = function () {
		// var max = 1024 * 1024;
		if (!allowedExtensions.exec(uploadField.files[0].name)) {
			swal("Gagal!", "File yang diperbolehkan adalah file gambar!", "warning");
			this.value = '';
		}
		// if(uploadField.files[0].size > max){
		//     swal("Gagal!", "File gambar maksimal 1 MB!", "warning");
		//     uploadField.value = "";
		// };
	}

</script>