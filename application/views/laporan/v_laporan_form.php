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
					<form action="<?php echo $action ?>" method="post" enctype="multipart/form-data"
						class="form-horizontal">
						<input type="hidden" name="f_id_laporan" value="<?php echo @$id_laporan ?>"
							class="form-control">
						<div class="form-group">
							<label class="col-md-3 control-label">Kegiatan</label>
							<div class="col-md-9">
								<select name="f_id_kegiatan" id="kegiatan" class="form-control" required>
									<option>-- pilih --</option>
									<?php foreach($kegiatan as $keg){ ?>
									<option value="<?php echo $keg->id_kegiatan; ?>"
										<?php if ($keg->id_kegiatan == @$id_kegiatan) : ?> selected<?php endif; ?>>
										<?php echo @$keg->nama_kegiatan ?></option>
									<?php } ?>
								</select>
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
							<label class="col-md-3 control-label">Tanggal</label>
							<div class="col-md-9">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" name="f_waktu_tgl" class="form-control pull-right"
										id="datepicker" value="<?php echo @$waktu_tgl ?>" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Jam</label>
							<div class="col-md-9">
								<div class="input-group">
									<input type="text" name="f_waktu_jam1" value="<?php echo @$waktu_jam1 ?>"
										class="form-control timepicker" required>
									<div class="input-group-addon">
										s/d
									</div>
									<input type="text" name="f_waktu_jam2" value="<?php echo @$waktu_jam2 ?>"
										class="form-control timepicker" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Tempat</label>
							<div class="col-md-9">
								<textarea name="f_tempat" class="form-control" rows="3" placeholder="..."
									required><?php echo @$tempat ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Peserta</label>
							<div class="col-md-9">
								<textarea name="f_peserta" class="form-control" rows="3" placeholder="..."
									required><?php echo @$peserta ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Pelaksana</label>
							<div class="col-md-9">
								<textarea name="f_pelaksana" class="form-control" rows="3" placeholder="..."
									required><?php echo @$pelaksana ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Uraian Kegiatan</label>
							<div class="col-md-9">
								<textarea name="f_uraian_kegiatan" class="form-control" rows="3" placeholder="..."
									required><?php echo @$uraian_kegiatan ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Dokumentasi</label>
							<div class="col-md-9">
								<input type="hidden" name="f_dokumentasi_lama" value="<?= @$dokumentasi ?>">
								<input type="file" id="file" name="f_dokumentasi" accept="image/*">
							</div>
						</div>
						<div class="form-group form-actions">
							<div class="col-md-9 col-md-offset-3">
								<a type="button" href="javascript:history.go(-1)" class="btn btn-sm btn-default"><i
										class="fa fa-arrow-left"></i> Back</a>
								<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i>
									Submit</button>
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
