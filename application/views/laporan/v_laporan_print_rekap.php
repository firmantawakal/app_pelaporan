<style>
	.invoice {
		font-family: 'Arial', sans-serif !important;
	}

	hr {
		margin-top: 2px;
		border-top: 1px solid black;
	}

	.table-bordered>thead>tr>th,
	.table-bordered>tbody>tr>th,
	.table-bordered>tfoot>tr>th,
	.table-bordered>thead>tr>td,
	.table-bordered>tbody>tr>td,
	.table-bordered>tfoot>tr>td {
		border-top: 1px solid #444 !important;
		border: 1px solid #444 !important;
		padding: 2px !important;
        text-align: center; 
        vertical-align: middle;
	}

	.tabel-rekap, .invoice {
		font-size: 12px !important;
	}
</style>
<!-- Main content -->
<section class="invoice">
	<!-- this row will not appear when printing -->
	<div class="row no-print pull-right">
		<div class="col-xs-12">
			<button type="button" onclick="window.print();return false;" class="btn btn-primary"><i
					class="fa fa-print"></i> Print</button>
		</div>
		<hr>
	</div>
	<!-- info row -->
	<div class="row">
		<div class="col-xs-6">
			<center>
            <img width="70" src="<?= base_url().'assets/images/'.$setting->logo_surat ?>"></center><br>
			<strong>UNIT PEMBERANTASAN PUNGLI</strong><br>
			<strong>PROVINSI KEPULAUAN RIAU</strong><br>
			Jl. Hang Jebat 81 Nongsa, Batu Besar<br>
			<div style="font-size:13px">Telp/SMS 0821 7360 9888, saberpunglikepri@gmail.com</div>
			<hr style="margin-bottom:2px">
			<table border="0">
				<tr>
					<td style="padding-right:20px;">Nomor</td>
					<td style="padding-right:5px;">:</td>
					<td>B/192/VII/2020/UPP Prov.Kepri</td>
				</tr>
				<tr>
					<td style="padding-right:20px;">Klasifikasi</td>
					<td style="padding-right:5px;">:</td>
					<td>BIASA</td>
				</tr>
				<tr>
					<td style="padding-right:20px;">Lampiran</td>
					<td style="padding-right:5px;">:</td>
					<td>1 Eksamplar</td>
				</tr>
				<tr>
					<td style="padding-right:20px;">Perihal</td>
					<td style="padding-right:5px;">:</td>
					<td>laporan harian UPP Provinsi Kepri</td>
				</tr>
			</table>
		</div>

		<div class="col-xs-6" style="padding-left:100px">
			<div style="padding-top:160px">Batam, <?php echo $this->fungsi->tanggal_indo($date) ?></div>
			<br>
			<table>
					<tr>
						<td></td>
						<td>Kepada</td>
					</tr>
					<tr>
						<td style="vertical-align: top;padding-right:5px">Yth.</td>
						<td>IRWASUM POLRI<br>selaku<br>KETUA PELAKSANA SATGAS<br>SABER PUNGLI<br>di<br><br>Jakarta</td>
					</tr>
			</table>
		</div>
	</div>
	<!-- /.row -->
	<br>
	<!-- info row -->
	<div class="row">
		<div class="col-xs-12">
			<ol>
				<li>Rujukan :<br />
					<ol style="list-style-type: lower-alpha;">
						<li>Peraturan Presiden No. 87 Tahun 2016 tentang Satuan Tugas Sapu Bersih Pungutan Liar;</li>
						<li>Surat Edaran Mendagri Nomor 700/4277/SJ tanggal 11 November 2016 tentang Pembentukan Unit
							Satgas Saber Pungli Tingkat Provinsi dan Kab / Kota;</li>
						<li>Keputusan Gubernur Kepulauan Riau Nomor 49 Tahun 2019 tanggal 7 Januari 2019 tentang Satuan
							Tugas Sapu Bersih Pungutan Liar Provinsi Kepulauan Riau;</li>
					</ol>
				<li>Sehubungan dengan rujukan tersebut di atas, bersama ini kami laporkan hasil kegiatan Unit
					Pemberantasan Pungli (UPP) Provinsi Kepulauan Riau pada
                    <?php 
                    if ($startDate == $endDate) {
                        echo $this->fungsi->tanggal_indo2($startDate, true).', sebagai berikut :';
                    }else{
                        echo $this->fungsi->tanggal_indo2($startDate, true).' s/d '.$this->fungsi->tanggal_indo2($endDate, true).', sebagai berikut :';
                    }
                        $col = count($kegiatan);
                    ?>
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered tabel-rekap">
                            <thead>
                                <tr>
                                    <th style="background-color: #ccc !important;" rowspan="2">No</th>
                                    <th style="background-color: #ccc !important;" rowspan="2">UPP</th>
                                    <th style="background-color: #ccc !important;" colspan="<?= $col ?>">KEGIATAN</th>
                                    <th style="background-color: #ccc !important;" rowspan="2">JML GIAT</th>
                                    <th style="background-color: #ccc !important;" colspan="4">LAPORAN PENGADUAN</th>
                                    <th style="background-color: #ccc !important;" rowspan="2">JML ADUAN</th>
                                </tr>
                                <tr>
                                    <?php 
                                    $id_keg = array();
                                    foreach ($kegiatan as $keg) {
                                        $id_keg[] = $keg->id_kegiatan;
                                        echo '<th style="background-color: #ccc !important;">'. $keg->nama_kegiatan.'</th>';
                                    }
                                    ?>
                                    <th style="background-color: #ccc !important;">POSKO</th>
                                    <th style="background-color: #ccc !important;">SMS</th>
                                    <th style="background-color: #ccc !important;">EML</th>
                                    <th style="background-color: #ccc !important;">TLP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $ar = 0;
                                foreach ($upp as $u) {
                                    echo '<tr>
                                            <td>'.$no++.'</td>
                                            <td style="text-align:left;">'.$u->nama_upp.'</td>';
                                    // LOOPING DATA KEGIATAN
                                    $jml =0;
                                    for ($i=0; $i < count($id_keg); $i++) { 
                                        $this->db->from('kegiatan');
                                        $this->db->from('upp');
                                        $this->db->from('laporan');
                                        $this->db->where('laporan.id_kegiatan = kegiatan.id_kegiatan');
                                        $this->db->where('laporan.id_upp = upp.id_upp');
                                        $this->db->where('laporan.waktu_tgl BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                                        $this->db->where('laporan.id_kegiatan', $id_keg[$i]);
                                        $this->db->where('laporan.id_upp', $u->id_upp);
                                        $query3 = $this->db->get()->result();

                                        if (count($query3)==0) {
                                            echo '<td>-</td>';
                                        }else{
                                            echo '<td>'.count($query3).'</td>';
                                            $jml++;
                                        }
                                    }
                                    echo '<td style="background-color: #ccc !important;">'.$jml.'</td>';@$jum_total=$jum_total+$jml;

                                    // DATA PENGADUAN
                                    $jml_peng =0;
                                    $this->db->from('upp');
                                    $this->db->from('pengaduan');
                                    $this->db->where('pengaduan.id_upp = upp.id_upp');
                                    $this->db->where('pengaduan.tgl_pengaduan BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                                    $this->db->where('pengaduan.id_upp', $u->id_upp);
                                    $query11 = $this->db->get()->result();
                                    
                                    if (count($query11)==0) {
                                        echo '<td>-</td>';
                                        echo '<td>-</td>';
                                        echo '<td>-</td>';
                                        echo '<td>-</td>';
                                    }else{
                                        foreach($query11 as $dt11){
                                            echo '<td>'.$dt11->posko.'</td>'; @$jum_posko=$jum_posko+$dt11->posko;
                                            echo '<td>'.$dt11->sms.'</td>'; @$jum_sms=$jum_sms+$dt11->sms;
                                            echo '<td>'.$dt11->email.'</td>'; @$jum_email=$jum_email+$dt11->email;
                                            echo '<td>'.$dt11->telp.'</td>'; @$jum_telp=$jum_telp+$dt11->telp;
                                        }
                                        $jml_peng = $dt11->posko+$dt11->sms+$dt11->email+$dt11->telp;
                                    }
                                    echo '<td style="background-color: #ccc !important;">'.$jml_peng.'</td>';
                                    echo '</tr>';
                                }

                                echo '<tr>';
                                echo '<td  colspan="2">JUMLAH</td>';
                                //baris terakhir perulangan jumlah kegiatan
                                for ($i=0; $i < count($id_keg); $i++) { 
                                    $this->db->from('kegiatan');
                                    $this->db->from('laporan');
                                    $this->db->where('laporan.id_kegiatan = kegiatan.id_kegiatan');
                                    $this->db->where('laporan.waktu_tgl BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                                    $this->db->where('laporan.id_kegiatan', $id_keg[$i]);
                                    $this->db->group_by('laporan.id_kegiatan');
                                    $this->db->select('count(laporan.id_kegiatan) as jlh_keg');

                                    $query2 = $this->db->get()->row();
                                    // print_r(@$query2->jlh_keg);
                                    if (@$query2->jlh_keg=='') {
                                        echo '<td>0</td>';
                                    }else{
                                        echo '<td>'.@$query2->jlh_keg.'</td>';
                                    }
                                }
                                echo '<td>'.@$jum_total.'</td>';
                                echo '<td>'.@$jum_posko.'</td>';
                                echo '<td>'.@$jum_sms.'</td>';
                                echo '<td>'.@$jum_email.'</td>';
                                echo '<td>'.@$jum_telp.'</td>'; @$tot_pengaduan = $jum_posko+$jum_sms+$jum_email+$jum_telp;
                                echo '<td>'.@$tot_pengaduan.'</td>';
                                echo '</tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </li>
                <li>Demikian untuk menjadi maklum.</li>
			</ol>
		</div>
	</div>
	<!-- /.row -->

	<!-- /.row -->
	<div class="row">
		<div class="col-xs-5">
        <br><br><br><br><br>
        Tembusan :
        <ol>
            <li>Gubernur Kepri.</li>
            <li>Kapolda Kepri.</li>
            <li>Kajati Kepri.</li>
            <u><li>Kapolres/ta Jajaran Polda Kepri.</li></u>
        </ol>
		</div>
		<div class="col-xs-7" style="padding-left:80px;">
			<table border="0">
				<tr>
					<td>
						<center>KETUA PELAKSANA UNIT PEMBERANTASAN PUNGLI<br>
							PROVINSI KEPULAUAN RIAU<br><br><br><br><br>
							<?= $setting->nama_ketua ?>
                        <div style="text-decoration: overline;"><?= $setting->jabatan ?></div>
					</td>
				</tr>
			</table>

		</div>
	</div>
</section>
<!-- /.content -->