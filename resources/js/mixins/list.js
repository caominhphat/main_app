export default {
    name: "List Mixin",
    data () {
      return {
          list:{
              loading: false,
              per_page: 2,
              last_page: 1,
              total: 0,
              current_page: 1,
              data: []
          },
          prefix: '',
          alert:{
              statement: 'Thất bại',
              isApiDone: false,
              classColor: 'bg-danger'
          }
      }
    },
    methods: {
        closeAlert(){
            setTimeout(()=>{
                this.alert.isApiDone = false;
                this.alert.classColor = "bg-danger";
                this.alert.statement = 'Thêm thất bại'
            }, 2000)
        },
        deleteItem(id) {
            let action = '/delete/';
            this.$helper.delete(this.prefix + action + `${id}`)
                .then(response => {
                    this.getList(1)
                    this.list.current_page = 1;
                    this.$forceUpdate
                    console.log(response.success)
                    if(response.success) {
                        this.alert.classColor = "bg-success";
                        this.alert.statement = 'Thêm thành công'
                    }
                    this.alert.isApiDone = true;
                    this.closeAlert();
                })
                .catch((error) => {
                    this.alert.isApiDone = true;
                    this.closeAlert();
                    console.error(error);
                });
        },
        onClickPaginate(p) {
            this.list.current_page = p;
        },

        getList(page = null) {
            let sendData = {
                page : page ? page : this.list.current_page,
                limit: 10
            }

            this.$helper.post(this.prefix, sendData)
                .then(response => {
                    if(response.data.length > 0) {
                        for(let k in this.list){
                            if(response[k] != undefined){
                                this.list[k] = response[k];
                            }
                        }
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },

        settingTimeout() {
            clearTimeout(window.timeout_load_list)
            window.timeout_load_list = setTimeout(this.getList, 500);
        },
    },
    mounted() {
        this.getList(1);
    },
    watch:{
        "list.current_page": function(){
            this.settingTimeout()
        },
    }
}
