  
    <section class="content">
        
        <?= $this->session->flashdata('msg') ?>
          <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header"> 
                             <center><b>DATA GOLONGAN</b></center>
                        </div>
                        <div class="body">
                            <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-indigo">Tambah Data Golongan</button></a> 

                            <br><br>

                            <div class="table-responsive">
                             <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                              <thead>
                                    <tr>   
                                        <th>ID Golongan</th> 
                                        <th>Nama Golongan</th>    
                                        <th>Aksi</th>   
                                    </tr>
                                </thead>  
                            
                                <?php $i = 1; foreach ($list_data as $row): ?> 
  
                                  <tr> 
                                    <th> <?=$row->id_golongan?> </th>
                                    <td> <?=$row->nama_golongan?> </td>  
                                    <td> 
                                       <?php if ($row->id_golongan > 1) { ?>
                                             <center>
                                            <a data-toggle="modal" data-target="#edit-<?=$row->id_golongan?>" >
                                                <button class="btn  bg-indigo">Edit</button>
                                            </a>
                                            <a  data-toggle="modal" data-target="#delete-<?=$row->id_golongan?>">
                                                <button class="btn  bg-red" style="margin-top: 3px">Hapus</button>
                                            </a>
                                        </center>
                                    <?php } ?>
                                    </td>
                                  </tr>


                                  <?php endforeach; ?>
                              </table> 
                           </div>

                        </div>
                    </div>
                </div>
            </div> 
       
    </section>


 
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <h4 class="modal-title" id="defaultModalLabel"><center>Form Tambah golongan</center></h4>
            </div>
            <div class="modal-body">
              <form action="<?= base_url('operator/add_golongan')?>" method="Post"  >  
             
                     <table class="table table-bordered"> 
                            
                            <tr>   
                                <th>Nama golongan</th> 
                                <th>
                                   <input type="text" required name="nama" class="form-control">
                                </th>  
                            </tr>  
                    </table>
             
            <input  type="submit" class="btn bg-indigo btn-block"  name="tambah" value="Tambah">  <br><br>
      
                <?php echo form_close() ?> 
            </div> 
            <div class="modal-footer"> 
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> 

 
<?php $i = 1; foreach ($list_data as $row): ?> 
    <div class="modal fade" id="edit-<?=$row->id_golongan?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title" id="defaultModalLabel"><center>Form Edit Data golongan</center></h4>
                </div>
                <div class="modal-body">
                  <form action="<?= base_url('operator/update_golongan')?>" method="Post"  >  
                 
                         <table class="table table-bordered"> 
                                <tr>   
                                    <th>ID golongan</th> 
                                    <th> 
                                       <input type="text" required value="<?=$row->id_golongan?>" name="id" class="form-control" readonly>
                                    </th>  
                                </tr> 
                                <tr>   
                                    <th>Nama golongan</th> 
                                    <th>
                                       <input type="text" required value="<?=$row->nama_golongan?>" name="nama" class="form-control">
                                    </th>  
                                </tr>  
                        </table>
                 
                <input  type="submit" class="btn bg-indigo btn-block"   name="update" value="Edit">  <br><br>
          
                    <?php echo form_close() ?> 
                </div> 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-<?=$row->id_golongan?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data golongan?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan data ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('operator/delete_golongan')?>" method="Post" >  
                                        <input type="hidden" value="<?=$row->id_golongan?>" name="id">  
                                        <input  type="submit" class="btn bg-red btn-block "  name="hapus" value="Ya">
                                         
                                    </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                          <button type="button"  class="btn bg-green btn-block" data-dismiss="modal">Tidak</button>
                                    </div>
                            <?php echo form_close() ?> 
                                </div>
                        </div> 
                    </div>
                </div>
    </div>
<?php endforeach; ?>