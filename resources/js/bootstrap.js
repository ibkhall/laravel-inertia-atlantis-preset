window._ = require('lodash')
window.WebFont = require('./webfont/webfont.min')
WebFont.load({
    google: {"families":["Lato:300,400,700,900"]},
    custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/fonts.min.css']},
    active: function() {
        sessionStorage.fonts = true;
    }
});
require('dropify/dist/js/dropify')

import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'
Vue.prototype.$route = (...args) => route(...args).url()
Vue.use(InertiaApp)
const app = document.getElementById('app')
window.vm = new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(app)
