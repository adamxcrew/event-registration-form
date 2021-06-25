require('./credit');
require('./bootstrap');
require('./confirm');
require('./loadingonsubmit');

import Vue from 'vue';
Vue.component('example', require('./components/Example.vue').default);
Vue.component('light-box', require('./components/LightBox.vue').default);
window.Vue = Vue;

// Inputmask
import Inputmask from "inputmask";

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    $('[data-toggle="popover"]').popover({
        trigger: 'hover'
    })

    Inputmask({
        clearIncomplete: true
    }).mask(document.querySelectorAll("input[data-inputmask]"));
})
