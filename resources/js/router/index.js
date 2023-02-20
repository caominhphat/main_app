import {createRouter, createWebHistory} from "vue-router";
import listBooks from '../components/books/list.vue';
import a from '../components/home.vue';
import register from '../components/register.vue';
import login from '../components/login.vue';
import listSubjects from '../components/subject/list.vue'
import addBooks from '../components/books/add.vue';

const routes = [
    {
        path: '/',
        component: a
    },
    {
        path: '/list',
        component: listBooks
    },
    {
        path: '/listSubject',
        component: listSubjects
    },
    {
        path: '/register',
        component: register
    },
    {
        path: '/login',
        component: login
    },
    {
        path: '/add',
        component: addBooks
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
