<!-- /page content -->

</div>


</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js" ></script>
<script src="<?php echo base_url(); ?>/assets/js/nicescroll/jquery.nicescroll.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo base_url(); ?>/assets/js/progressbar/bootstrap-progressbar.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url(); ?>/assets/js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/datepicker/daterangepicker.js"></script>
<!-- chart js -->
<script src="<?php echo base_url(); ?>/assets/js/chartjs/chart.min.js"></script>
<!-- sparkline -->
<script src="<?php echo base_url(); ?>/assets/js/sparkline/jquery.sparkline.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>

<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/date.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/curvedLines.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/flot/jquery.flot.resize.js"></script>
<!-- pace -->
<script src="<?php echo base_url(); ?>/assets/js/pace/pace.min.js"></script>

<!-- Datatables-->
<script src="<?php echo base_url(); ?>/assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/datatables/dataTables.scroller.min.js"></script>
<!-- select2 -->
<script src="<?php echo base_url(); ?>/assets/js/select/select2.full.js"></script>

<script>
    var handleDataTableButtons = function () {
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
            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons()
                    }
                }
            }();
</script>
<script type="text/javascript">
    $('#tblresponsive').DataTable({
        responsive: true
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable(
                {
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                }
        );
        $('#datatableentrada').dataTable();

        $('#datatablesalidacompleta').dataTable();
        $('#datatablesalidaparcial').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true,

        });
        $('#datatable-responsive').DataTable();
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });
    });
    TableManageButtons.init();
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable2').dataTable(
                {
                    "order": [[0, "desc"]],
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                }
        );


    });
</script>

<script>

    $(document).ready(function () {
        $("#reload").click(function () {
            location.reload();
        });
    });
</script>

<script>
    $(document).ready(function () {
        /*$(".select2_single_cliente").select2({  
         placeholder: "Seleccionar Cliente",
         allowClear: true,
         width: '100%' ,
         minimumResultsForSearch: Infinity
         }); 
         $(".select2_single_modelo").select2({ 
         placeholder: "Seleccionar Modelo",
         allowClear: true,
         width: '100%' 
         });
         $(".select2_single_revision").select2({ 
         placeholder: "Seleccionar Revision",
         allowClear: true,
         width: '100%' 
         });
         $(".select2_single_cantidad").select2({ 
         placeholder: "Seleccionar Cantidad",
         allowClear: true,
         width: '100%' 
         });
           
         $(".select2_linea").select2({ 
         placeholder: "Seleccionar Linea",
         allowClear: true,
         width: '100%' 
         });*/
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            maximumSelectionLength: 4,
            placeholder: "With Max Selection limit 4",
            allowClear: true
        });

    });

</script> 
<script>
    $(document).ready(function () {
        $(".select2_single_cliente").prop("disabled", true);
        $(".select2_single_modelo").prop("disabled", true);
        $(".select2_single_revision").prop("disabled", true);
        $(".select2_single_cantidad").prop("disabled", true);

    });
</script>



</body>

</html>
