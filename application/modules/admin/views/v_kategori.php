<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semua Kategori
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/kategori');?>"><i class="fa fa-tags"></i> Kategori</a></li>
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
              <a href="<?php echo base_url('admin/kategori/tambah');?>" class="btn btn-success btn-sm pull-right">Tambah Kategori</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th width="1">No</th>
                  <th>Nama Kategori</th>
                  <th>Status</th>
                  <th width="1">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    foreach ($kategori as $d) {
                  ?>
                    <tr>
                      <td width="1"><?php echo $i?></td>
                      <td><?php echo $d->nama?></td>
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
                        <a href="<?php echo base_url('admin/kategori/edit/').$d->id_kategori?>" title="edit" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> </a>
                        <a href="<?php echo base_url('admin/kategori/doDelete/').$d->id_kategori?>" onclick="return confirm('Hapus kategori ini ?')"title="edit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> </a>
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
  