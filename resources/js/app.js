require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('app-home', require('./views/Home.vue').default);

Vue.component('delete-link', require('./components/DeleteLink.vue').default);

const app = new Vue({
    el: '#app'
});
