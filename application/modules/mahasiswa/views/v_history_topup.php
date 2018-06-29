<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        History Top Up
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('mahasiswa/topup/history');?>"><i class="fa fa-user"></i> Mahasiswa</a></li>
        <li class="active">History Top Up</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <a href="<?php echo base_url('mahasiswa/topup/tambah');?>" class="btn btn-success btn-sm pull-right">Top Up</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th width="1"></th>
                  <th>Waktu</th>
                  <th>Saldo</th>
                  <th width="1">Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    foreach ($history as $d) {
                  ?>
                    <tr>
                      <td>
                        <a href="<?php echo base_url('mahasiswa/topup/detail_history/').$d->id_topup?>" title="detail" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                      </td>
                      <td><?php echo $d->timestamp?></td>
                      <td><?php echo $d->jumlah?></td>
                      <?php
                        if($d->validasi == 1){
                      ?>
                      <td><span class="label label-success">Valid</span></td> 
                      <?php 
                        }else{
                      ?>
                      <td><span class="label label-danger">Tidak Valid</span></td>
                      <?php   
                        }
                      ?>
                    </tr>
                  <?php
                      $i++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  