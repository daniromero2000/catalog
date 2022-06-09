require('./bootstrap');
import Vuex from 'vuex'
import Vue from 'vue'
import store from './store';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(Vuex)

Vue.component('list-category', require('./components/Generals/dragSortProducts.vue').default);
Vue.component('sort-category', require('./components/Generals/dragSortCategory.vue').default);

const app = new Vue({
    el: '#app',
});
