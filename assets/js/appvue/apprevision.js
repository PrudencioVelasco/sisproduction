var this_js_script = $('script[src*=apprevision]');
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
        revisiones: [],

        search: {text: ''},
        emptyResult: false,
        newRevision: {
            descripcion: '',
            msgerror:''
        },
        chooseRevision: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 15,
        totalRevision: 0,
        pageRange: 2,
        directives: {columnSortable},
        idmodelo: my_var_1
    },
    created() {
        this.showAll(); 
    },
    methods: {
        orderBy(sortFn) {
            // sort your array data like this.userArray
            this.revisiones.sort(sortFn);
        },
        showAll() {
            axios.get(this.url + "revision/showAll", {
                params: {
                    idmodelo: this.idmodelo
                }
            }).then(function (response) {
                if (response.data.revisiones == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.revisiones);
                    //console.log(response.data.partes);
                }
            })
        },

        searchRevision() {
            var formData = v.formData(v.search);
                formData.append('idmodelo', this.idmodelo);
                axios.post(this.url + "revision/searchRevision", formData).then(function (response) {
                if (response.data.revisiones === null) {
                    v.noResult()
                } else {
                    v.getData(response.data.revisiones);

                }
            })
        },
        addRevision() {
            var formData = v.formData(v.newRevision);
                formData.append('idmodelo', this.idmodelo);
            axios.post(this.url + "revision/addRevision", formData).then(function (response) {
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
        updateRevision() {
            var formData = v.formData(v.chooseRevision);
            axios.post(this.url + "revision/updateRevision", formData).then(function (response) {
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
        getData(revisiones){
            v.emptyResult = false; // become false if has a record
            v.totalRevision = revisiones.length //get total of user
            v.revisiones = revisiones.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

             // if the record is empty, go back a page
            if(v.revisiones.length == 0 && v.currentPage > 0){
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();
            }
        },

        selectRevision(revision) {
            v.chooseRevision = revision;
        },
        clearMSG() {
            setTimeout(function () {
                v.successMSG = ''
            }, 3000); // disappearing message success in 2 sec
        },
        clearAll() {
            v.newRevision = {
             descripcion: '',
             msgerror:''};
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.revisiones = null
            v.totalRevision = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchRevision() : v.showAll(); //for preventing

        }
    }
})
