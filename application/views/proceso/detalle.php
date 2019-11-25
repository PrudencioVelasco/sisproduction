<!-- page content -->
   <style>
   
    
   #page_list li
   {
    padding:16px;
    background-color:#f9f9f9;
    border:1px dotted #ccc;
    cursor:move;
    margin-top:12px;
   }
   #page_list li.ui-state-highlight
   {
    padding:24px;
    background-color:#ffffcc;
    border:1px dotted #ccc;
    cursor:move;
    margin-top:12px;
   }
  </style>
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<div class="right_col" role="main">

    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4><strong>Detalle Procesos</strong></h4>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        
                         <div class="container">


                         	 <form class="form-inline" method="POST" action="<?php echo site_url('proceso/agregar_detalle');?>">
  <div class="form-group">
    <label >Maquina: </label> 
    <select  class="form-control" name="idmaquina">
    	<?php
        foreach ($maquinas as $value) {
          # code...
          echo '<option value="'.$value->idmaquina.'" >'.$value->nombremaquina.'</option>';
        }
      ?>
    </select>
  </div> 
  <input type="hidden" name="idproceso" value="<?php echo $idproceso ?>">
  <button type="submit" class="btn btn-primary">Agregar</button>
</form> 

    					
   <hr />
   	<form id="frmeliminar">
   <ul class="list-unstyled" id="page_list" >
   
   <?php 
   if(isset($detalle) && !empty($detalle)){
   foreach ($detalle as  $value) { 
    echo '<li id="'.$value->iddetalle.'"><input type="checkbox" name="iddetalle[]" value="'.$value->iddetalle.'">         '.$value->nombremaquina.'</li>';
   }
}
   ?>
   <input type="hidden" name="idproceso" value="<?php echo $idproceso; ?>" /><br>
   
 
   </ul>
   <button type="button" id="btneliminar" class="btn btn-danger">Eliminar</button>
   </form>
   <input type="hidden" name="page_order_list" id="page_order_list" />
  </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div> 


<script>
$(document).ready(function(){
 $( "#page_list" ).sortable({
  placeholder : "ui-state-highlight",
  update  : function(event, ui)
  {
   var page_id_array = new Array();
   $('#page_list li').each(function(){
    page_id_array.push($(this).attr("id"));
   });
   //alert(page_id_array);
   $.ajax({
    url:"<?php echo site_url('proceso/modificar_posicion');?>",
    method:"POST",
    data:{page_id_array:page_id_array},
    success:function(data)
    {
    	//window.location.reload();
     //alert(data);
    }
   });
  }
 });

});
</script>
<script>
	  $("#btneliminar").click(function(){ 
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('proceso/eliminar');?>",
                data: $('#frmeliminar').serialize(),
                success: function(data) {
                	location.reload();
                    /*var msg = $.parseJSON(data);
                    console.log(msg.error);
                    if((typeof msg.error === "undefined")){ 
                    $(".print-error-msg").css('display','none'); 
                    alert(msg.success) ? "" : location.reload(); 
                    }else{ 
                    $(".print-error-msg").css('display','block'); 
                    $(".print-error-msg").html(msg.error);

                    }*/
                }
            });
         
    }); 

</script>
