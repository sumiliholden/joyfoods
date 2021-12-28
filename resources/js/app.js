require('./bootstrap');

import Vue from 'vue';
import App from './vue/app';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import 'bootstrap/dist/css/bootstrap.css'
import "bootstrap-vue/dist/bootstrap-vue.css";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import swal from "sweetalert";

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
library.add(faPlusSquare, faTrash)

Vue.component('font-awesome-icon', FontAwesomeIcon)
const app = new Vue({
  el: '#app',
  components: { App }
});