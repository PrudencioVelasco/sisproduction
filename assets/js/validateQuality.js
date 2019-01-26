$(document).ready(function(){

    $("#btnCancel").on('click', function() {
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
              title:'Enviado',
              text:'Informacion enviada exitosamente.',
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
  

  
    $("#btnCancel2").on('click', function() {
        $('#modal-editMatch').modal('hide');
        location.reload();
    });
  
    $("#btnSaveMatch2").on('click',function(event){
      event.preventDefault();
  
      var hitURL = baseURL + "edit_match";
      var equipo1_2 = $("#equipo1_2").val();
      var gol_equipo1_2 = $("#gol_equipo1_2").val();
      var equipo2_2 = $("#equipo2_2").val();
      var gol_equipo2_2 = $("#gol_equipo2_2").val();
      var fecha_2 = $("#fecha_2").val();
      var horario_2 = $("#horario_2").val();
      var ubicacion_2 = $("#ubicacion_2").val();
      var estatus_2 = $("#estatus_2").val();
  
      if(equipo1_2 == ''){
        swal({
          title:'Equipo',
          html:'Seleccion un <b>Equipo</b> de la lista.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else if(gol_equipo1_2 == ''){
        swal({
          title:'Cantidad de goles',
          html:'Ingrese una cantidad de <b>Goles</b> anotados.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else if(equipo2_2 == ''){
        swal({
          title:'Equipo',
          html:'Seleccion un <b>Equipo</b> de la lista.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else if(gol_equipo2_2 == ''){
        swal({
          title:'Cantidad de goles',
          html:'Ingrese una cantidad de <b>Goles</b> anotados.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else if(fecha_2 == ''){
        swal({
          title:'Fecha',
          html:'Ingrese una <b>Fecha</b>.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else if(horario_2 == ''){
        swal({
          title:'Horario',
          html:'Ingrese un <b>Horario</b>.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else if(ubicacion_2 == ''){
        swal({
          title:'Ubicación',
          html:'Ingrese una <b>Ubicación</b>.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else if(estatus_2 == ''){
        swal({
          title:'Estatus',
          html:'Seleccione un <b>Estatus</b>.',
          type:'info',
          confirmButtonText: 'ACEPTAR'
        })
      }else{
        $.ajax({
          type : "POST",
          dataType : "json",
          url : hitURL,
          data: $("#editMatch").serialize()
        }).done(function(data){
          console.log(data);
          if (data.status == true) {
            $('#modal-editMatch').modal('hide');
            swal({
              title:'Actualización',
              text:'Información actualizada exitosamente.',
              type:'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'ACEPTAR'
            }).then((result) => {
             if (result.value) {
              location.reload();
            }
          })
          }else{
            swal({
              title:'Error',
              text:'Hubo un fallo al actualizar los datos.',
              type:'error',
              confirmButtonText: 'ACEPTAR'
            })
  
          }
        });
      }
    });

  });