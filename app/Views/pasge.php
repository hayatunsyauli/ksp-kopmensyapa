<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ;?></title>

    <link href="<?= base_url();?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url();?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url();?>/css/style.css" rel="stylesheet">

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- Custom styles for this page -->
    <link href="<?= base_url();?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('layout/sidebar.php'); ?>
    
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <section>
                    <?= $this->renderSection('content');?>
                </section>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout');?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

       <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url();?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url();?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url();?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url();?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url();?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url();?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url();?>/js/demo/datatables-demo.js"></script>

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

        // var rupiah = document.getElementById()

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
        document.getElementById(b).innerHTML=kekata(a.value);
    }
    
    function formatCurrency(rupiah){
        rupiah = rupiah.toString().replace(/\$|\,/g,'');
        if (isNaN(rupiah)) {
            rupiah = "0";
            sign = (rupiah == (rupiah = Math.abs(rupiah)));
            rupiah = Math.floor(rupiah*100+0.50000000001);
            cents = rupiah%100;
            rupiah = Math.floor(rupiah/100).toString();

            if (cents<10) {
                cents = "0" + cents;
                for (var i = 0; i < Math.floor((rupiah.length-(1+i))/3); i++) {
                    rupiah = rupiah.substring(0,rupiah.length-(4*i+3))+'.'+rupiah.substring(rupiah.length-(4*i+3));

                    return (((sign)?'':'-')+'Rp.'+ rupiah + ',' + cents);
                }
            }
        }
    }
</script>
<script>
    function total_tarik(){
        var a = document.getElementById("total_simpanan").value;
        var b = document.getElementById("total_tarik").value;
        var c = parseInt(a)+parseInt(b);
        
        document.getElementById(".sisa_simpanan").value = c;

    }
</script>
<script>
      $('#summernote').summernote({
        placeholder: 'Isi Berita disini!',
        // tabsize: 2,
        height: 350
      });
      // CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"),{
      //   mode: "htmlmixed",
      //   theme: "monokai"
      // });
    </script>


</body>

</html>