import './bootstrap';
import '../sass/app.scss'
import Paginate from "vuejs-paginate-next";
import {createApp} from 'vue'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {defineRule, Field, Form} from 'vee-validate'
import App from './components/App.vue'
import router from "./router"
import AllRules from '@vee-validate/rules';
import Helper from './plugins/helper';
import store from './store/index';

Object.keys(AllRules).forEach(rule => {
    defineRule(rule, AllRules[rule]);
});
createApp(App)
    .use(router)
    .use(Helper)
    .use(store)
    .component('Field', Field)
    .component('VeeForm', Form)
    .component('Paginate', Paginate)
    .component('VueDatePicker', VueDatePicker)
    .mount("#app")
