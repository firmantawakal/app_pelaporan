<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data UPP
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
          <a href="<?php echo site_url('upp/create') ?>" class="btn btn-flat btn-primary">Add New </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover" style="width:100%">
            <thead>
              <tr>
                <th style="width: 10px;">No</th>
                <th style="width: 20px;">Action</th>
                <th>Nama UPP</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $no=1;
                foreach($upp as $data){
            ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td class="text-center">
                    <a href="<?php echo site_url('upp/update/'.$data->id_upp) ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                </td>
                <td><?php echo $data->nama_upp ?></td>
              </tr>
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