import {createRouter, createWebHistory} from "vue-router";
import listStudents from '../components/students/list.vue';
import a from '../components/home.vue';
import register from '../components/register.vue';
import login from '../components/login.vue';
import listSubjects from '../components/subject/list.vue'
import addBooks from '../components/students/add.vue';

const routes = [
    {
        path: '/',
        component: a
    },
    {
        path: '/list',
        component: listStudents
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
