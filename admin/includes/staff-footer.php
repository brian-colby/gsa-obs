<script src=//cdn.jsdelivr.net/npm/sweetalert2@11></script>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="../dist/js/demo.js"></script> -->
<!-- Page specific script -->

<script>

    $("#runpayroll").click(function(){
      Swal.fire({
      title: 'Attention!!',
      text: 'Are you sure you want to continue?',
      icon: 'warning',
      showCancelButton: true,
      denyButtonText: "Don't save",
      confirmButtonText: 'Procced',
    }).then((result) => {

  /* Read more about isConfirmed, isDenied below */

  if (result.isConfirmed) {
    Swal.fire('Saved!', '', 'success')
    window.location.href = 'generate.php';
  } else {
    Swal.fire('', 'Run Payslip Error', 'error')
  }
})
})

$("#testrunpayroll").click(function(){
Swal.fire({
title: 'Attention!!',
text: 'Are you sure you want to continue?',
icon: 'warning',
showCancelButton: true,
denyButtonText: "Don't save",
confirmButtonText: 'Procced',
}).then((result) => {
  
/* Read more about isConfirmed, isDenied below */
if (result.isConfirmed) {
Swal.fire('Saved!', '', 'success')
window.location.href = 'testgenerate.php';
} else {
Swal.fire('', 'Run Payslip Error', 'error')
}
})
})

  $(function () {

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,

    });

  });

  function btDisp(){
    document.getElementById("runpayroll").style.display='block';
    document.getElementById("testrunpayroll").style.display='block';
  }
</script>
</body>
</html>