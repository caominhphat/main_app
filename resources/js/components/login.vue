<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <VeeForm :validation-schema="resources.validation" v-slot="{ handleSubmit , isSubmitting}">
                            <form @submit="handleSubmit($event, onSubmit)">
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
                                    Login
                                </button>
                                <p @click="socialLogin($event)" class=" ms-3 btn btn-outline-danger mt-3" id="google">
                                    Google <i class="bi bi-google"></i>
                                </p>
                            </form>
                        </VeeForm>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
import {Field, Form as VeeForm, ErrorMessage, defineRule} from 'vee-validate';
import store from "../store";
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
                email: "",
                password: "",
            }
        }
    },
    methods: {
        openWindow(url, title, options = {}){
            if (typeof url === 'object') {
                options = url
                url = ''
            }

            options = { url, title, width: 600, height: 720, ...options }

            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top
            const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width
            const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height

            options.left = ((width / 2) - (options.width / 2)) + dualScreenLeft
            options.top = ((height / 2) - (options.height / 2)) + dualScreenTop

            const optionsStr = Object.keys(options).reduce((acc, key) => {
                acc.push(`${key}=${options[key]}`)
                return acc
            }, []).join(',')

            const newWindow = window.open(url, title, optionsStr)

            if (window.focus) {
                newWindow.focus()
            }
            return newWindow
        },

        socialLogin(e) {
            if(e.srcElement.id) {
                const newWindow = this.openWindow('', 'message')
                this.$helper.get(`authorize/${e.srcElement.id}/attach`).then((res) => {
                    if(res.success) {
                        newWindow.location.href = res.data;
                    }
                });
            }
        },

        ...mapActions({
            signIn:'auth/setupLoginUser'
        }),
        mappingResources(data) {
            if(data.data.validation !== undefined) {
                this.resources['validation'] = data.data.validation['login'] ? data.data.validation['login'] : {}
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
            let url = '/api/' + this.prefix + "/login";
            axios.post(url, {
                name: this.form.name,
                email: this.form.email,
                password: this.form.password
            })
                .then(response => {
                    if (response.data.success) {
                        this.signIn(response.data.user)
                        window.location.href = "/"
                    } else {
                        this.error = response.data.message
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },

        onMessage (e) {
            if (e.origin !== window.origin || e.data.event_name != 'social_login') {
                return false;
            }
            if (!e.data.success_login) {
                this.$helper.toast({
                    message : "Đăng nhập thất bại",
                    styleClass : "bg-warning"
                });
                return false;
            }
            this.signIn(e.data.user)
            window.location.href = "/"
            return true;
        },
    },

    created() {
        this.loadResources()
    },
    mounted () {
        window.addEventListener('message', this.onMessage, false)
    },

    beforeUnmount () {
        window.removeEventListener('message', this.onMessage)
    }
}
</script>
