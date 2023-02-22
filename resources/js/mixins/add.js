
export default {
    name: "Add Mixin",
    data() {
        return {
            prefix: "",
            form: {},
            resources: {
                validation:{}
            },
            mode: ''
        }
    },
    methods: {
        mappingResources(data) {
            if(data.data.validation !== undefined) {
                this.resources['validation'] = this.isEditMode() ? data.data.validation['edit'] : data.data.validation['add']
            }
            for (let key in this.form) {
                if(data.data.object !== undefined) {
                    this.form[key] = data.data.object[key]
                } else {
                    this.form[key] = ''
                }
            }
        },
        loadResources(data={}) {
            let url = '/api/' + this.prefix + "/resources";
            if(this.isEditMode()) {
                url += '/' + this.$route.params.id;
            }
            axios.get(url)
                .then(res=>{
                    if(res.status == 200) {
                        this.mappingResources(res);
                    }
                }).catch(err=>{
                    return err;
            })
        },
        onSubmit() {
            let promise;
            let action = '/add';
            let data = Object.assign({}, this.form);
            this.beforeSubmit(data);
            if(this.isEditMode()) {
                action = '/edit'
                data.id = this.$route.params.id;
                promise = axios.put('/api/' + this.prefix + action, data);

            } else {
                promise =  axios.post('/api/' + this.prefix + action, data);
            };

            promise.then(response => {
                    if(response.status == 201 || response.status == 200) {
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
            // do something if validate fail when submit
        },
        isEditMode() {
            if(Object.keys(this.$route.params).length !== 0 && this.$route.params.id) {
                return true;
            }
            return false;
        },

        loadMode() {
            this.mode = this.isEditMode() ? 'Edit' : 'Add'
        }
    },
    created() {
        this.loadResources()
        this.loadMode()
    },
    watch : {
        "$route.name": function(newName, oldName){
            this.loadResources();
            this.loadMode()
        }
    }
}
