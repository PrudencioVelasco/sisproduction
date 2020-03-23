
var this_js_script = $('script[src*=appcategoria]');
var my_var_1 = this_js_script.attr('data-my_var_1');
if (typeof my_var_1 === "undefined") {
    var my_var_1 = 'some_default_value';
}

Vue.component('modal', {//modal
    template: `
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
    el: '#app',
    data: {
        url:  my_var_1,
        addModal: false,
        editModal: false,
        //passwordModal:false,
        //deleteModal:false,
        categorias: [],
        search: {text: ''},
        emptyResult: false,
        newCategoria: {
            nombrecategoria: '',
            activo: '',
            smserror: '',

        },
        chooseCategoria: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 10,
        totalCategoria: 0,
        pageRange: 2,
         directives: {columnSortable}
    },
    created() {
        this.showAll();
    },
    methods: {
        orderBy(sortFn) {
            // sort your array data like this.userArray
            this.categorias.sort(sortFn);
        },
        showAll() {
            axios.get(this.url + "categoria/showAll").then(function (response) {
                if (response.data.categorias == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.categorias);
                }
            })
        },
        searchCategoria() {
            var formData = v.formData(v.search);
            axios.post(this.url + "categoria/searchCategoria", formData).then(function (response) {
                if (response.data.categorias == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.categorias);

                }
            })
        },
        addCategoria() {
            var formData = v.formData(v.newCategoria);
            axios.post(this.url + "categoria/addCategoria", formData).then(function (response) {
                if (response.data.error) {
                    v.formValidate = response.data.msg;
                    console.log( response.data.msg)
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
        updateCategoria() {
            var formData = v.formData(v.chooseCategoria);
            axios.post(this.url + "categoria/updateCategoria", formData).then(function (response) {
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
        getData(categorias) {
            v.emptyResult = false; // become false if has a record
            v.totalCategoria = categorias.length //get total of user
            v.categorias = categorias.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

            // if the record is empty, go back a page
            if (v.categorias.length == 0 && v.currentPage > 0) {
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();
            }
        },

        selectCategoria(categoria) {
            v.chooseCategoria = categoria;
        },
        clearMSG() {
            setTimeout(function () {
                v.successMSG = ''
            }, 3000); // disappearing message success in 2 sec
        },
        clearAll() {
            v.newCategoria = {
                nombrecategoria: '',
                activo: '',
                smserror:''};
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.categorias = null
            v.totalCategoria = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchCategoria() : v.showAll(); //for preventing

        }
    }
})
