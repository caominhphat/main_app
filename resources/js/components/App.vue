<template>
    <div>
        <button type="button" class="btn btn-outline-primary">
            <router-link class="m-2" to="/">Go to Home</router-link>
        </button>
        <button type="button" class="btn btn-outline-primary">
            <router-link class="m-2" to="/list">List student</router-link>
        </button>
        <button type="button" class="btn btn-outline-primary">
            <router-link class="m-2" to="/add">Add student</router-link>
        </button>
        <button type="button" class="btn btn-outline-primary">
            <router-link class="m-2" to="/listSubject">List subject</router-link>
        </button>
        <button type="button" class="btn btn-outline-primary">
            <router-link class="m-2" to="/addSubject">Add subject</router-link>
        </button>
        <button type="button" class="btn btn-outline-primary">
            <router-link class="m-2" to="/register">Register</router-link>
        </button>
        <button type="button" class="btn btn-outline-primary" v-if="!isAuthenticate">
            <router-link class="m-2" to="/login" >Login</router-link>
        </button>
        <button type="button" class="btn btn-outline-primary" v-else @click="logoutUser">
            <span>Logout</span>
        </button>
        <router-view />
    </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    data(){
        return {
            isAuthenticate: this.$store.state.auth.authenticated
        }
    },
    methods:{
        ...mapActions({
            logout:'auth/logout'
        }),
        logoutUser(){
            this.$helper.post('authorize/logout')
            this.logout();
            window.location.href = "/login"
        }
    },

    beforeCreate() {
        this.$helper.post('check_valid_access_token')
    }
}
</script>
