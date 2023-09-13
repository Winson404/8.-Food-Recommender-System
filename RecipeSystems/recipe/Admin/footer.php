<br>
<br>
<br>
<br>
<br>
<br>


<div class="modal fade" id="approve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered p-3">
    <div class="modal-content">
       <div class="modal-headert" style="background-color: #DFD683;">
          <img src="../assets/logoo.png" alt="" style="width:200px;" class="d-block m-auto">
      </div>
      <div class="modal-body p-5">
          <h6 class="text-center">Your session has timed out. Please login again</h6>
      </div>
      <div class="modal-footer alert-light">
        <a href="../logout.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
      </div>
    </div>
  </div>
</div>

 <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">Recipick</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<!-- TOASTER -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="chart.js/Chart.min.js"></script>
<!-- ChartJS -->
<!-- <script src="../js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="../js/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="../js/jquery.vmap.min.js"></script> -->
<!-- <script src="../js/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="../js/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="../js/moment.min.js"></script> -->
<!-- <script src="../js/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="../js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<!-- <script src="../js/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<!-- <script src="../js/jquery.overlayScrollbars.min.js"></script> -->
<!-- AdminLTE App -->
<script src="js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../js/dashboard.js"></script> -->

<!-- DataTables  & Plugins -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/responsive.bootstrap4.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.bootstrap4.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/buttons.colVis.min.js"></script>


<!-- jquery-validation -->
<!-- <script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script> -->





<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["csv","pdf", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    $("#example111").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
    }).buttons().container().appendTo('#example111_wrapper .col-md-6:eq(0)');

 

    // CAN BE DELETED ####################
    // $('#example').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
    // CAN BE DELETED ####################
  });
</script>



 <script>
   //-----------------------------ALERT TIMEOUT-------------------------//
  $(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,5000);
  }
  );
//-----------------------------END ALERT TIMEOUT---------------------//
 </script>

</body>
</html>

<?php include 'sweetalert_messages.php'; ?>

<script>
  setInterval(function() {
    var lastActive = <?php echo $_SESSION['last_active']; ?>;
    var currentTime = new Date().getTime() / 1000;
    var inactiveTime = currentTime - lastActive;
    if (inactiveTime > 100060) { // inactivity period is 10 seconds
        
        $('#approve').modal({
          backdrop: 'static',
          keyboard: false
        }).modal('show');

        setTimeout(function() {
          window.location.href = '../logout.php';
        }, 15000); 

    }
  }, 1000); // check every second
</script>