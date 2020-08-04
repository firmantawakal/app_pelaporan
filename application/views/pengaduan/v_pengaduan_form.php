
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
            <input type="hidden" name="f_id_pengaduan" value="<?php echo @$id_pengaduan ?>" class="form-control">
            
            <div class="form-group">
							<label class="col-md-3 control-label">Tanggal</label>
							<div class="col-md-9">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" name="f_tgl_pengaduan" class="form-control pull-right"
										id="datepicker" value="<?php echo @$tgl_pengaduan ?>" required>
								</div>
							</div>
						</div>
						<?php 
                if ($this->session->userdata('role')==1) { ?>
						<div class="form-group">
							<label class="col-md-3 control-label">UPP</label>
							<div class="col-md-9">
								<select name="f_id_upp" id="upp" class="form-control" required>
									<option>-- pilih --</option>
									<?php foreach($upp as $u){ ?>
									<option value="<?php echo $u->id_upp; ?>" <?php if ($u->id_upp == @$id_upp) : ?>
										selected<?php endif; ?>><?php echo @$u->nama_upp ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<?php
                }else{ ?>
						<input type="hidden" name="f_id_upp" value="<?php echo @$this->session->userdata('role') ?>">
						<?php
                }
                ?>
					
						<div class="form-group">
							<label class="col-md-3 control-label">Posko</label>
							<div class="col-md-9">
                <input type="number" name="f_posko" class="form-control" value="<?php echo @$posko ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">SMS</label>
							<div class="col-md-9">
                <input type="number" name="f_sms" class="form-control" value="<?php echo @$sms ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Email</label>
							<div class="col-md-9">
                <input type="number" name="f_email" class="form-control" value="<?php echo @$email ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Telp.</label>
							<div class="col-md-9">
                <input type="number" name="f_telp" class="form-control" value="<?php echo @$telp ?>" required>
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
