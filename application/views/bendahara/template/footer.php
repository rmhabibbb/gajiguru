 
    <!-- Jquery Core Js -->
    <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
    

    <!-- Bootstrap Core Js -->    <script src="<?=base_url('assets/js/materialize.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.js')?>"></script>
 

    <!-- Slimscroll Plugin Js -->
    <script src="<?=base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url('assets/plugins/node-waves/waves.js')?>"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?=base_url('assets/plugins/jquery-datatable/jquery.dataTables.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/jszip.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js')?>"></script>

    <!-- Multi Select Plugin Js -->
    <script src="<?=base_url('assets/plugins/multi-select/js/jquery.multi-select.js')?>"></script>
    <!-- Custom Js -->
    <script src="<?=base_url('assets/js/admin.js')?>"></script>
    <script src="<?=base_url('assets/js/pages/tables/jquery-datatable.js')?>"></script>

    <!-- Demo Js -->
    <script src="<?=base_url('assets/js/demo.js')?>"></script>
    

     <script>
        $(document).ready(function(){

          
            function odd(){
                var jumlah1 = parseInt($("#jam_mengajar").val()) + parseInt($("#transport").val())   + parseInt($("#wali_kelas").val()) + parseInt($("#piket").val()) + parseInt($("#gaji_pokok").val());
                var bilangan = jumlah1;
        
                var number_string = bilangan.toString(),
                    sisa    = number_string.length % 3,
                    rupiah  = number_string.substr(0, sisa),
                    ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                        
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                $("#jumlah1").html('Rp ' + rupiah);

                var jumlah2 = parseInt($("#bon").val()) + parseInt($("#kopresi_sekolah").val()) + parseInt($("#uang_amal").val()) + parseInt($("#kopresi_yplp").val()) + parseInt($("#iuaran_pgri").val());
                var bilangan2 = jumlah2;
        
                var number_string2 = bilangan2.toString(),
                    sisa2    = number_string2.length % 3,
                    rupiah2  = number_string2.substr(0, sisa2),
                    ribuan2  = number_string2.substr(sisa2).match(/\d{3}/g);
                        
                if (ribuan2) {
                    separator2 = sisa2 ? '.' : '';
                    rupiah2 += separator2 + ribuan2.join('.');
                }
                $("#jumlah2").html('Rp ' + rupiah2);

                var bilangan3 = jumlah1 - jumlah2;
        
                var number_string3 = bilangan3.toString(),
                    sisa3    = number_string3.length % 3,
                    rupiah3  = number_string3.substr(0, sisa3),
                    ribuan3  = number_string3.substr(sisa3).match(/\d{3}/g);
                        
                if (ribuan3) {
                    separator3 = sisa3 ? '.' : '';
                    rupiah3 += separator3 + ribuan3.join('.');
                }
                $("#total").html('Rp ' + rupiah3);


                $("#fjumlah1").val(jumlah1);
                $("#fjumlah2").val(jumlah2);
                $("#ftotal").val(jumlah1 - jumlah2);


            }
            

            odd();
           $("#transport").keyup(function(){ 
                odd(); 
            });  




        });
</script>
 
</body>

</html>
