
export default {
    name: "Add Mixin",
    data() {
        return {
            prefix: "",
            form: {},
            resources: {
                validation:{}
            },
            mode: '',
            alert:{
                statement: 'Thất bại',
                isApiDone: false,
                classColor: 'bg-danger'
            }
        }
    },
    methods: {
        mappingResources(data) {

            if(data.validation !== undefined) {
                this.resources['validation'] = this.isEditMode() ? data.validation['edit'] : data.validation['add']
            }
            for (let key in this.form) {
                if(data.object !== undefined) {
                    this.form[key] = data.object[key]
                } else {
                    this.form[key] = ''
                }
            }
        },
        loadResources(data={}) {
            let url = this.prefix + "/resources";
            if(this.isEditMode()) {
                url += '/' + this.$route.params.id;
            }
            this.$helper.get(url)
                .then(res=>{
                    this.mappingResources(res);
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
                promise = this.$helper.put(this.prefix + action, data);

            } else {
                promise =  this.$helper.post(this.prefix + action, data);
            };

            promise.then(response => {
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
        },

        closeAlert(){
            setTimeout(()=>{
                this.alert.isApiDone = false;
                this.alert.classColor = "bg-danger";
                this.alert.statement = 'Thêm thất bại'
            }, 2000)
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
