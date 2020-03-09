import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import BootstrapVue from 'bootstrap-vue';

import App from './components/App.vue'

// import Board from './components/Board.vue'
// import Users from './components/Users.vue'
// import Video from './components/Video.vue'

export const bus = new Vue();

Vue.use(BootstrapVue)

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
   		App
 	},
    axios
});
