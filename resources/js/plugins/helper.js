import axios from "axios";
import store from '../store/index';
export default {
    install(app) {
        app.config.globalProperties.$helper = {
            Enum: {
                DATE_FORMAT_SHORT: "dd-MM-yyyy",
            },
            setAuthHeader(config) {
                if (config.headers == undefined) {
                    config.headers = {};
                }
                if (store.state.auth.user && store.state.auth.access_token) {
                    let token_type = store.state.auth.token_type != undefined ? store.state.auth.token_type : 'Bearer';
                    config.headers.Authorization = `${token_type} ${store.state.auth.access_token}`;
                }
                let appToken = document.querySelector('meta[name="csrf-token"]');
                if (appToken) {
                    config.headers['X-CSRF-TOKEN'] = appToken.getAttribute('content')
                }
            },

            async get(link, data, config = {}){
                this.setAuthHeader(config);
                let uri = link;
                if(data){
                    uri += '?' + (new URLSearchParams(data)).toString();
                }
                return this.customPost('get', uri, config);
            },
            async post(link, data = {}, config = {}){
                return this.customPost('post', link, data, config)
            },
            async put(link, data = {}, config = {}){
                return this.customPost('put', link, data, config)
            },
            async delete(link, data = {}, config = {}){
                return this.customPost('delete', link, data, config)
            },
            async patch(link, data = {}, config = {}){
                return this.customPost('patch', link, data, config)
            },

            async customPost(method, link, data = {}, config = {}){
                if(typeof axios[method] != "function"){
                    return null;
                }
                this.setAuthHeader(config);

                let promise = method != 'delete' ? axios[method]('/api/' + link, data, config):
                    axios.delete('/api/' + link, { data : data, headers : config.headers });

                return promise.then(res=>res.data)
                    .catch(error=>{
                        if(error.response.status === 401){
                            store.dispatch('auth/logout')
                            this.$forceUpdate
                        }
                        throw error;
                    });
            },

        }
    }
}
