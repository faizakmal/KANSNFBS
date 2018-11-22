<script src="../../dist/adminlte/adminlte/jquery/dist/jquery.min.js"></script>
<script src="../../dist/adminlte/adminlte/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../dist/adminlte/adminlte/fastclick/lib/fastclick.js"></script>
<!-- DataTables -->
<script src="../../dist/adminlte/adminlte/select2/dist/js/select2.full.min.js"></script>
<script src="../../dist/adminlte/adminlte/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../dist/adminlte/adminlte/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../dist/adminlte/adminlte/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../dist/adminlte/js/adminlte.min.js"></script>
<script src="../../dist/adminlte/js/demo.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en&key=AIzaSyAc9pBfRDe2elx10Tm4wmsYhoBgTKjmG9k"></script>
<script>
var input = document.getElementById('autocomplete');
var autocomplete = new google.maps.places.Autocomplete(input);

function checkLogout(){
    return confirm('Yakin Mau Logout?');
}
function checkDelete(){
    return confirm('Yakin menghapus data ini?');
}
 function checkInput(){
    return confirm('Apakah data yang diinputkan sudah benar?');
}

  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  
</script>
