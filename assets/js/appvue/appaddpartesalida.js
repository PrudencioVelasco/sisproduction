
Vue.config.devtools = true
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
        url: 'http://localhost:8383/sisproduction/',
        addModal: false,
        editModal: false,
        //passwordModal:false,
        //deleteModal:false,
        partes: [],
        search: {text: ''},
        emptyResult: false, 
        chooseParte: {},
        formValidate: [],
        successMSG: '',

        //pagination
        currentPage: 0,
        rowCountPage: 5,
        totalParte: 0,
        pageRange: 2
    },
    created() {
        this.showAll(); 
    },
    methods: {
        showAll() {
            axios.get(this.url + "salida/showAllParte").then(function (response) {
                if (response.data.partes == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.partes);
                }
            })
        },
        searchParte() {
            var formData = v.formData(v.search);
            axios.post(this.url + "salida/searchPartes", formData).then(function (response) {
                if (response.data.partes == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.partes);

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
            v.formValidate = false;
            v.addModal = false;
            v.editModal = false;
            v.deleteModal = false;
            v.refresh()

        },
        noResult() {

            v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
            v.partes = null
            v.totalClient = 0 //remove current page if is empty

        },

        pageUpdate(pageNumber) {
            v.currentPage = pageNumber; //receive currentPage number came from pagination template
            v.refresh()
        },
        refresh() {
            v.search.text ? v.searchPartes() : v.showAll(); //for preventing

        }
    }
})