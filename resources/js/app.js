import './bootstrap';
import '../sass/app.scss'
import Paginate from "vuejs-paginate-next";
import {createApp} from 'vue'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import App from './components/App.vue'
import router from "./router"
import axios from 'axios'

createApp(App)
    .use(router)
    .component('Paginate', Paginate)
    .component('VueDatePicker', VueDatePicker)
    .mount("#app")
