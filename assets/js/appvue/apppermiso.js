
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
       url:'http://localhost/sisproduction/',
        addModal: false,
        editModal:false,
        //passwordModal:false,
        //deleteModal:false,
        permisos:[],
        search: {text: ''},
        emptyResult:false,
        newPermiso:{
            uri:'',
            description:''
          },
        choosePermiso:{},
        formValidate:[],
        successMSG:'',
        
        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalPermisos:0,
        pageRange:2
    },
     created(){
      this.showAll(); 
    },
    methods:{
         showAll(){ axios.get(this.url+"permiso/showAll").then(function(response){
                 if(response.data.permisos == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.permisos);
                    }
            })
        },
          searchPermiso(){
            var formData = v.formData(v.search);
              axios.post(this.url+"permiso/searchPermiso", formData).then(function(response){
                  if(response.data.permisos == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.permisos);
                    
                    }  
            })
        },
          addPermiso(){   
            var formData = v.formData(v.newPermiso);
              axios.post(this.url+"permiso/addPermiso", formData).then(function(response){
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
        updatePermiso(){
            var formData = v.formData(v.choosePermiso); axios.post(this.url+"permiso/updatePermiso", formData).then(function(response){
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
        getData(permisos){
            v.emptyResult = false; // become false if has a record
            v.totalPermisos = permisos.length //get total of user
            v.permisos = permisos.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            
             // if the record is empty, go back a page
            if(v.permisos.length == 0 && v.currentPage > 0){ 
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();  
            }
        },
            
        selectPermiso(permiso){
            v.choosePermiso = permiso; 
        },
        clearMSG(){
            setTimeout(function(){
       v.successMSG=''
       },3000); // disappearing message success in 2 sec
        },
        clearAll(){
            v.newPermiso = { 
            uri:'',
            description:'' };
            v.formValidate = false;
            v.addModal= false;
            v.editModal=false; 
            //v.deleteModal=false;
            v.refresh()
            
        },
        noResult(){
          
               v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                      v.permisos = null 
                     v.totalPermisos = 0 //remove current page if is empty
            
        },

       
        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()  
        },
        refresh(){
             v.search.text ? v.searchPermiso() : v.showAll(); //for preventing
            
        }
    }
})