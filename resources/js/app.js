import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import BootstrapVue from 'bootstrap-vue';

import App from './components/App.vue'
import Profile from './components/Profile.vue'
import AddTask from './components/AddTask.vue'
import Board from './components/Board.vue'
// import Users from './components/Users.vue'
// import Video from './components/Video.vue'

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
    // router,
    axios
});
