
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
        url:'http://localhost/sisproduction/',
        addModal: false,
        editModal:false,
        //passwordModal:false,
        //deleteModal:false,
        inventarios:[],
        search: {text: ''},
        emptyResult:false, 
        chooseInventario:{},
        formValidate:[],
        successMSG:'',
        
        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalInventario:0,
        pageRange:2
    },
     created(){
      this.showAll(); 
    },
    methods:{
         showAll(){ axios.get(this.url+"inventario/showAll").then(function(response){
                 if(response.data.inventarios == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.inventarios);
                    }
            })
        },
          searchInventario(){
            var formData = v.formData(v.search);
              axios.post(this.url+"client/searchClient", formData).then(function(response){
                  if(response.data.inventarios == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.inventarios);
                    
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
        getData(inventarios){
            v.emptyResult = false; // become false if has a record
            v.totalInventario = inventarios.length //get total of user
            v.inventarios = inventarios.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            
             // if the record is empty, go back a page
            if(v.inventarios.length == 0 && v.currentPage > 0){ 
            v.pageUpdate(v.currentPage - 1)
            v.clearAll();  
            }
        },
            
        selectRol(inventario){
            v.chooseInventario = inventario; 
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
                      v.inventarios = null 
                     v.totalInventario = 0 //remove current page if is empty
            
        },

       
        pageUpdate(pageNumber){
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
                v.refresh()  
        },
        refresh(){
             v.search.text ? v.searchInventario() : v.showAll(); //for preventing
            
        }
    }
})