

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->


<script>
  $(function () {
   //Initialize Select2 Elements
    $('.modal').on('shown.bs.modal', function (e) {
    $(this).find('#select2').select2({
        dropdownParent: $(this).find('.modal-content')
    });
})

    // $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $(document).ready(function() {
        $('#example6').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );

    // $("#example6").DataTable({
    //   "paging": true,
    //     "lengthChange": true,
    //     "lengthMenu": [0, 5, 10, 20,],
    //     "pageLength": 5,
    //     "searching": true,
    //     "ordering": false,
    //     // "info": true,
    //     "autoWidth": false,
    //     "responsive": true,
    //   "buttons": ["excel", "pdf", "print"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": true,
      "ordering": false,
      // "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example3').DataTable( {
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [0, 5, 10, 20,],
        "pageLength": 5,
        "searching": true,
        "ordering": false,
        // "info": true,
        "autoWidth": false,
        "responsive": true,
    } );    
    $('#example4').DataTable( {
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [0, 5, 10, 20,],
        "pageLength": 5,
        "searching": true,
        "ordering": false,
        // "info": true,
        "autoWidth": false,
        "responsive": true,
    } );    
    $('#example5').DataTable( {
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [0, 5, 10, 20,],
        "pageLength": 5,
        "searching": true,
        "ordering": false,
        // "info": true,
        "autoWidth": false,
        "responsive": true,
    } );

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "lengthMenu": [0, 5, 10, 20,],
      "pageLength": 5,
      "searching": true,
      "ordering": false,
      // "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  });
</script>
<!-- Page specific script -->
<script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });
</script>
<script type="text/javascript">
    function previewImg(){
        const profile = document.querySelector('#profil');
        const profileLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        profileLabel.textContent = profile.files[0].name;

        const fileProfile = new FileReader();
        fileProfile.readAsDataURL(profile.files[0]);

        fileProfile.onload = function(e){
            imgPreview.src = e.target.result;
        }
    }
</script>

<script>
    function kekata(n){
        var ang = new Array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
        var tbr;

        // var total_tarik = document.getElementById()

        if (n<12) {tbr=" "+ang[n];}else 
        if (n<20) {tbr=kekata(n-10)+" belas";}else 
        if (n<100) {tbr=kekata(Math.floor(n/10))+" puluh"+kekata(n%10);}else 
        if (n<200) {tbr=" seratus"+kekata(n-100);}else 
        if (n<1000) {tbr = kekata(Math.floor(n/100))+" ratus"+kekata(n%100);}else 
        if (n<2000) {tbr = " seribu"+kekata(n-1000);}else 
        if (n<1000000) {tbr=kekata(Math.floor(n/1000))+" ribu"+kekata(n%1000);}else
        if (n<1000000000) {tbr=kekata(Math.floor(n/1000000))+" juta"+kekata(n%1000000);}else
        if (n<1000000000000) {tbr=kekata(Math.floor(n/1000000000))+" milyar"+kekata(n%1000000000);}else
        if (n<1000000000000000) {tbr=kekata(Math.floor(n/1000000000000))+" trilyun"+kekata(n%1000000000000);}
        return tbr;
    }

    function jmlterbilang(a,b){
        document.getElementById(b).innerHTML=kekata(a.value) + ' rupiah';

        // var button = document.getElementById('#btn-tarik');
        var total_simpanan=$('#total_simpanan').val();
        var total_tarik=$('#total_tarik').val(); 
        var x = total_simpanan-total_tarik;
        if ( x < 0 ) {
            $('#btn-tarik').prop('disabled', true) //button is enabled
        }else{
            $('#btn-tarik').prop('disabled', false); //button is enabled
        }
        
        $('#sisa_simpanan').val(total_simpanan-total_tarik);

        total_tarik = total_tarik.toString().replace(/\$|\,/g,'');
        if (isNaN(total_tarik)) {
            total_tarik = "0";
            sign = (total_tarik == (total_tarik = Math.abs(total_tarik)));
            total_tarik = Math.floor(total_tarik*100+0.50000000001);
            cents = total_tarik%100;
            total_tarik = Math.floor(total_tarik/100).toString();

            if (cents<10) {
                cents = "0" + cents;
                for (var i = 0; i < Math.floor((total_tarik.length-(1+i))/3); i++) {
                    total_tarik = total_tarik.substring(0,total_tarik.length-(4*i+3))+'.'+total_tarik.substring(total_tarik.length-(4*i+3));

                    return (((sign)?'':'-')+'Rp.'+ total_tarik + ',' + cents);
                }
            }
        }
    }
 /*    var rupiah = document.getElementById('total_tarik');
    rupiah.addEventListener("keyup", function(e) {
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatCurrency(this.value,);
    });

    Fungsi formatRupiah 
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
      }

      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
*/
    
    // function formatCurrency(total_tarik){
    //     total_tarik = total_tarik.toString().replace(/\$|\,/g,'');
    //     if (isNaN(total_tarik)) {
    //         total_tarik = "0";
    //         sign = (total_tarik == (total_tarik = Math.abs(total_tarik)));
    //         total_tarik = Math.floor(total_tarik*100+0.50000000001);
    //         cents = total_tarik%100;
    //         total_tarik = Math.floor(total_tarik/100).toString();

    //         if (cents<10) {
    //             cents = "0" + cents;
    //             for (var i = 0; i < Math.floor((total_tarik.length-(1+i))/3); i++) {
    //                 total_tarik = total_tarik.substring(0,total_tarik.length-(4*i+3))+'.'+total_tarik.substring(total_tarik.length-(4*i+3));

    //                 return (((sign)?'':'-')+'Rp.'+ total_tarik + ',' + cents);
    //             }
    //         }
    //     }
    // }
</script>
<script>
    $(document).ready(function() {
        $('.formsetorwajiball').submit(function(e){
            e.preventDefault();
            // let jmldata = $('#idSimpanan:checked');
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                    $('.btnsimpanbanyak').attr('disabled','disabled');
                    $('.btnsimpanbanyak').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function(){
                    $('.btnsimpanbanyak').removeAttr('disable');
                    $('.btnsimpanbanyak').html('Setor Simp. Wajib');  
                },
                success: function (response){
                    if (response.sukses) {
                        Swal.fire({
                          icon: 'success',
                          title: 'Berhasil!',
                          html: `${response.sukses}`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = ("<?= base_url('bendahara/dataSimpanan');?>");   
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +thrownError);
                }
            });
            return false;
        });  
});
</script>

<script type="text/javascript">
    function autoRefresh() {
        $( "#notinumber" ).load(window.location.href + " #notinumber" );
    }
    setInterval('autoRefresh()', 10000);


    $('body').scrollspy({ target: '#navbar-example' })
</script>

</body>
</html>

<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                  <?php if (session()->get('level') == 1) { ?>
                    <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout');?>">Logout</a>
                  <?php } else if (session()->get('level') == 2) { ?>
                    <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout');?>">Logout</a>
                  <?php }else if (session()->get('level') == 3) { ?>
                    <button class="btn btn-info" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout');?>">Logout</a>
                  <?php }else{ ?>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="<?= base_url('auth/logoutAng');?>">Logout</a>
                  <?php } ?>
                </div>
            </div>
        </div>
    </div>