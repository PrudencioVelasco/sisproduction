
Vue.config.devtools = true
var v = new Vue({
   el:'#app',
    data:{
        url:'http://localhost:8080/sisproduction/',
        //addModal: false,
        //editModal:false,
        //passwordModal:false,
        //deleteModal:false,
        detallestatus:[],
        search: {text: ''},
        emptyResult:false,
        newDetalleStatus:{
            iddetalleparte:'',
            idstatus:'',
            comentariosrechazo:'',
            smserror: ''
          },
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
        // console.log(this.showAll);
    },
    methods:{
        showAll(){ 
            axios.get(this.url+"location/getAllPallets").then(function(response){
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
            axios.post(this.url+"location/search", formData).then(function(response){
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
            v.newDetalleStatus = {
            iddetalleparte:'',
            idstatus:'',
            comentariosrechazo:'',
            smserror: ''};
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
