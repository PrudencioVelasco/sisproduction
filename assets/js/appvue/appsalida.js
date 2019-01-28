
Vue.config.devtools = true
Vue.component('modal',{ //modal
    template:`
   <transition name="modal">
      <div class="modal-mask">

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
        salidas:[],
        clientes: [],
        newSalida:{
            idcliente:''
          },
        search: {text: ''},
        emptyResult:false,
        chooseSalida:{},
        formValidate:[],
        successMSG:'',

        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalSalida:0,
        pageRange:2
    },
     created(){
      this.showAll();
      this.showAllClientes();
    },
    methods:{
         showAll(){ axios.get(this.url+"salida/showAll").then(function(response){
                 if(response.data.salidas == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.salidas);
                        console.log(response.data.salidas);
                    }
            })
        },
         showAllClientes() {
                axios.get(this.url + "client/showAllClientesActivos")
                    .then(response => (this.clientes = response.data))

            },
          searchParte(){
            var formData = v.formData(v.search);
              axios.post(this.url+"salida/searchParte", formData).then(function(response){
                  if(response.data.salidas == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.salidas);

                    }
            })
        },
        addSalida(){
               var formData = v.formData(v.newSalida);
                 axios.post(this.url+"salida/addSalida", formData).then(function(response){
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
                    //  router.push('/detalle/detalleSalida')
                       v.clearAll();
                       v.clearMSG();
                       //redirect('/salida/detalleSalida');
                   }
                  }) 
           },

         formData(obj){
			   var formData = new FormData();
		      for ( var key in obj ) {
		          formData.append(key, obj[key]);
		      }
		      return formData;
		},
        getData(salidas){
            v.emptyResult = false; // become false if has a record
            v.totalSalida = salidas.length //get total of user
            v.salidas = salidas.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

             // if the record is empty, go back a page
            if(v.salidas.length == 0 && v.currentPage > 0){
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();
            }
        },

        selectParte(salida){
            v.chooseSalida = salida;
        },
        clearMSG(){
            setTimeout(function(){
			 v.successMSG=''
			 },3000); // disappearing message success in 2 sec
        },
        clearAll(){
            v.formValidate = false;
            v.addModal= false;
            v.editModal=false;
            v.deleteModal=false;
            v.refresh()

        },
        noResult(){

               v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                      v.salidas = null
                     v.totalSalida = 0 //remove current page if is empty

        },


        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()
        },
        refresh(){
             v.search.text ? v.searchSalida() : v.showAll(); //for preventing

        }
    }
})
