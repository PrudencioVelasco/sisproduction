 <!-- /page content -->
    </div>


  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="<?php echo base_url();?>/assets/js/nicescroll/jquery.nicescroll.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="<?php echo base_url();?>/assets/js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="<?php echo base_url();?>/assets/js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/moment/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="<?php echo base_url();?>/assets/js/chartjs/chart.min.js"></script>
  <!-- sparkline -->
  <script src="<?php echo base_url();?>/assets/js/sparkline/jquery.sparkline.min.js"></script>

  <script src="<?php echo base_url();?>/assets/js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/date.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/assets/js/flot/jquery.flot.resize.js"></script>
  <!-- pace -->
  <script src="<?php echo base_url();?>/assets/js/pace/pace.min.js"></script>

  <!-- Datatables-->
        <script src="<?php echo base_url();?>/assets/js/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/buttons.bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/buttons.print.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/responsive.bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>/assets/js/datatables/dataTables.scroller.min.js"></script>
        <!-- select2 -->
        <script src="<?php echo base_url();?>/assets/js/select/select2.full.js"></script>

        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                    language: {
                          "decimal": "",
                          "emptyTable": "No hay información",
                          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                          "infoPostFix": "",
                          "thousands": ",",
                          "lengthMenu": "Mostrar _MENU_ Entradas",
                          "loadingRecords": "Cargando...",
                          "processing": "Procesando...",
                          "search": "Busqueda interna:",
                          "zeroRecords": "Sin resultados encontrados",
                          "paginate": {
                              "first": "Primero",
                              "last": "Ultimo",
                              "next": "Siguiente",
                              "previous": "Anterior"
                          }
                      },
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true,

            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
        </script>
    <script>
  
    $(document).ready(function() {
     $( "#reload" ).click(function() {
           location.reload(); 
    });
});
    </script>
</body>

</html>
