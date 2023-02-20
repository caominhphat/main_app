

export default {
    name: "Add Mixin",
    data() {
        return {
            prefix: "",
            form: {},
        }
    },
    methods: {
        onSubmit() {
            let action = '/add/';
            let data = Object.assign({}, this.form);
            this.beforeSubmit(data);
            axios.post('/api/' + this.prefix + action, data)
                .then(response => {
                    if(response.status == 200) {
                        alert('Them thanh cong')
                    } else {
                        alert('Them that bai')
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },

        beforeSubmit(data){}
    }
}
