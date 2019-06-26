var this_js_script = $('script[src*=appmodelo]');
var my_var_1 = this_js_script.attr('data-my_var_1');   
if (typeof my_var_1 === "undefined" ) {
   var my_var_1 = 'some_default_value';
}
 
Vue.config.devtools = true
Vue.component('modal', {//modal
    template: `
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
    el: '#app',
    data: {
        url: 'http://localhost:8383/sisproduction/',
        addModal: false,
        editModal: false,
        //passwordModal:false,
        //deleteModal:false,
        modelos: [],

        search: {text: ''},
        emptyResult: false,
        newModelo: {
            idparte: '',
            descripcion: '',
            nombrehoja: '',
            fulloneimpresion: '',
            colorlinea: '', 
            diucutno: '',
            platonumero: '',
            color: '',
            normascompartidas: '',
            salida: '',
            combinacion: '',
            msgerror:''
        },
        chooseModelo: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 15,
        totalModelo: 0,
        pageRange: 2,
        directives: {columnSortable},
        idparte: my_var_1
    },
    created() {
        this.showAll(); 
    },
    methods: {
        orderBy(sortFn) {
            // sort your array data like this.userArray
            this.modelos.sort(sortFn);
        },
        showAll() {
            axios.get(this.url + "modelo/showAll", {
                params: {
                    idparte: this.idparte
                }
            }).then(function (response) {
                if (response.data.modelos == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.modelos);
                    //console.log(response.data.partes);
                }
            })
        },

        searchModelo() {
            var formData = v.formData(v.search);
            formData.append('idparte', this.idparte);
            axios.post(this.url + "parte/searchParte", formData).then(function (response) {
                if (response.data.modelos == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.modelos);

                }
            })
        },
        addModelo() {
            var formData = v.formData(v.newModelo);
                formData.append('idparte', this.idparte);
            axios.post(this.url + "modelo/addModelo", formData).then(function (response) {
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
        updateModelo() {
            var formData = v.formData(v.chooseModelo);
            axios.post(this.url + "modelo/updateModelo", formData).then(function (response) {
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
        formData(obj) {
            var formData = new FormData();
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        },
        getData(modelos) {
            v.emptyResult = false; // become false if has a record
            v.totalModelo = modelos.length //get total of user
            v.modelos = modelos.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

            // if the record is empty, go back a page
            if (v.modelos.length == 0 && v.currentPage > 0) {
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();
            }
        },

        selectModelo(modelo) {
            v.chooseModelo = modelo;
        },
        clearMSG() {
            setTimeout(function () {
                v.successMSG = ''
            }, 3000); // disappearing message success in 2 sec
        },
        clearAll() {
            v.newModelo = {
                idparte: '',
                descripcion: '',
                nombrehoja: '',
                fulloneimpresion: '',
                colorlinea: '',
                diucutno: '',
                platonumero: '',
                color: '',
                normascompartidas: '',
                salida: '',
                combinacion: '',
             msgerror:''};
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.modelos = null
            v.totalModelo = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchModelo() : v.showAll(); //for preventing

        }
    }
})
