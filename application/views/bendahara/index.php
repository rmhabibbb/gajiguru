  
    <section class="content">
        
        <?= $this->session->flashdata('msg') ?>
          <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb breadcrumb-bg-indigo align-left">
                    <li><a href="<?=base_url()?>"><i class="material-icons">apps</i> Beranda</a></li> 
                </ol>
                    <div class="card">
                       
                        <div class="body">
                             <h2>Selamat Datang, <?=$profil->email?>!</h2>  
                             <hr> 
                               <a data-toggle="modal" data-target="#search" href="" style="text-decoration:none">
                                    <div class="info-box-4 hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons col-indigo">print</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">GURU/PEGAWAI</div>
                                            <div class="number">CETAK SLIP GAJI</div>
                                        </div>
                                    </div>
                                </a>  
                        </div>
                    </div>
                </div>
            </div> 
       
    </section>
<div class="modal fade" id="search" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <h4 class="modal-title" id="defaultModalLabel"><center>Cari Slip Gaji</center></h4>
            </div>
            <div class="modal-body">
              <form action="<?= base_url('bendahara/slipgaji')?>" method="Post"  >  
             
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
                                <th>Bulan</th> 
                                <th>
                                   <input type="number" class="form-control" name="bulan" value="<?=date('m')?>"  required autofocus  >
                                </th>  
                            </tr>  
                            <tr>   
                                <th>Tahun</th> 
                                <th>
                                   <input type="number" class="form-control" name="tahun" value="<?=date('Y')?>" required autofocus  max="<?=date('Y')?>">
                                </th>  
                            </tr>  
                    </table>
             
            <input  type="submit" class="btn bg-indigo btn-block"  name="cari" value="Cari">  <br><br>
      
                <?php echo form_close() ?> 
            </div> 
            <div class="modal-footer"> 
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> 

 