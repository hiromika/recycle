<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('user/profile');?>"><i class="fa fa-user"></i>Profile</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Profile</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo base_url('user/upPro') ?>" method="POST" class="form-horizontal" accept-charset="utf-8">
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">Username :</label>
                  <div class="col-sm-8">
                    <input name="username" value="<?php echo $user['username'] ?>" type="text" class="form-control" id="" placeholder="Enter ">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">Nama :</label>
                  <div class="col-sm-8">
                    <input name="nama" value="<?php echo $user['nama'] ?>" type="text" class="form-control" id="" placeholder="Enter ">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">Alamat :</label>
                  <div class="col-sm-8">
                    <textarea name="alamat" class="form-control"><?php echo $user['alamat'] ?></textarea>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">Kota/Kab :</label>
                  <div class="col-sm-8">
                    <?php showKota_id($user['kota_kab']); ?>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">No Telp :</label>
                  <div class="col-sm-8">
                    <input name="telp" value="<?php echo $user['telp'] ?>" type="number" class="form-control" id="" placeholder="Enter ">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">Email :</label>
                  <div class="col-sm-8">
                    <input name="email" value="<?php echo $user['email'] ?>" type="email" class="form-control" id="" placeholder="Enter ">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-2" for="l">Password :</label>
                  <div class="col-sm-8">
                    <input name="password" value="" type="password" class="form-control" id="" placeholder="Enter New Password">
                    <caption>Kosongkan jika tidak ingin mengganti password</caption>
                  </div>
                </div>
                
                <div class="col-md-10">
                <button type="submit" onclick="return confirm('Update data profile ? ')" class="btn btn-success pull-right">Update</button>
                </div>
              </form>
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
  