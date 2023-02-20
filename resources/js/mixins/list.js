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
      }
    },
    methods: {
        deleteItem(id) {
            let action = '/delete/';
            axios.delete('/api/' + this.prefix + action + `${id}`)
                .then(response => {
                    this.getList(1)
                    this.$forceUpdate
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        onClickPaginate(p) {
            this.list.current_page = p;
        },

        getList(page = null) {
            let sendData = {
                page : page ? page : this.list.current_page,
                limit: 2
            }
            axios.post('/api/' + this.prefix, sendData)
                .then(response => {
                    if(response.status == 200) {
                        for(let k in this.list){
                            if(response.data[k] != undefined){
                                this.list[k] = response.data[k];
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
