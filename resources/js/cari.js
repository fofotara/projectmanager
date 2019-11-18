
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('cari-index',require('./components/cari/index').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#cari',
});
