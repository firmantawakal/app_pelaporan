<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Data Pengaduan
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
					<a href="<?php echo site_url('pengaduan/create') ?>" class="btn btn-flat btn-primary">Tambah Pengaduan</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-hover nowrap display" style="width:100%">
						<thead>
							<tr>
								<th style="width: 10px;">No</th>
								<th style="width: 20px;">Action</th>
								<th>Tgl. Pengaduan</th>
								<th>Nama UPP</th>
								<th>Pengaduan Posko</th>
								<th>Pengaduan SMS</th>
								<th>Pengaduan Email</th>
								<th>Pengaduan Telp</th>
							</tr>
						</thead>
						<tbody>
							<?php
                $no=1;
                foreach($pengaduan as $data){
            ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td class="text-center">
									<a href="<?php echo site_url('pengaduan/update/'.$data->id_pengaduan) ?>" data-toggle="tooltip"
										title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
									<?php 
                    if ($this->session->userdata('role')==1) {
                      echo '<span data-toggle="tooltip" title="Delete"><a href="#modal-fade'.$data->id_pengaduan.'" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></span>';
                    }
                    ?>
								</td>
								<td><?php echo $this->fungsi->tanggal_indo($data->tgl_pengaduan, true) ?></td>
								<td><?php echo $data->nama_upp ?></td>
								<td><?php echo $data->posko ?></td>
								<td><?php echo $data->sms ?></td>
								<td><?php echo $data->email ?></td>
								<td><?php echo $data->telp ?></td>
							</tr>
							<div id="modal-fade<?php echo $data->id_pengaduan; ?>" class="modal fade" tabindex="-1" role="dialog"
								aria-hidden="true">
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
											<a href="<?php echo site_url('pengaduan/delete/'.$data->id_pengaduan) ?>"
												class="btn btn-effect-ripple btn-danger">Ya</a>
											<button type="button" class="btn btn-effect-ripple btn-default"
												data-dismiss="modal">Tidak</button>
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