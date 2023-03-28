import {createRouter, createWebHistory} from "vue-router";
import listStudents from '../components/students/list.vue';
import a from '../components/home.vue';
import register from '../components/register.vue';
import login from '../components/login.vue';
import listSubjects from '../components/subject/list.vue'
import addStudents from '../components/students/add.vue';
import addSubjects from '../components/subject/add.vue';
import store from "@/store";

const routes = [
    {
        name: 'home',
        path: '/',
        component: a
    },
    {
        name: 'list.student',
        path: '/list',
        component: listStudents
    },
    {
        name: 'list.subject',
        path: '/listSubject',
        component: listSubjects
    },
    {
        name: 'register',
        path: '/register',
        component: register
    },
    {
        name: 'login',
        path: '/login',
        component: login
    },
    {
        name: 'add.student',
        path: '/add',
        component: addStudents
    },
    {
        name: 'add.subject',
        path: '/addSubject',
        component: addSubjects
    },
    {
        name: 'edit.subject',
        path: '/subject/edit/:id(\\d+)',
        component: addSubjects
    },
    {
        name: 'edit.student',
        path: '/student/edit/:id(\\d+)',
        component: addStudents
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach( (to, from, next) => {
        if (to.name !== 'login' && to.name !== 'register' && !store.state.auth.authenticated) next({ name: 'login' })
            else if(to.name == 'login' && store.state.auth.authenticated) next({ name: 'home' })
            else next()
})

export default router
