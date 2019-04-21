
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
        motivos: [],
        procesos: [],
        search: {text: ''},
        emptyResult: false,
        newMotivo: {
            motivo: '',
            idproceso:'',
            activo: ''

        },
        chooseMotivo: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 5,
        totalMotivo: 0,
        pageRange: 2
    },
    created() {
        this.showAll();
        this.showAllProcesos(); 
    },
    methods: {
        showAll() {
            axios.get(this.url + "motivorechazo/showAll").then(function (response) {
                if (response.data.motivos == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.motivos);
                }
            })
        },
        showAllProcesos(){
           axios.get(this.url+"motivorechazo/showAllProcesos")
          .then(response => (this.procesos = response.data))

        },
        
        searchMotivo() {
            var formData = v.formData(v.search);
            axios.post(this.url + "motivorechazo/searchMotivo", formData).then(function (response) {
                if (response.data.motivos == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.motivos);

                }
            })
        },
        addMotivo() {
            var formData = v.formData(v.newMotivo);
            axios.post(this.url + "motivorechazo/addMotivo", formData).then(function (response) {
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
        updateMotivo() {
            var formData = v.formData(v.chooseMotivo);
            axios.post(this.url + "motivorechazo/updateMotivo", formData).then(function (response) {
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
        getData(motivos) {
            v.emptyResult = false; // become false if has a record
            v.totalMotivo= motivos.length //get total of user
            v.motivos = motivos.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

            // if the record is empty, go back a page
            if (v.motivos.length == 0 && v.currentPage > 0) {
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();
            }
        },

        selectMotivo(motivo) {
            v.chooseMotivo = motivo;
        },
        clearMSG() {
            setTimeout(function () {
                v.successMSG = ''
            }, 3000); // disappearing message success in 2 sec
        },
        clearAll() {
            v.newMotivo = {
                   motivo: '',
                   idproceso:'',
                   activo: ''};
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.motivos = null
            v.totalMotivo = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchMotivo() : v.showAll(); //for preventing

        }
    }
})