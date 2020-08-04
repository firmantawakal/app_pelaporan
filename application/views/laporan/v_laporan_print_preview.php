<style>
.invoice{
    font-family: 'Arial',sans-serif !important;
}
hr{
    margin-top: 2px;
    border-top: 1px solid black;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border-top: 1px solid #a2a0a0 !important;
    border: 1px solid #a2a0a0;
}
.number {
    padding: 2px !important;
}
</style>
    <!-- Main content -->
    <section class="invoice">
    <!-- this row will not appear when printing -->
<div class="row no-print pull-right">
    <div class="col-xs-12">
    <button type="button" onclick="window.print();return false;" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
    </div>
    <hr>
</div>
      <!-- info row -->
      <div class="row">
        <div class="col-sm-5">
            <center>
            <img width="70" src="<?= base_url().'assets/images/'.$setting->logo_surat ?>"><br>
            <strong>UNIT PEMBERANTASAN PUNGLI</strong><br>
            <strong>PROVINSI KEPULAUAN RIAU</strong><br>
            Jl. Hang Jebat 81 Nongsa, Batu Besar<br>
            Telp/SMS 0821 7360 9888, saberpunglikepri@gmail.com</center>
            <hr>
        </div>
      </div>
      <!-- /.row -->
        <br>
      <!-- info row -->
      <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <center><strong>LAPORAN HASIL KEGIATAN </strong><br>
            <strong>UNIT PEMBERANTASAN PUNGLI PROVINSI KEPULAUAN RIAU<br>
            <?php 
                    if ($startDate == $endDate) {
                        echo strtoupper($this->fungsi->tanggal_indo2($startDate, true));
                    }else{
                        echo strtoupper($this->fungsi->tanggal_indo2($startDate, true)).' S/D '.strtoupper($this->fungsi->tanggal_indo2($endDate, true));
                    }
            ?></strong>
            <!-- <hr> -->
        </div>
      </div>
      <!-- /.row -->

      <?php 
            $abj = 'A';
            $query3='';
            $role = $this->session->userdata('role');
            if ($role==1) {
                $this->db->from('kegiatan');
                $this->db->from('laporan');
                $this->db->where('laporan.id_kegiatan = kegiatan.id_kegiatan');
                $this->db->where('laporan.waktu_tgl BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                $this->db->group_by('laporan.id_kegiatan');
                $query3 = $this->db->get()->result();
            }else{
                $this->db->from('kegiatan');
                $this->db->from('laporan');
                $this->db->where('laporan.id_kegiatan = kegiatan.id_kegiatan');
                $this->db->where('laporan.waktu_tgl BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                $this->db->where('laporan.id_upp', $role);
                $this->db->group_by('laporan.id_kegiatan');
                $query3 = $this->db->get()->result();
            }
            
            // echo json_encode($query3);die;
            if(count($query3) > 0 ) {
                foreach ($query3 as $row3) {
                    $no = 1;
                    echo '<b>'.$abj++.'. '.strtoupper($row3->nama_kegiatan).'</b>'; ?>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>NO</th>
              <th style="width: 200px;">WAKTU</th>
              <th>TEMPAT</th>
              <th style="width: 80px;">PESERTA (JUMLAH)</th>
              <th>PELAKSANA</th>
              <th width="350px"  style="overflow: hidden">URAIAN KEGIATAN</th>
              <th width="300px">DOKUMENTASI</th>
            </tr>
            <tr style="background-color: #dcdcda;">
              <th style="background-color: #dcdcda !important;" class="number">1</th>
              <th style="background-color: #dcdcda !important;" class="number">2</th>
              <th style="background-color: #dcdcda !important;" class="number">3</th>
              <th style="background-color: #dcdcda !important;" class="number">4</th>
              <th style="background-color: #dcdcda !important;" class="number">5</th>
              <th style="background-color: #dcdcda !important;" class="number">6</th>
              <th style="background-color: #dcdcda !important;" class="number">7</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $query='';

                if ($role==1) {
                    $this->db->from('upp');
                    $this->db->from('laporan');
                    $this->db->where('laporan.id_kegiatan', $row3->id_kegiatan);
                    $this->db->where('laporan.id_upp = upp.id_upp');
                    $this->db->where('laporan.waktu_tgl BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                    $this->db->group_by('laporan.id_upp');
                    $query = $this->db->get()->result();
                }else{
                    $this->db->from('upp');
                    $this->db->from('laporan');
                    $this->db->where('laporan.id_kegiatan', $row3->id_kegiatan);
                    $this->db->where('laporan.id_upp = upp.id_upp');
                    $this->db->where('laporan.waktu_tgl BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                    $this->db->where('laporan.id_upp', $role);
                    $this->db->group_by('laporan.id_upp');
                    $query = $this->db->get()->result();
                }
                
                // print_r($query);die;
                if(count($query) > 0 ) {
                    foreach ($query as $row) {
                        echo '<tr><td colspan="7" style="background-color: #fbfb2c !important; padding: 4px"><b>UPP '.strtoupper($row->nama_upp).'</b></td></tr>';

                        $this->db->select('*');    
                        $this->db->from('laporan');
                        $this->db->where('laporan.waktu_tgl BETWEEN "'.$startDate.'"AND "'.$endDate.'" ');
                        $this->db->where('laporan.id_upp', $row->id_upp);
                        $this->db->where('laporan.id_kegiatan', $row3->id_kegiatan);
                        $this->db->join('upp', 'laporan.id_upp = upp.id_upp');
                        $this->db->join('kegiatan', 'laporan.id_kegiatan = kegiatan.id_kegiatan');
                        $this->db->order_by('waktu_tgl', 'DESC');
                        $query2 = $this->db->get()->result();
                        if(count($query2) > 0 ) {
                            foreach ($query2 as $row2) { ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $this->fungsi->tanggal_indo($row2->waktu_tgl, true).'<br>'.$row2->waktu_jam1.' s/d '.$row2->waktu_jam2.' WIB' ?></td>
                                    <td><?php echo $row2->tempat ?></td>
                                    <td><?php echo $row2->peserta ?></td>
                                    <td><?php echo $row2->pelaksana ?></td>
                                    <td><?php echo $row2->uraian_kegiatan ?></td>
                                    <td><img width="200" src="<?= base_url().'assets/images/laphar/'.$row2->dokumentasi ?>"></td>
                                </tr>
                <?php
                                    }
                                }
                            }
                        } ?>
                        </tbody>
                    </table>
                <?php
                    }
                }
            ?>
            
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
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