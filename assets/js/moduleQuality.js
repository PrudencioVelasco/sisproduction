$(document).ready(function(){

/*
* Seccion para el Modal de envio a siguiente Modulo
*/
    $("#btnCancelSend").on('click', function() {
      $('#modal-sendBodega').modal('hide');
    });
  
    $("#btnSend").on('click', function(event) {
        event.preventDefault();
  
        var hitURL = "http://localhost/sisproduction/calidad/enviarBodega";
        var usuario = $("#usuariobodega").val();
    
      if (usuario == '') {
        swal({
          title:'Usuario',
          html:'Seleccione un <b>Usuario</b> de la lista.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else {
        $.ajax({
          type: "POST",
          dataType : "json",
          url: hitURL,
          data: $("#sendBodega").serialize()
        }).done(function(data){
          console.log(data);
          if(data == 'ok'){
            $('#modal-sendBodega').modal('hide');
            swal({
              title:'Exito',
              text:'La informacion se envio correctamente',
              type:'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'ACEPTAR'
            }).then((result) => {
              if (result.value) {
                location.href = "http://localhost/sisproduction/calidad/";
             }
           })
          }else{
            swal({
              title:'Error',
              text:'Hubo un fallo al enviar la informacion',
              type:'error',
              confirmButtonText: 'ACEPTAR'
            })
          }
        });
      }
    });
  
/*
* Seccion para el Modal de rechazo de parte
*/
    $("#btnCancelRechazo").on('click', function() {
        $('#modal-rechazarParte').modal('hide');

    });
  
    $("#btnRechazarParte").on('click',function(event){
      event.preventDefault();
  
      var URL =  "http://localhost/sisproduction/calidad/rechazarParte";
      var comentario = $("#comentario").val();
      
  
      if(comentario == ''){
        swal({
          title:'Motivo',
          html:'Ingrese el motivo de rechazo',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else{
        $.ajax({
          type : "POST",
          dataType : "json",
          url : URL,
          data: $("#rechazarParte").serialize()
        }).done(function(data){
          if (data == "ok") {
            $('#modal-rechazarParte').modal('hide');
            swal({
              title:'Exito',
              text:'La informacion se envio correctamente',
              type:'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'ACEPTAR'
            }).then((result) => {
             if (result.value) {
              location.href = "http://localhost/sisproduction/calidad/";
            }
          })
          }else{
            swal({
              title:'Error',
              text:'Hubo un fallo al enviar la informacion',
              type:'error',
              confirmButtonText: 'ACEPTAR'
            })
  
          }
        });
      }
    });

  });