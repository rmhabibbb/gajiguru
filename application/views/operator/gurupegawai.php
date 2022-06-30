  
    <section class="content">
        
        <?= $this->session->flashdata('msg') ?>
          <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header"> 
                             <center><b>DATA GURU/PEGAWAI</b></center>
                        </div>
                        <div class="body">
                            <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-indigo">Tambah Data Guru/Pegawai</button></a> 

                            <br><br>

                            <div class="table-responsive">
                             <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                              <thead>
                                    <tr>   
                                        <th>NIP</th> 
                                        <th>Nama Lengkap</th>  
                                        <th>Jabatan</th>    
                                        <th>JK</th>        
                                        <th>TTL</th>      
                                        <th>Email</th>      
                                        <th>No. Telp</th>    
                                        <th>Alamat</th>    
                                        <th>Aksi</th> 
                                    </tr>
                                </thead>  
                            
                                <?php $i = 1; foreach ($list_data as $row): ?> 
  
                                  <tr> 
                                    <th> <?=$row->nip?> </th>
                                    <td> <?=$row->nama?> </td> 
                                   
                                    <td> <?=$this->Jabatan_m->get_row(['id_jabatan' => $row->id_jabatan])->nama_jabatan?> </td> 
                                    <td> <?=$row->jk?> </td> 
                                    <td> <?=$row->tmpt_lahir?>, <?= date('d M Y', strtotime($row->tgl_lahir)) ?> </td> 
                                    <td> <?=$row->email?> </td> 
                                    <td> <?=$row->telp?> </td> 
                                    <td> <?=$row->alamat?> </td>  
                                    <td> 
                                        <center>
                                            <a data-toggle="modal" data-target="#edit-<?=$row->nip?>" >
                                                <button class="btn  bg-indigo">Edit</button>
                                            </a>
                                            <a  data-toggle="modal" data-target="#delete-<?=$row->nip?>">
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
                <h4 class="modal-title" id="defaultModalLabel"><center>Form Tambah Guru/Pegawai</center></h4>
            </div>
            <div class="modal-body">
              <form action="<?= base_url('operator/add_gurupegawai')?>" method="Post"  >  
             
                     <table class="table table-bordered">  
                            <tr>   
                                <th>NIP</th> 
                                <th>
                                   <input type="text" required name="nip" class="form-control">
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Nama Lengkap</th> 
                                <th>
                                   <input type="text" required name="nama" class="form-control">
                                </th>  
                            </tr>  
                          
                            <tr>   
                                <th>Jabatan</th> 
                                <th> 
                                    <select class="form-control" name="id_jabatan" required>
                                        <option value="">Pilih jabatan</option>
                                        <?php  foreach ($list_jabatan as $k): ?>  
                                          <option value="<?=$k->id_jabatan?>"><?=$k->nama_jabatan?></option>
                                        <?php  endforeach; ?>
                                      </select>
                                </th>  
                            </tr>   
                            <tr>   
                                <th>Jenis Kelamin</th> 
                                <th> 
                                     <input name="jk" type="radio" id="jk1"  value="Laki - Laki" required /> 
                                    <label  for="jk1">Laki - Laki</label>
                                    <input name="jk" type="radio" id="jk2"   value="Perempuan" required />
                                    <label  for="jk2">Perempuan</label>
                                </th>  
                            </tr>
                            <tr>   
                                <th>Tempat Lahir</th> 
                                <th>
                                   <input type="text" required name="tmpt_lahir" class="form-control">
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Tanggal Lahir</th> 
                                <th>
                                   <input type="date" required name="tgl_lahir" class="form-control">
                                </th>  
                            </tr>
                            <tr>   
                                <th>Email</th> 
                                <th>
                                   <input type="email" required name="email" class="form-control">
                                </th>  
                            </tr>    
                            <tr>   
                                <th>No. Telp</th> 
                                <th>
                                   <input type="text" required name="telp" class="form-control">
                                </th>  
                            </tr> 
                            <tr>   
                                <th>Alamat</th> 
                                <th>
                                   <textarea type="text" required name="alamat" class="form-control"></textarea>
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
    <div class="modal fade" id="edit-<?=$row->nip?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title" id="defaultModalLabel"><center>Form Edit Data golongan</center></h4>
                </div>
                <div class="modal-body">
                  <form action="<?= base_url('operator/update_gurupegawai')?>" method="Post"  >  
                 
                         <table class="table table-bordered"> 
                               <tr>   
                                <th>NIP</th> 
                                <th>
                                   <input type="hidden" required name="nip_lama"  value="<?=$row->nip?>">
                                   <input type="text" required name="nip" class="form-control" value="<?=$row->nip?>">
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Nama Lengkap</th> 
                                <th>
                                   <input type="text" required name="nama" class="form-control" value="<?=$row->nama?>" >
                                </th>  
                            </tr>  
                     
                            <tr>   
                                <th>Jabatan</th> 
                                <th> 
                                    <select class="form-control" name="id_jabatan" required>
                                        <option value="<?=$row->id_jabatan?>"><?=$this->Jabatan_m->get_row(['id_jabatan' => $row->id_jabatan])->nama_jabatan?> </option>
                                        <?php  foreach ($list_jabatan as $k): ?>  
                                            <?php if ($k->id_jabatan != $row->id_jabatan) { ?> 
                                          <option value="<?=$k->id_jabatan?>"><?=$k->nama_jabatan?></option>
                                        <?php }  endforeach; ?>
                                      </select>
                                </th>  
                            </tr>   
                            <tr>   
                                <th>Jenis Kelamin</th> 
                                <th> 
                                    <input name="jk" type="radio" id="jk1-<?=$i?>" <?php if ($row->jk== "Laki - Laki") {echo "checked";}?>  value="Laki - Laki" required /> 
                                        <label  for="jk1-<?=$i?>">Laki - Laki</label>
                                        <input name="jk" type="radio" id="jk2-<?=$i?>" <?php if ($row->jk== "Perempuan") {echo "checked";}?>  value="Perempuan" required />
                                        <label  for="jk2-<?=$i++?>">Perempuan</label>
                                </th>  
                            </tr>
                            <tr>   
                                <th>Tempat Lahir</th> 
                                <th>
                                   <input type="text" required name="tmpt_lahir" class="form-control" value="<?=$row->tmpt_lahir?>">
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Tanggal Lahir</th> 
                                <th>
                                   <input type="date" required name="tgl_lahir" class="form-control" value="<?=$row->tgl_lahir?>">
                                </th>  
                            </tr>
                            <tr>   
                                <th>Email</th> 
                                <th>
                                   <input type="hidden" required name="email_lama" value="<?=$row->email?>">
                                   <input type="email" required name="email" class="form-control" value="<?=$row->email?>">
                                </th>  
                            </tr>    
                            <tr>   
                                <th>No. Telp</th> 
                                <th>
                                   <input type="text" required name="telp" class="form-control" value="<?=$row->telp?>">
                                </th>  
                            </tr> 
                            <tr>   
                                <th>Alamat</th> 
                                <th>
                                   <textarea type="text" required name="alamat" class="form-control"><?=$row->alamat?></textarea>
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

    <div class="modal fade" id="delete-<?=$row->nip?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data Guru/Pegawai?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan data ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('operator/delete_gurupegawai')?>" method="Post" >  
                                        <input type="hidden" value="<?=$row->email?>" name="email">  
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