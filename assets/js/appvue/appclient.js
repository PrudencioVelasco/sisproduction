
Vue.component('modal', {//modal
    template: `
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
    el: '#app',
    data: {
        url: 'http://localhost/sisproduction/',
        addModal: false,
        editModal: false,
        //passwordModal:false,
        //deleteModal:false,
        clientes: [],
        search: {text: ''},
        emptyResult: false,
        newClient: {
            rfc: '',
            nombre: '',
            abreviatura:'',
            direccion: ''

        },
        chooseClient: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 5,
        totalClient: 0,
        pageRange: 2
    },
    created() {
        this.showAll();
    },
    methods: {
        showAll() {
            axios.get(this.url + "client/showAll").then(function (response) {
                if (response.data.clientes == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.clientes);
                }
            })
        },
        searchClient() {
            var formData = v.formData(v.search);
            axios.post(this.url + "client/searchClient", formData).then(function (response) {
                if (response.data.clientes == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.clientes);

                }
            })
        },
        addClient() {
            var formData = v.formData(v.newClient);
            axios.post(this.url + "client/addClient", formData).then(function (response) {
                if (response.data.error) {
                    v.formValidate = response.data.msg;
                } else {
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
        updateClient() {
            var formData = v.formData(v.chooseClient);
            axios.post(this.url + "client/updateClient", formData).then(function (response) {
                if (response.data.error) {
                    v.formValidate = response.data.msg;
                } else {
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
        formData(obj) {
            var formData = new FormData();
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        },
        getData(clientes) {
            v.emptyResult = false; // become false if has a record
            v.totalClient = clientes.length //get total of user
            v.clientes = clientes.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

            // if the record is empty, go back a page
            if (v.clientes.length == 0 && v.currentPage > 0) {
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();
            }
        },

        selectRol(client) {
            v.chooseClient = client;
        },
        clearMSG() {
            setTimeout(function () {
                v.successMSG = ''
            }, 3000); // disappearing message success in 2 sec
        },
        clearAll() {
            v.newClient = {
                rfc: '',
                nombre: '',
                abreviatura:'',
                direccion: '', 
                activo: ''};
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.clientes = null
            v.totalClient = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchRol() : v.showAll(); //for preventing

        }
    }
})