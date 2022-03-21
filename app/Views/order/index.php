<?= $this->extend('layout/default') ?>

<?= $this->section('css') ?>
  <!-- Data table Css -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Data Order<a href="<?= site_url('/order/new') ?>" class="btn btn-primary">Tambah Data</a></h3> 
                    <hr>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Data Order</li>
                      </ol>
                    </nav>
                  </div>
                 <div class="card-body"> 
                    <div class="table-responsive">                        
                        <div class="flash-data" data-flashdata="<?= session()->get('success'); ?>"> <?php session()->remove('success'); ?></div>
                        <div class="flash-data" data-flashdata="<?= session()->get('error'); ?>"> <?php session()->remove('error'); ?></div>
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>ID ORDER</th>
                            <th>Nomer Meja</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th class="text-center">Detail Pesanan</th>
                            <th>Status Order</th>
                            <th class="text-center">Order Menu</th>
                            <th>Transaksi</th>
                            <th class="text-center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
   
                          foreach ($order as $key =>$i ) :
                            $id_order = $i->id_order;
                            $pelanggan = $i->nama_pelanggan;
                            $tanggal = $i->tanggal;
                            $username =$i->username;
                            $meja = $i->no_meja;
                  
                            $stts_or = $i->status_order;
                          ?>
                            <tr>
                              <td><?= $key + 1 ?></td>
                              <td><?= $id_order ?></td>
                              <td><?= $meja ?></td>
                              <td><?= $pelanggan ?></td>
                              <td><?= $tanggal ?></td>
                              <td><?= $username ?></td>

                              <td>
                                    <table class="table table-striped table-hover" id="save-stage">
                                      <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <?php $detail = $det->getDataById($id_order);          
                                             foreach ($detail as $key => $d) :
                                              $id_menu = $d->id_menu;
                                              $nama_menu = $d->nama_menu;
                                              $qty = $d->qty;
                                              $harga = $d->harga;
                                            ?>
                                             <tr>
                                               <td><?= $key +1; ?></td>
                                                <td><?= $nama_menu; ?></td>
                                                <td class="text-center"><?= $qty; ?></td>
                                                <td><?= $harga; ?></td>
                                                <td><form action="<?= site_url('detaildel/'.$id_order.'/'.$id_menu) ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>            
                                                    <button class="btn btn-rounde btn-danger btn-delete">
                                                      <i class="fas fa-times"></i></button>
                                                    </form>  
                                                    
                                                </td>
                                            </tr>
                                          <?php endforeach; ?>
                                      </tbody>
                                    </table>
                              </td>
                              <td>
                                <?php if ($stts_or =='Sudah_Bayar') { ?>
                                <div class='badge badge-success'>Sudah Bayar </div>
                                <?php } else {?>
                                  <div class='badge badge-danger'>Belum Bayar </div>
                                 <?php } ?>
                              </td>
                              <td>
                                <button type="button" class="btn btn-icon btn-primary" id="btn-pesan" data-id="<?= $id_order ?>" data-toggle="modal" data-target="#ModalPesan"><i class="fas fa-plus"></i></button>
                              </td>
                              <td class="text-center">
                              <?php if ($stts_or !='Sudah_Bayar') { ?>
                                  <button class="btn btn-success btn-outline" id="btn-bayar" data-id="<?= $id_order ?>"  data-total="<?= $harga * $qty?>" data-toggle="modal" data-target="#ModalTransaksi">Bayar</button>
                                <?php } else {?>
                                  <a href="<?= site_url('order/rincian/'.$id_order) ?>" class="btn btn-info">Rincian</a>
                                <?php } ?>
                              </td>
                                <td>
                                <form action="<?= site_url('order/delete/'.$id_order) ?>" method="post" class="d-inline" onsubmit="return confirm('data akan dihapus?')">
                                   <?= csrf_field(); ?>            
                                  <button class="btn btn-icon btn-danger btn-delete">
                                    <i class="fas fa-trash"></i></button>
                                  </form>   
                              </td>
                            </tr>
                          <?php  endforeach; ?>


                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>  
        </section>

        <!-- modal tambah pesanan -->
        <div class="modal fade" id="ModalPesan" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Tambah Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?= base_url('/dorder') ?>" method="POST">
               
                  <div class="form-group">
                    <label>ID ORDER</label>
                    <div class="input-group">
                      <input id="id_order" type="hidden" class="form-control" name="id_order">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Menu</label>
                    <div class="input-group">
                      <select name="id_menu" id="" class="form-control">
                          <?php foreach ($menu as $key => $value) : ?>
                          <option value="<?= $value->id_menu; ?>"><?= $value->nama_menu; ?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <div class="input-group">
                      <input type="number" class="form-control" min="0" name="qty">
                    </div>
                  </div>  
                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">Tambah</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- end modal -->

        <!-- modal bayar -->
        <div class="modal fade" id="ModalTransaksi" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Bayar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?= base_url('/bayar') ?>" method="POST">
                <input type="hidden" name="id_user" value="<?= userLogin()->id_user ?>">
                      <input id="id_order"  type="hidden" class="form-control" name="id_order">
                  <div class="form-group">
                    <label>Total Harga</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                             <div class="input-group-text">
                          Rp
                         </div>
                        </div>
                      <input id="total" type="number" class="form-control" name="total" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Bayar</label>
                    <div class="input-group">
                         <div class="input-group-prepend">
                             <div class="input-group-text">
                          Rp
                         </div>
                        </div>
                      <input type="number" class="form-control" min="0" name="total_bayar" id="total_bayar" required="required">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">Bayar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- end modal -->

<?= $this->endSection(); ?>

<?= $this->section('footer') ?>
<!-- JS Libraies -->
  <script src="<?= base_url(); ?>/template/assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?= base_url(); ?>/template/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url(); ?>/template/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?= base_url(); ?>/template/assets/bundles/jquery-ui/getId.js"></script>

   <!-- Page Specific JS File -->
   <script src="<?= base_url(); ?>/template/assets/js/page/datatables.js"></script>

   <script src="<?= base_url(); ?>/template/assets/bundles/sweetalert2/sweetalert2.all.js"></script>
   <script src="<?= base_url(); ?>/template/assets/js/myscript.js"></script>
  
   


  <?= $this->endSection(); ?>