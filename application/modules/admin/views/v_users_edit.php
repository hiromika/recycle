<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/users');?>"><i class="fa fa-user"></i> Users</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="<?php echo base_url('admin/users/update'); ?>" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_users" value="<?php echo $users->id_users?>">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" name="username" value="<?php echo $users->username?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Users</label>
              <div class="col-sm-10">
                <input type="text" name="nama" value="<?php echo $users->nama?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
    <!--       <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Saldo</label>
              <div class="col-sm-10">
                <input type="number" name="jumlah" value="<?php echo $users->jum?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div> -->
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-2">
                <select name="status" class="form-control">
                  <option value="1" <?php if($users->aktif == 1){echo 'selected';} ?>>Aktif</option>
                  <option value="0" <?php if($users->aktif == 0){echo 'selected';} ?>>Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">KTP</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="ktp">
                <p class="help-block">extensi file harus jpg atau png</p>
                <img src="<?php echo base_url('ktp/').$users->id_users.$users->extensi?>" width="256">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  