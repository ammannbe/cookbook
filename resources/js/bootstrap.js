import Vue from 'vue';
import VueRouter from 'vue-router';
import MavonEditor from 'mavon-editor';
import Vuex from 'vuex'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

import './nav';
import env from './env';
import moment from 'moment';
moment.locale('de');

window.Vue = Vue;
window.moment = moment;
window.Loading = {
    loader: null,
    open(container = null) {
        if (this.loader) {
            return;
        }
        this.loader = Vue.prototype.$buefy.loading.open({ container });
    },
    close() {
        if (!this.loader) {
            return;
        }
        this.loader.close();
        this.loader = null;
    }
}

Vue.use(VueRouter);
Vue.use(MavonEditor);
Vue.use(Vuex);
Vue.use(Buefy, {
    defaultIconPack: 'fas',
});

Vue.prototype.$env = env;
Vue.prototype.$markdownIt = MavonEditor.markdownIt;
Vue.prototype.$Laravel = Laravel;
Vue.prototype.$moment = moment;
Vue.prototype.$loading = Loading;

Vue.prototype.$autofocus = function (selector = '[autofocus]') {
    const input = document.querySelector(selector);
    if (input) {
        setTimeout(() => {
            input.focus();
        }, 100);
    }
}


Vue.filter('name', function (obj) {
    if (obj == undefined || obj == null || !Object.keys(obj).length) return '';
    return obj.name;
});

Vue.filter('hyphenate', function (value) {
    if (value == undefined || value == null || value == '') {
        return '-';
    }
    return value;
})

Vue.filter('humanReadablePreparationTime', function (value) {
    if (!value) {
        value = '00:00';
    }

    let [hours, minutes] = value.split(":");
    let string = "";
    if (hours > 0) {
        string += `${hours}h`;
    }
    if (minutes > 0) {
        string += ` ${minutes}min`;
    }
    return string;
})
