<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/users');?>"><i class="fa fa-user"></i> users</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <a href="<?php echo base_url('admin/users');?>" class="btn btn-info btn-sm pull-right">Kembali</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table class="table table-responsive">
                <caption>Info users</caption>
                <thead>
                  <tr>
                    <th style="width: 10%;">Nama</th>
                    <th style="width: 5%;">:</th>
                    <td><?php echo $mhs['nama']; ?></td>
                  </tr> 
                  <tr>
                    <th style="width: 10%;">Alamat</th>
                    <th style="width: 5%;">:</th>
                    <td><?php echo $mhs['alamat']; ?>, <?php getKota($mhs['kota_kab']); ?></td>
                  </tr> 
                  <tr>
                    <th style="width: 10%;">No Telp</th>
                    <th style="width: 5%;">:</th>
                    <td><?php echo $mhs['telp']; ?></td>
                  </tr>
                  <tr>
                    <th style="width: 10%;">KTP</th>
                    <th style="width: 5%;">:</th>
                    <td><img src="<?php echo base_url('ktp/'.$mhs['id_users'].$mhs['extensi']) ?>" alt="" style="width: 150px; height: 100px;" class="img img-thumbnail img-fluid"></td>
                  </tr>
                </thead>
              </table>
              <hr>
              <!-- Trigger the modal with a button -->
              <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Tambah Saldo</button>
              <hr>
              <table id="example1" class="table table-bordered table-hover table-striped table-hover">
                <caption>History Top Up</caption>
                <thead>
                <tr>
                  <th width="1">No</th>
                  <th style="display: none;">id</th>
                  <th>Waktu</th>
                  <th>Keterangan</th>
                  <th>Saldo</th>
                  <th style="display: none;">sts</th>
                  <th width="1">Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    foreach ($history as $d) {
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td style="display: none;"><?php echo $d->id_topup ?></td>
                      <td><?php echo $d->timestamp?></td>
                      <td><?php echo $d->keterangan?></td>
                      <td><?php echo $d->jumlah?></td>
                      <td style="display: none;"><?php echo $d->validasi?></td>
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
                      <td>
                        <a href="<?php echo base_url('admin/users/detail_history/').$d->id_topup?>" title="detail" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                        <a href="#" title="edit" class="btn btn-xs btn-success edit"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('admin/topup/doDelete/').$d->id_topup.'/'.$id_users.'/3'?>" onclick="return confirm('Hapus saldo in ?')" title="detail" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php
                      $i++;
                    }
                  ?>
                </tbody>
              </table> -->
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
  
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Saldo</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo base_url('admin/topup/addSaldo'); ?>" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="id_users" value="<?php echo $id_users; ?>" placeholder="">
          <input type="hidden" name="sts" value="3" placeholder="">


          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah</label>
              <div class="col-sm-10">
                <input type="number" name="jumlah" value="" class="form-control" placeholder="">
              </div>
            </div>
          </div>
           <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="keterangan" value="" placeholder="Keterangan">
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
    </div>

  </div>
</div>

  <!-- Modal -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Saldo</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo base_url('admin/topup/editSaldo'); ?>" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_topup" id="id_topup" value="" placeholder="">
          <input type="hidden" name="id_users" value="<?php echo $id_users; ?>" placeholder="">
          <input type="hidden" name="sts" value="3" placeholder="">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah</label>
              <div class="col-sm-10">
                <input type="number" name="jumlah" id="jumlah" value="" class="form-control" placeholder="">
              </div>
            </div>
          </div>
           <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="keterangan" id="keterangan" value="" placeholder="Keterangan">
              </div>
            </div>
          </div> 
           <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                  <select name="validasi" class="status" id="status" class="form-control">
                    <option value="1">Valid</option>
                    <option value="0">Tidak Valid</option>
                  </select>
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
    </div>

  </div>
</div>


<script type="text/javascript">
  $('.edit').click(function() {
    $('#edit').modal({
            show : true,
            backdrop : 'static',
            keyboard : false,
    });
    $("#id_topup").val($(this).closest('tr').children()[1].textContent);
    $("#jumlah").val($(this).closest('tr').children()[4].textContent);
    $("#keterangan").val($(this).closest('tr').children()[3].textContent);
    $("#status").val($(this).closest('tr').children()[5].textContent);
  });
</script>