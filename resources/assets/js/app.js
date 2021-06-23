
require('./credit');
require('./bootstrap');
require('./confirm');
require('./loadingonsubmit');

import Vue from 'vue';
Vue.component('example', require('./components/Example.vue').default);
Vue.component('light-box', require('./components/LightBox.vue').default);
window.Vue = Vue;

import Swal from 'sweetalert2';
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.swal = Swal;
window.toast = Toast;


$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    $('[data-toggle="popover"]').popover({
        trigger: 'hover'
    })
})
