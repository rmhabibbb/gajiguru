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
                            <a href="<?=base_url('bendahara')?>">
                                <i class="material-icons">apps</i>
                                <span>Beranda</span>
                            </a>
                         </li>   
                         <?php if ($index == 2): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('bendahara/laporan')?>">
                                <i class="material-icons">assignment</i>
                                <span>Laporan Gaji Bulanan</span>
                            </a>
                         </li>  


                         <?php if ($index == 3): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('bendahara/potongan')?>">
                                <i class="material-icons">money_off</i>
                                <span>Potongan Gaji Harian</span>
                            </a>
                         </li>  

  
                     
                         <?php if ($index == 5): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('bendahara/gajijabatan')?>">
                                <i class="material-icons">monetization_on</i>
                                <span>Gaji Jabatan</span>
                            </a>
                         </li>   

                        <li class="header">Pengaturan</li>
                         <?php if ($index == 7): ?>
                          <li class="active">
                        <?php else: ?>
                          <li>
                        <?php endif; ?>
                            <a href="<?=base_url('bendahara/profil')?>">
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
