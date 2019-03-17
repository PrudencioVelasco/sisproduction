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
   <table class="table table-striped responsive-utilities jambo_table bulk_action" >
                                    <thead>
                                        <tr>
                                            <th><strong>Número de parte</strong></th>
                                            <th><strong>C. Pallet</strong></th>
                                            <th><strong>C. Caja por Pallet</strong></th>
                                            <th><strong>Modelo</strong></th>
                                            <th><strong>Revisión</strong></th>
                                            <?php if ($detallesalida->finalizado == 0) { ?>
                                                <th></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <?php
                                    if (isset($detalleorden) && !empty($detalleorden)) {
                                        $totalpallet=0;
                                        $totalcajas=0;
                                        foreach ($detalleorden as $value) {
                                            $totalpallet+=$value->pallet;
                                            //$totalcajas+=($value->caja * $value->pallet);
                                             if($value->tipo == 0){
                                                     $totalcajas+=$value->cajaspallet;
                                                }else{
                                                     $totalcajas+=$value->caja;
                                                }
                                                
                                                
                                            // code...
                                            echo "<tr>";
                                            echo "<td>" . $value->numeroparte . "</td>";
                                            echo "<td>" . $value->pallet . "</td>";?>
                                            <td>
                                                <?php
                                                if($value->tipo == 0){
                                                    echo $value->cajaspallet;
                                                }else{
                                                    echo $value->caja;
                                                }
                                                ?>
                                            </td>
                                            <?php echo "<td>" . $value->modelo . "</td>";
                                            echo "<td>" . $value->revision . "</td>";
                                            ?>
                                            <?php if ($detallesalida->finalizado == 0) { ?>
                                                <td align="right">
                                                    <input type="hidden" id="idordensalida" name="idordensalida" value="<?php echo $value->idordensalida; ?>"/>
                                                     
                                                    <a onclick="return confirm('Estas seguro de quitar?')" href="<?php echo site_url('salida/eliminarParteOrden/'.$value->idordensalida.'/'.$value->idsalida.'/'.$value->idpalletcajas) ?>"><i style="color:red;padding-right: 10px;"  class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                                                </td>
                                            <?php } ?>
                                            <?php
                                            echo "</tr>";
                                        }
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td><strong>Total: ".number_format($totalpallet)."</strong></td>";
                                        echo "<td><strong>Total: ".number_format($totalcajas)."</strong></td>";
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
