import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import Unsplash from 'unsplash-js';
import BootstrapVue from 'bootstrap-vue';

import App from './components/App.vue'
import passportClient from './components/passport/Clients.vue'
import AuthorizedClients from './components/passport/AuthorizedClients.vue'
import PersonalAccessTokens from './components/passport/PersonalAccessTokens.vue'

// import Board from './components/Board.vue'
// import Users from './components/Users.vue'
// import Video from './components/Video.vue'

export const bus = new Vue();
export const unsplash = new Unsplash({ accessKey: "Wx4M3FmX_OdJ1ZYvsZKEjfntrXJlNA_Ju9tNzCHHujE" });

Vue.use(BootstrapVue, axios)

// const router = new VueRouter({
//   mode: 'history',
//   routes: [
//     {
//         path: '/admin',
//         name: 'dashboard',
//         component: Dashboard
//     },
//     {
//         path: '/admin/sites',
//         name: 'site-list',
//         component: SiteList
//     },
//     {
//         path: '/admin/users',
//         name: 'users',
//         component: Users
//     },
//     {
//         path: '/admin/video',
//         name: 'video',
//         component: Video
//     },
//     ]
//  });

const app = new Vue({
    el: '#app',
    components: {
   		App,
        passportClient,
        AuthorizedClients,
        PersonalAccessTokens
 	},
    axios
});
