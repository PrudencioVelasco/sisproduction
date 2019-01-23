
Vue.component('modal',{ //modal
    template:`
   <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog">
          <div class="modal-content">
            

            <div class="modal-header">
                <h5 class="modal-title"> <slot name="head"></slot></h5> 
                <i class="fa fa-window-close  icon-md text-danger" @click="$emit('close')"></i>
              </div>

            <div class="modal-body" style="background-color:#fff;">
               <slot name="body"></slot>
            </div>
            <div class="modal-footer">

               <slot name="foot"></slot>
            </div>
          </div>
          </div>
        </div>
      </div>
    </transition> 
    `
})
var v = new Vue({
   el:'#app',
    data:{
       url:'http://localhost:8383/sisproduction/',
        addModal: false,
        editModal:false,
        //passwordModal:false,
        //deleteModal:false,
        turnos:[],
        search: {text: ''},
        emptyResult:false,
        newturno:{
            nombreturno:'',
            horainicial:'',
            horafinal:'',
            siguientedia:'',
            activo:'',
            smserror: ''

          },
        chooseTurno:{},
        formValidate:[],
        successMSG:'',
        
        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalTurnos:0,
        pageRange:2
    },
     created(){
      this.showAll(); 
    },
    methods:{
         showAll(){ axios.get(this.url+"turno/showAll").then(function(response){
                 if(response.data.turnos == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.turnos);
                    }
            })
        },
          searchTurno(){
            var formData = v.formData(v.search);
              axios.post(this.url+"turno/searchTurno", formData).then(function(response){
                  if(response.data.turnos == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.turnos);
                    
                    }  
            })
        },
          addTurno(){   
            var formData = v.formData(v.newturno);
              axios.post(this.url+"turno/addTurno", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                    swal({
            position: 'center',
            type: 'success',
            title: 'Exito!',
            showConfirmButton: false,
            timer: 1500
          });

                    v.clearAll();
                    v.clearMSG();
                }
               })
        },
        updateTurno(){
            var formData = v.formData(v.chooseTurno); axios.post(this.url+"turno/updateTurno", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                    //v.successMSG = response.data.success;
                      swal({
                            position: 'center',
                            type: 'success',
                            title: 'Modificado!',
                            showConfirmButton: false,
                            timer: 1500
                          });
                    v.clearAll();
                    v.clearMSG();
                
                }
            })
        },
         
       /* deleteUser(){
             var formData = v.formData(v.chooseUser);
              axios.post(this.url+"user/deleteUser", formData).then(function(response){
                if(!response.data.error){
                     v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
                }
            })
        },*/
         formData(obj){
         var formData = new FormData();
          for ( var key in obj ) {
              formData.append(key, obj[key]);
          } 
          return formData;
    },
        getData(turnos){
            v.emptyResult = false; // become false if has a record
            v.totalTurnos = turnos.length //get total of user
            v.turnos = turnos.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            
             // if the record is empty, go back a page
            if(v.turnos.length == 0 && v.currentPage > 0){ 
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();  
            }
        },
            
        selectTurno(turno){
            v.chooseTurno = turno; 
        },
        clearMSG(){
            setTimeout(function(){
       v.successMSG=''
       },3000); // disappearing message success in 2 sec
        },
        clearAll(){
            v.newturno = { 
             nombreturno:'',
            horainicial:'',
            horafinal:'',
            siguientedia:'',
            activo:'' };
            v.formValidate = false;
            v.addModal= false;
            v.editModal=false; 
            v.deleteModal=false;
            v.refresh()
            
        },
        noResult(){
          
               v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                      v.turnos = null 
                     v.totalTurnos = 0 //remove current page if is empty
            
        },

       
        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()  
        },
        refresh(){
             v.search.text ? v.searchRol() : v.showAll(); //for preventing
            
        }
    }
})