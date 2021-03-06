/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import '@babel/polyfill';

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('show-step', require('./components/ShowStepComponent.vue').default);
Vue.component('show-child', require('./components/ShowChildComponent.vue').default);
Vue.component('challenge', require('./components/ChallengeComponent.vue').default);
Vue.component('my-step', require('./components/MyStepComponent.vue').default);
Vue.component('challenge-step', require('./components/ChallengeStepComponent.vue').default);
Vue.component('edit-step', require('./components/EditStepComponent.vue').default);
Vue.component('edit-child', require('./components/EditChildComponent.vue').default);
Vue.component('new-child', require('./components/NewChildComponent.vue').default);
Vue.component('delete-step', require('./components/DeleteStepComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
});
