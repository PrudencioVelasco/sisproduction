<!-- page content -->
     <div class="right_col" role="main">

       <div class="">

         <div class="clearfix"></div>

         <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_panel">
               <div class="x_title">
                 <h3>Generar una orden de salida.</h3>

                 <div class="clearfix"></div>
               </div>
               <div class="x_content">

<div class="row">
 <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="form-group">
      <h3><small>Número de salida: </small><?php echo $detallesalida->numerosalida;?></h3>
    </div>
 </div>
 <div class="col-md-6 col-sm-12 col-xs-12 text-right">
    <div class="form-group">
        <h3><small>Cliente </small><?php echo $detallesalida->nombre;?></h3>
    </div>
 </div>
</div>
<form method="post" action="">
<div class="row">
 <div class="col-md-4 col-sm-12 col-xs-12">
    <div class="form-group">
       <label>* Número de Parte</label>
       <input type="text" class="form-control" name="numeroparte" id="numeroparte" autcomplete="off" placeholder="Número de parte"/>
    </div>
 </div>
 <div class="col-md-3 col-sm-12 col-xs-12">
    <div class="form-group">
       <label>* Cantidad Pallet</label>
       <input type="text" class="form-control" name="cantidadpallet" id="cantidadpallet" autcomplete="off" placeholder="Cantidad de Pallet"/>

    </div>
 </div>
 <div class="col-md-3 col-sm-12 col-xs-12">
    <div class="form-group">
       <label>* Cantida Caja</label>
       <input type="text" class="form-control" name="cantidadcaja" id="cantidadcaja" autcomplete="off" placeholder="Cantida de cajas"/>
    </div>
 </div>
 <div class="col-md-2 col-sm-12 col-xs-12">
    <div class="form-group" style="padding-top:24px;">
      <button type="button" id="btnagregar" class="btn btn-primary">Agregar</button>
   </div>
 </div>
</div>
<form>

<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
     <table class="table">
       <tr>
         <td><strong>Número de parte</strong></td>
         <td><strong>Cantidad pallet</strong></td>
         <td><strong>Cantida de caja</strong></td>
         <td><strong>Número revision</strong></td>
       </tr>
     </table>
   </div>
</div>

               </div>
             </div>
           </div>
         </div>
       </div>


     </div>
     <!-- /page content -->
     <script type="text/javascript">
     $.fn.delayPasteKeyUp = function(fn, ms) {
              var timer = 0;
              $(this).on("propertychange input", function() {
                  clearTimeout(timer);
                  timer = setTimeout(fn, ms);
              });
          };

             $(document).ready(function(){
                 $("#cantidadpallet").attr("disabled", true);
                 $("#cantidadcaja").attr("disabled", true);

                 $("#numeroparte").delayPasteKeyUp(function() {

               numeroparte = $("#numeroparte").val();
               $.ajax({
                   type: "POST",
                   url: "<?= base_url('salida/validaranumeroparte') ?>",
                   data: "numeroparte=" + numeroparte,
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
                  if (data==1) {
                    $("#cantidadpallet").attr("disabled", false);
                    $("#cantidadcaja").attr("disabled", false);
                  }else{
                    $("#cantidadpallet").attr("disabled", true);
                    $("#cantidadcaja").attr("disabled", true);
                  }
                    //  var getContact = JSON.parse(data);
                 //console.log(getContact.incorrecto);





                   }
               });




           }, 200);

           $('#btnagregar').click(function(){

              var  numeroparte = $("#numeroparte").val();
              var  cantidadpallet = $("#cantidadpallet").val();
              var  cantidadcaja = $("#cantidadcaja").val();

                $.ajax
                ({
                  url: "<?= base_url('salida/agregarParteOrden') ?>",
                  data: "numeroparte=" + numeroparte+"&cantidadpallet="+cantidadpallet+"&cantidadcaja="+cantidadcaja,
                    type: 'post',
                    success: function(result)
                    {

                    }
                });
            });

             });
         </script>
