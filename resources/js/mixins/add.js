
export default {
    name: "Add Mixin",
    data() {
        return {
            prefix: "",
            form: {},
            resources: {},
            schema: {}
        }
    },
    methods: {
        mappingResources(data) {
            if(Object.keys(data.data).length >= 1) {
                this.resources['validation'] = this.convertProxyObjectToPojo(data.data.validation)
            }
        },
        loadResources(data={}) {
            axios.get('/api/' + this.prefix + "/resources")
                .then(res=>{
                    if(res.status == 200) {
                        this.mappingResources(res);
                    }
                }).catch(err=>{
                    return err;
            })
        },
        onSubmit() {
            let action = '/add';
            let data = Object.assign({}, this.form);
            this.beforeSubmit(data);
            axios.post('/api/' + this.prefix + action, data)
                .then(response => {
                    if(response.status == 201) {
                        alert('Them thanh cong')
                    } else {
                        alert('Them that bai')
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },

        beforeSubmit(data){},
        onInvalidSubmit(){
            console.log(1)
        }
    },
    mounted() {
        this.loadResources()
    }
}
