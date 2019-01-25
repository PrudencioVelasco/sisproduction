
Vue.config.devtools = true
Vue.component('modal',{ //modal
    template:`
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
   el:'#app',
    data:{
        url:'http://localhost:8383/sisproduction/',
        addModal: false,
        editModal:false,
        //passwordModal:false,
        //deleteModal:false,
        detallestatus:[],
        search: {text: ''},
        emptyResult:false,
        chooseDetalleStatus:{},
        formValidate:[],
        successMSG:'',

        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalDetalleStatus:0,
        pageRange:2
    },
     created(){
      this.showAll();
    },
    methods:{
         showAll(){ axios.get(this.url+"bodega/showAllEnviados").then(function(response){
                 if(response.data.detallestatus == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.detallestatus);
                        console.log(response.data.detallestatus);
                    }
            })
        },

          searchDetalleStatus(){
            var formData = v.formData(v.search);
              axios.post(this.url+"bodega/searchEnviados", formData).then(function(response){
                  if(response.data.detallestatus == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.detallestatus);

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
        getData(detallestatus){
            v.emptyResult = false; // become false if has a record
            v.totalDetalleStatus = detallestatus.length //get total of user
            v.detallestatus = detallestatus.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

             // if the record is empty, go back a page
            if(v.detallestatus.length == 0 && v.currentPage > 0){
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();
            }
        },

        selectDetalleStatus(detallestatus){
            v.chooseDetalleStatus = detallestatus;
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
                      v.detallestatus = null
                     v.totalDetalleStatus = 0 //remove current page if is empty

        },


        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()
        },
        refresh(){
             v.search.text ? v.searchDetalleStatus() : v.showAll(); //for preventing

        }
    }
})
