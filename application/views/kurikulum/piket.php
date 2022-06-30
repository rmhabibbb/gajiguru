  
    <section class="content">
        
        <?= $this->session->flashdata('msg2') ?>
          <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header"> 
                             <center><b>DATA PIKET</b></center>
                        </div>
                        <div class="body">
                            <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-indigo">Tambah Data</button></a> 

                            <br><br>

                            <div class="table-responsive">
                             <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                              <thead>
                                    <tr>   
                                        <th>No.</th>
                                        <th>NIP</th> 
                                        <th>Nama Guru</th> 
                                        <th>Hari Piket</th> 
                                        <th>Keterangan</th>      
                                        <th>Aksi</th> 
                                    </tr>
                                </thead>  
                            
                                <?php $i = 1; foreach ($list_data as $row): ?> 
  
                                  <tr> 
                                    <th> <?=$i++?> </th>
                                    <td> <?=$row->nip?> </td> 
                                    <td> <?=$this->GuruPegawai_m->get_row(['nip' => $row->nip])->nama?> </td>  
                                    <td> <?=$row->hari_piket?> </td>  
                                    <td> <?=$row->keterangan?> </td>  
                                    <td> 
                                        <center>
                                            <a data-toggle="modal" data-target="#edit-<?=$row->id_piket?>" >
                                                <button class="btn  bg-indigo">Edit</button>
                                            </a>
                                            <a  data-toggle="modal" data-target="#delete-<?=$row->id_piket?>">
                                                <button class="btn  bg-red" style="margin-top: 3px">Hapus</button>
                                            </a>
                                        </center>
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
                <h4 class="modal-title" id="defaultModalLabel"><center>Form Tambah Data</center></h4>
            </div>
            <div class="modal-body">
              <form action="<?= base_url('kurikulum/add_piket')?>" method="Post"  >  
             
                     <table class="table table-bordered"> 
                             
                            <tr>   
                                <th>Guru</th> 
                                <th>
                                   <select class="form-control" name="nip" required>
                                        <option value="">Pilih Guru</option>
                                        <?php  foreach ($list_guru as $k): ?>   
                                          <option value="<?=$k->nip?>"><?=$k->nama?></option>
                                        <?php  endforeach; ?>
                                      </select>
                                </th>  
                            </tr>  
                            
                            <tr>   
                                <th>Hari Piket</th> 
                                <th> 
                                     <input type="text" name="hari_piket"  required class="form-control" >
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Keterangan</th> 
                                <th> 
                                     <textarea type="text" name="keterangan"  class="form-control" ></textarea>
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
    <div class="modal fade" id="edit-<?=$row->id_piket?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title" id="defaultModalLabel"><center>Form Edit Data</center></h4>
                </div>
                <div class="modal-body">
                  <form action="<?= base_url('kurikulum/update_piket')?>" method="Post"  >  
                        <input type="hidden" name="id" value="<?=$row->id_piket?>">
                         <table class="table table-bordered"> 
                            <tr>   
                                <th>Guru</th> 
                                <th>
                                  <?=$row->nip?> - <?=$this->GuruPegawai_m->get_row(['nip' => $row->nip])->nama?>
                                </th>  
                            </tr>  
                            
                            <tr>   
                                <th>Hari Piket</th> 
                                <th> 
                                     <input type="text" name="hari_piket"  required class="form-control" value="<?=$row->hari_piket?>">
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Keterangan</th> 
                                <th> 
                                     <textarea type="text" name="keterangan"  class="form-control" ><?=$row->keterangan?></textarea>
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

    <div class="modal fade" id="delete-<?=$row->id_piket?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data ?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan data ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('kurikulum/delete_piket')?>" method="Post" >  
                                        <input type="hidden" value="<?=$row->id_piket?>" name="id">  
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