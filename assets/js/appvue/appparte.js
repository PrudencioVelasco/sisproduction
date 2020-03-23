
var this_js_script = $('script[src*=appparte]');
var my_var_1 = this_js_script.attr('data-my_var_1');
if (typeof my_var_1 === "undefined") {
    var my_var_1 = 'some_default_value';
}


Vue.config.devtools = true
Vue.component('modal', {//modal
    template: `
   <transition name="modal">
      <div class="modal-mask">

          <div class="modal-dialog">
			    <div class="modal-content">


			      <div class="modal-header modal-header-info">
				        <span class="modal-title"> <slot name="head"></slot></span>
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
    el: '#app',
    data: {
        url: my_var_1,
        addModal: false,
        editModal: false,
        //passwordModal:false,
        //deleteModal:false,
        partes: [],
        clientes: [],
        categorias: [],
        search: {text: ''},
        emptyResult: false,
        newParte: {
            numeroparte: '',
            idcliente: '',
            idcategoria:'',
            smserror: '',
            activo: ''
        },
        chooseParte: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 15,
        totalParte: 0,
        pageRange: 2,
        directives: {columnSortable}
    },
    created() {
        this.showAll();
        this.showAllClientes();
        this.showAllCategorias();
    },
    methods: {
        orderBy(sortFn) {
            // sort your array data like this.userArray
            this.partes.sort(sortFn);
        },
        showAll() {
            axios.get(this.url + "parte/showAll").then(function (response) {
                if (response.data.partes == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.partes);
                    //console.log(response.data.partes);
                }
            })
        },
        showAllClientes() {
            axios.get(this.url + "client/showAllClientesActivos")
                    .then(response => (this.clientes = response.data))

        },
         showAllCategorias() {
            axios.get(this.url + "categoria/showAllCategoriasActivos")
                    .then(response => (this.categorias = response.data))

        },
        searchParte() {
            var formData = v.formData(v.search);
            axios.post(this.url + "parte/searchParte", formData).then(function (response) {
                if (response.data.partes == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.partes);

                }
            })
        },
        addParte() {
            var formData = v.formData(v.newParte);
            axios.post(this.url + "parte/addPart", formData).then(function (response) {
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
        updateParte() {
            var formData = v.formData(v.chooseParte);
            axios.post(this.url + "parte/updateParte", formData).then(function (response) {
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
         deleteParte(id){
            Swal.fire({
          title: '¿Eliminar el Número de Parte?',
          text: "Realmente desea eliminar el Número de Parte.",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {

              axios.get(this.url + "parte/deleteParte", {
                params: {
                    idparte: id
                }
            }).then(function (response) {
                if (response.data.partes == true) {
                    //v.noResult()
                     swal({
                        position: 'center',
                        type: 'success',
                        title: 'Eliminado!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    v.clearAll();
                    v.clearMSG();
                } else {
                   swal("Error", "No se puede eliminar el Número de Parte", "error")
                }
                console.log(response);
            }).catch((error) => {
                swal("Error", "No se puede eliminar el Número de Parte", "error")
            })
            }
            })
        },
        formData(obj) {
            var formData = new FormData();
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        },
        getData(partes) {
            v.emptyResult = false; // become false if has a record
            v.totalParte = partes.length //get total of user
            v.partes = partes.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

            // if the record is empty, go back a page
            if (v.partes.length == 0 && v.currentPage > 0) {
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();
            }
        },

        selectParte(parte) {
            v.chooseParte = parte;
        },
        clearMSG() {
            setTimeout(function () {
                v.successMSG = ''
            }, 3000); // disappearing message success in 2 sec
        },
        clearAll() {
            v.newParte = {
                numeroparte: '',
                idcliente: '',
                idcategoria: '',
                smserror: '',
                activo: ''};
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.partes = null
            v.totalParte = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchParte() : v.showAll(); //for preventing

        }
    }
})
