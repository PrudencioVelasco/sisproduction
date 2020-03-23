
var this_js_script = $('script[src*=appmaquina]');
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
    el: '#applinea',
    data: {
        url: my_var_1,
        addModal: false,
        editModal: false,
        //passwordModal:false,
        //deleteModal:false,
        maquinas: [],

        search: {text: ''},
        emptyResult: false,
        newMaquina: {
            nombremaquina: '',
            activo: '',
            msgerror:''
        },
        chooseMaquina: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 15,
        totalMaquina: 0,
        pageRange: 2,
        directives: {columnSortable}
    },
    created() {
        this.showAll();
    },
    methods: {
        orderBy(sortFn) {
            // sort your array data like this.userArray
            this.maquinas.sort(sortFn);
        },
        showAll() {
            axios.get(this.url + "maquina/showAll").then(function (response) {
                if (response.data.maquinas == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.maquinas);
                    //console.log(response.data.partes);
                }
            })
        },

        searchMaquina() {
  var formData = v.formData(v.search);
              axios.post(this.url+"maquina/searchMaquina", formData).then(function(response){
                  if(response.data.maquinas == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.maquinas);

                    }
            })
        },
        addMaquina() {
            var formData = v.formData(v.newMaquina);
            axios.post(this.url + "maquina/addMaquina", formData).then(function (response) {
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
        updateMaquina() {
            var formData = v.formData(v.chooseMaquina);
            axios.post(this.url + "maquina/updateMaquina", formData).then(function (response) {
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
        getData(maquinas) {
            v.emptyResult = false; // become false if has a record
            v.totalMaquina = maquinas.length //get total of user
            v.maquinas = maquinas.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

            // if the record is empty, go back a page
            if (v.maquinas.length == 0 && v.currentPage > 0) {
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();
            }
        },

        selectMaquina(maquina) {
            v.chooseMaquina = maquina;
        },
        clearMSG() {
            setTimeout(function () {
                v.successMSG = ''
            }, 3000); // disappearing message success in 2 sec
        },
        clearAll() {
            v.newMaquina = {
                nombremaquina: '',
                msgerror:''};
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.maquinas = null
            v.totalMaquina = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchMaquina() : v.showAll(); //for preventing

        }
    }
})
