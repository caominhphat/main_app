import './bootstrap';
import '../sass/app.scss'
import {createApp} from 'vue'

import App from './components/App.vue'
import router from "./router"
import axios from 'axios'

createApp(App)
    .use(router)
    .mount("#app")
