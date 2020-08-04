
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url(); ?>assets/AdminLTE/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/dist/js/demo.js"></script>

<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- page script -->
<script>
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
    
    $('#example1').DataTable({
      'scrollX'     : true
    })
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

<script>
    $(document).ready(function() {
        $('form').attr('autocomplete', 'off');

        $('#rangepicker').daterangepicker({
            locale: {
              format: 'DD/MM/YYYY'
          }
        });
        $('#rangepicker2').daterangepicker({
            locale: {
              format: 'DD/MM/YYYY'
          }
        });

        $("#datepicker").datepicker({
          autoclose: true,
          // container: '#myModalWithDatePicker',
          format: 'dd-mm-yyyy',
          orientation: 'bottom'
        });
        $("#datepicker2").datepicker({
          autoclose: true,
          // container: '#myModalWithDatePicker',
          format: 'dd-mm-yyyy',
          orientation: 'bottom'
        });

        //Timepicker
        $('.timepicker').timepicker({
          showMeridian: false,
          showInputs: false,
        })
    });
  </script>