  
    <section class="content">
        
        <?= $this->session->flashdata('msg') ?>
          <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header"> 
                             <center><b>DATA PENGGUNA</b></center>
                        </div>
                        <div class="body">
                            <a   data-toggle="modal" data-target="#tambah"  href=""><button class="btn bg-indigo">Tambah Data Pengguna Baru</button></a> 

                            <br><br>

                            <div class="table-responsive">
                             <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                              <thead>
                                    <tr>   
                                        <th>No.</th> 
                                        <th>Email</th>    
                                        <th>Role</th>    
                                        <th>Aksi</th>   
                                    </tr>
                                </thead>  
                            
                                <?php $i = 1; foreach ($list_data as $row): ?> 
  
                                  <tr> 
                                    <th> <?=$i?> </th>
                                    <td> <?=$row->email?> </td>  
                                    <td>
                                        <?php 
                                            if ($row->role == 1) {
                                                echo "Operator";
                                            }elseif ($row->role == 2) {
                                                echo "Kurikulum";
                                            }elseif ($row->role == 3) {
                                                echo "Bendahara";
                                            }
                                        ?>
                                    </td>
                                    <td>  
                                             <center>
                                            <a data-toggle="modal" data-target="#gp-<?=$i?>" >
                                                <button class="btn  bg-blue">Ganti Password</button>
                                            </a>
                                            <a data-toggle="modal" data-target="#edit-<?=$i?>" >
                                                <button class="btn  bg-indigo">Edit</button>
                                            </a>
                                            <a  data-toggle="modal" data-target="#delete-<?=$i++?>">
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
                <h4 class="modal-title" id="defaultModalLabel"><center>Form Tambah Pengguna</center></h4>
            </div>
            <div class="modal-body">
              <form action="<?= base_url('operator/add_pengguna')?>" method="Post"  >  
             
                     <table class="table table-bordered"> 
                            
                            <tr>   
                                <th>Email</th> 
                                <th>
                                   <input type="email" required name="email" class="form-control">
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Password</th> 
                                <th>
                                   <input type="password" required name="password" class="form-control">
                                </th>  
                            </tr>  

                            <tr>   
                                <th>Role</th> 
                                <th>
                                    <input name="role" type="radio" id="role1"  value="1" required /> 
                                    <label  for="role1">Operator</label>
                                    <input name="role" type="radio" id="role2"   value="2" required />
                                    <label  for="role2">Kurikulum</label>
                                    <input name="role" type="radio" id="role3"   value="3" required />
                                    <label  for="role3">Bendahara</label>
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
    <div class="modal fade" id="gp-<?=$i?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title" id="defaultModalLabel"><center>Form Ganti Password</center></h4>
                </div>
                <div class="modal-body">
                  <form action="<?= base_url('operator/gantipass_pengguna')?>" method="Post"  >  
                 
                         <table class="table table-bordered"> 
                            <tr>   
                                <th>Email</th> 
                                <th>
                                   <input type="hidden" required name="email" value="<?=$row->email?>">
                                   <?=$row->email?>
                                </th>  
                            </tr>   
                            <tr>   
                                <th>Password Baru</th> 
                                <th> 
                                   <input type="password" required class="form-control" name="pass1" >
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Konfirmasi Password Baru</th> 
                                <th> 
                                   <input type="password" required class="form-control" name="pass2" >
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
    <div class="modal fade" id="edit-<?=$i?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h4 class="modal-title" id="defaultModalLabel"><center>Form Edit Data Pengguna</center></h4>
                </div>
                <div class="modal-body">
                  <form action="<?= base_url('operator/update_pengguna')?>" method="Post"  >  
                 
                         <table class="table table-bordered"> 
                            <tr>   
                                <th>Email</th> 
                                <th>
                                   <input type="hidden" required name="email_lama" value="<?=$row->email?>">
                                   <input type="email" required name="email" class="form-control" value="<?=$row->email?>">
                                </th>  
                            </tr>   
                            <tr>   
                                <th>Role</th> 
                                <th>
                                    <input name="role" type="radio" id="role1-<?=$i?>" <?php if ($row->role== 1) {echo "checked";}?>  value="1" required /> 
                                    <label  for="role1-<?=$i?>">Operator</label>
                                    <input name="role" type="radio" id="role2-<?=$i?>" <?php if ($row->role== 2) {echo "checked";}?>    value="2" required />
                                    <label  for="role2-<?=$i?>">Kurikulum</label>
                                    <input name="role" type="radio" id="role3-<?=$i?>" <?php if ($row->role== 3) {echo "checked";}?>    value="3" required />
                                    <label  for="role3-<?=$i?>">Bendahara</label>
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

    <div class="modal fade" id="delete-<?=$i?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <h4 class="modal-title" id="defaultModalLabel"><center>Hapus data pengguna?</center></h4> 
                            <center><span style="color :red"><i>Semua data yang terkait dengan data ini akan dihapus.</i></span></center>
                        </div>
                        <div class="modal-body"> 
                       
                         <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <form action="<?= base_url('operator/delete_pengguna')?>" method="Post" >  
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
<?php $i++; endforeach; ?>