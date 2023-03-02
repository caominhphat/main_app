import axios from 'axios'
import router from '@/router'
export default {
    namespaced: true,
    state:{
        authenticated:false,
        user:{},
        token_type:'',
        access_token:''
    },
    getters:{
        authenticated(state){
            return state.authenticated
        },
        user(state){
            return state.user
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },
        SET_USER (state, value) {
            state.user = value
        },
        SET_TOKEN_TYPE(state, value) {
            state.token_type = value
        },
        SET_ACCESS_TOKEN(state, value) {
            state.access_token = value
        },
    },
    actions:{
        setupLoginUser({commit}, data){
            commit('SET_USER',data)
            commit('SET_AUTHENTICATED',true)
            commit('SET_TOKEN_TYPE',data['token_type'] ?? '')
            commit('SET_ACCESS_TOKEN',data['access_token'] ?? '')
        },
        login({commit}){
            return axios.get('/api/user').then(({data})=>{
                commit('SET_USER',data)
                commit('SET_AUTHENTICATED',true)
                router.push({name:'dashboard'})
            }).catch(({response:{data}})=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
            })
        },
        logout({commit}){
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false)
            commit('SET_TOKEN_TYPE','')
            commit('SET_ACCESS_TOKEN','')
        }
    }
}
