<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semua Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/users');?>"><i class="fa fa-user"></i> Users</a></li>
        <li class="active">Semua</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <a href="<?php echo base_url('admin/users/tambah');?>" class="btn btn-success btn-sm pull-right">Tambah Users</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Nama Users</th>
                  <!-- <th>Saldo</th> -->
                  <th>Status</th>
                  <th width="1">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    foreach ($users as $d) {
                  ?>
                    <tr>
                      <td width="1"><?php echo $i?></td>
                      <td><?php echo $d->username?></td>
                      <td><?php echo $d->nama?></td>
                      <!-- <td class="text-right"><?php echo $d->saldo?></td> -->
                      <?php
                        if($d->aktif == 1){
                      ?>
                      <td><span class="label label-success">Aktif</span></td> 
                      <?php 
                        }else{
                      ?>
                      <td><span class="label label-danger">Tidak Aktif</span></td>
                      <?php   
                        }
                      ?>
                      <td>
                        <a href="<?php echo base_url('admin/users/detail/').$d->id_users?>" title="history topup" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                        <a href="<?php echo base_url('admin/users/edit/').$d->id_users?>" title="edit" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo base_url('admin/users/doDelete/').$d->id_users?>" title="Delete" onclick="return confirm('Hapus user ini ?')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
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
  