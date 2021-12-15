/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// const Vue = require("vue");

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from "vue";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/MainComponent.vue -> <example-component></example-component>
 */

// Vue.component('main-component', require('./components/MainComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import MainComponent from "./components/MainComponent";

import store from './store/index'
import { BootstrapVue } from 'bootstrap-vue'

Vue.use(BootstrapVue)

const app = new Vue({
    name: 'MainComponent',
    el: '#app',
    store,
    components: {
        'MainComponent' : MainComponent
    }
});
