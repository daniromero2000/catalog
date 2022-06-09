require('./bootstrap');
import Vuex from 'vuex'
import Vue from 'vue'
import VueAgile from 'vue-agile'
import 'vueperslides/dist/vueperslides.css'
import store from './store';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(Vuex)
Vue.use(VueAgile)

Vue.component('list-category', require('./components/Generals/dragSortProducts.vue').default);
Vue.component('sort-category', require('./components/Generals/dragSortCategory.vue').default);
Vue.component('carrosel-template', require('./components/front/carousel.vue').default);
Vue.component('atribute-component', require('./components/front/atributeComponent.vue').default);


const app = new Vue({
    el: '#app',
});


