<!-- jQuery -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/Flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/moment/min/moment.min.js"></script>
<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- PNotify (Notificaciones) -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/dashboard/"; ?>vendors/pnotify/dist/pnotify.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/dashboard/"; ?>vendors/pnotify/dist/pnotify.buttons.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/dashboard/"; ?>vendors/pnotify/dist/pnotify.nonblock.js"></script>

<script src="<?php echo base_url()."assets/dashboard/"; ?>vendors/switchery/dist/switchery.min.js" type="text/javascript"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url()."assets/dashboard/"; ?>build/js/custom.min.js"></script>

<!-- Data Tables -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/"; ?>DataTables/datatables.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/"; ?>DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/"; ?>js/investor.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo base_url()."assets/"; ?>js/dataCharts.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  var date_input=$('input[name="dob"]'); //our date input has the name "date"
  var container=$('#dob').length>0 ? $('#dob').parent() : "body";
  date_input.datepicker({
    format: 'yyyy-mm-dd',
    container: container,
    todayHighlight: true,
    autoclose: true,
  })
  })
</script>

<script type="text/javascript">
$(function() {
  $('input[name="weekProfit"]').daterangepicker({
    opens: 'left',
    todayHighlight: true,
    format: 'yyyy-mm-dd',
  });
});
</script>


</body>
</html>
