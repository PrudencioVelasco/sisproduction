<!-- page content -->
<div class="right_col" role="main">

    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Módulo de Ordenes</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                     <div class="form-group">
                                        <label>Escaneo Codigo de Barra:</label>
                                        <input type="text" class="form-control" placeholder="Escaneo Codigo de Barra" id="item" autofocus="">
                                      </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table class="table table-striped responsive-utilities jambo_table bulk_action" >
                                        <thead>
                                            <tr>
                                                <th><strong>Número de parte</strong></th>
                                                <th><strong>C. Pallet</strong></th>
                                                <th><strong>C. Caja por Pallet</strong></th>
                                                <th><strong>Modelo</strong></th>
                                                <th><strong>Revisión</strong></th>
                                                <th><strong>Ubicación</strong></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if (isset($detalleorden) && !empty($detalleorden)) {
                                            $totalpallet = 0;
                                            $totalcajas = 0;
                                            foreach ($detalleorden as $value) {
                                                $totalpallet += $value->pallet;
                                                if ($value->tipo == 0) {
                                                    $totalcajas += $value->cajaspallet;
                                                } else {
                                                    $totalcajas += $value->caja;
                                                }


                                                // code...
                                                echo "<tr>";
                                                echo "<td>" . $value->numeroparte . "</td>";
                                                echo "<td>" . $value->pallet . "</td>";
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($value->tipo == 0) {
                                                        echo $value->cajaspallet;
                                                    } else {
                                                        echo $value->caja;
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                                echo "<td>" . $value->modelo . "</td>";
                                                echo "<td>" . $value->revision . "</td>"; 
                                                echo "<td>" . $value->nombreposicion . "</td>"; 
                                                echo "</tr>";
                                            }
                                            echo "<tr>";
                                            echo "<td></td>";
                                            echo "<td><strong>Total: " . number_format($totalpallet) . "</strong></td>";
                                            echo "<td><strong>Total: " . number_format($totalcajas) . "</strong></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "<td></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
  $.fn.delayPasteKeyUp = function(fn, ms) {
              var timer = 0;
              $(this).on("propertychange input", function() {
                  clearTimeout(timer);
                  timer = setTimeout(fn, ms);
              });
          };
           $(document).ready(function() {
              $("#item").delayPasteKeyUp(function() {
          
                  item = $("#item").val();
                  $.ajax({
                      type: "POST",
                      url: "<?= base_url('orden/validar') ?>",
                      data: "item=" + item,
                      dataType: "html",
                      beforeSend: function() {
                          //imagen de carga
                          //$("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                      },
                      error: function() {
                          alert("error petición ajax");
                      },
                      success: function(data) {

                        console.log(data);
          
                      }
                  }); 

              }, 200);
          });
</script>