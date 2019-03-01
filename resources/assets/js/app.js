
require('./bootstrap');

window.Vue = require('vue');

Vue.component('example', require('./components/Example.vue').default);
Vue.component('light-box', require('./components/LightBox.vue').default);

import Swal from 'sweetalert2';
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.swal = Swal;
window.toast = Toast;


// const app = new Vue({
//     el: '#app'
// });
