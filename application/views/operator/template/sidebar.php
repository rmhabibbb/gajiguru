<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        
                <div class="menu">
                    <ul class="list">
                        <li class="header">Menu </li>
                        <!-- if unconfirmed -->

                        <?php if ($index == 1): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('operator')?>">
                                <i class="material-icons">apps</i>
                                <span>Beranda</span>
                            </a>
                         </li>   
                         <?php if ($index == 6): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('operator/jammengajar')?>">
                                <i class="material-icons">access_time</i>
                                <span>Jam Mengajar</span>
                            </a>
                         </li>  
                        <li class="header">Kelola Data </li>

                         <?php if ($index == 2): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('operator/gurupegawai')?>">
                                <i class="material-icons">assignment_ind</i>
                                <span>Guru/Pegawai</span>
                            </a>
                         </li>   

                         <?php if ($index == 3): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('operator/jabatan')?>">
                                <i class="material-icons">chrome_reader_mode</i>
                                <span>Jabatan</span>
                            </a>
                         </li>   

                          
                          <?php if ($index == 5): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('operator/pengguna')?>">
                                <i class="material-icons">person</i>
                                <span>Pengguna</span>
                            </a>
                         </li>   
                          

                        <li class="header">Pengaturan</li>
                         <?php if ($index == 7): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('operator/profil')?>">
                                <i class="material-icons">person_pin</i>
                                <span>Profil</span>
                            </a>
                         </li>  
                         <li> 
                            <a href="<?=base_url('logout')?>">
                                <i class="material-icons">input</i>
                                <span>Logout</span>
                            </a>
                         </li>   
                   
                         
                    </ul>
                </div> 
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                 
            </div>
            <div class="version">
                
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    
    <!-- #END# Right Sidebar -->
</section>
