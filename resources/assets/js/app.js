//
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */
//
//
//
// require('./bootstrap');
//
//
// window.Vue = require('vue');
//
//
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// //Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
//
// //在入口文件中引入文件并将变量挂到全局
// import defines from './defines'
// Object.keys(defines).forEach((key)=>{
//     Vue.prototype[key] = defines[key];
// })
//
// //引入插件
// import VueResource from 'vue-resource'
// Vue.use(VueResource)
//
// import App from './components/App'; // 引入Hello 组件
// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';
// import '../css/css/bootstrap.css'
// import '../css/css/bootstrap.min.css'
//
// import router from './router/index.js';
//
// Vue.use(ElementUI);
//
//
//
// const app = new Vue({
//     el: '#app',
//     router,
//     render: h => h(App)
// });
