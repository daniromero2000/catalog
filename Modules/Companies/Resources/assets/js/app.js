require('./bootstrap');

import Vuex from 'vuex'
import Vue from 'vue'
import store from './store';

Vue.component('app-header', require('./components/admin/header.vue').default);
Vue.use(Vuex)

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    namespace: 'Modules.Companies.Events',
    key: 1234,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

const header = new Vue({
    el: '#notification',
    store
});