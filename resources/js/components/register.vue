<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Register</div>
                    <div class="card-body" >
                        <VeeForm :validation-schema="resources.validation" v-slot="{ handleSubmit , isSubmitting}">
                            <form @submit="handleSubmit($event, onSubmit)">
                                <div class="form-group">
                                    <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                    <Field name="name" type="text" v-model="form.name" rules="required">
                                        <input id="name" class="form-control" v-model="form.name"
                                               autofocus autocomplete="off">
                                        <ErrorMessage name="name" class="text-danger"/>
                                    </Field>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                    <Field name="email" type="text" v-model="form.email">
                                        <input id="email" type="email" class="form-control" v-model="form.email"
                                               autofocus autocomplete="off">
                                        <ErrorMessage name="email" class="text-danger"/>
                                    </Field>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>
                                    <Field name="password" type="text" v-model="form.password">
                                        <input id="password" type="password" class="form-control" v-model="form.password"
                                               autocomplete="off">
                                        <ErrorMessage name="password" class="text-danger"/>
                                    </Field>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    Register
                                </button>
                            </form>
                        </VeeForm>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Field, Form as VeeForm, ErrorMessage, defineRule} from 'vee-validate';
export default {
    components: {Field, VeeForm, ErrorMessage},
    data() {
        return {
            error: null,
            prefix: 'authorize',
            resources: {
                'validation': {}
            },
            form : {
                name: "",
                email: "",
                password: "",
            }
        }
    },
    methods: {
        mappingResources(data) {
            if(data.data.validation !== undefined) {
                this.resources['validation'] = data.data.validation['register'] ? data.data.validation['register'] : {}
            }
        },
        loadResources(data={}) {
            let url = '/api/' + this.prefix + "/resources";
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
                let url = '/api/' + this.prefix + "/register";
                    axios.post(url, {
                        name: this.form.name,
                        email: this.form.email,
                        password: this.form.password
                    })
                        .then(response => {
                            if (response.data.success) {
                                window.location.href = "/login"
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
        },
    },
    created() {
        this.loadResources()
    },
}
</script>
