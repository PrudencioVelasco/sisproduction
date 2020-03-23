Vue.config.devtools = true
Vue.component('modal',{ //modal
    template:`
   <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog">
			    <div class="modal-content">


			      <div class="modal-header modal-header-info">
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
        passwordModal:false,
        //deleteModal:false,
        transferencias:[],
        search: {text: ''},
        emptyResult:false,
        newUser:{
            usuario:'',
            name:'',
            rol:'',
            activo:'',
            idturno:'',
            smserror:''},
        chooseUser:{},
        formValidate:[],
        successMSG:'',
			currentSort:'folio',
			currentSortDir:'asc',
        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalTransferencia:0,
        pageRange:2
    },
     created(){
      this.showAll();     },
    methods:{
         showAll(){ axios.get(this.url+"transferencia/showAll").then(function(response){
                 if(response.data.transferencias == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.transferencias);
                    }
            })
        },
		  sort:function(s) {
      //if s == current sort, reverse
      if(s === this.currentSort) {
        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
      }
      this.currentSort = s;
    },
          searchUser(){
            var formData = v.formData(v.search);
              axios.post(this.url+"user/searchUser", formData).then(function(response){
                  if(response.data.transferencias == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.transferencias);

                    }
            })
        },
          addUser(){
            var formData = v.formData(v.newUser);
              axios.post(this.url+"user/addUser", formData).then(function(response){
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
        updateUser(){
            var formData = v.formData(v.chooseUser); axios.post(this.url+"user/updateUser", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                    console.log(response.data.error)
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
        getData(transferencias){
            v.emptyResult = false; // become false if has a record
            v.totalTransferencia = transferencias.length //get total of user
            v.transferencias = transferencias.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

             // if the record is empty, go back a page
            if(v.transferencias.length == 0 && v.currentPage > 0){
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();
            }
        },

        selectUser(transferencia){
            v.chooseUser = transferencia;
        },
        clearMSG(){
            setTimeout(function(){
			 v.successMSG=''
			 },3000); // disappearing message success in 2 sec
        },
        clearAll(){
            v.newUser = {
            usuario:'',
            name:''};
            v.formValidate = false;
            v.addModal= false;
            v.editModal=false;
            v.passwordModal=false;
            v.deleteModal=false;
            v.refresh()

        },
        noResult(){

               v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                      v.transferencias = null
                     v.totalTransferencia = 0 //remove current page if is empty

        },


        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()
        },
        refresh(){
             v.search.text ? v.searchUser() : v.showAll(); //for preventing

        }
    }
})
