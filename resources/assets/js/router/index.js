import Vue from 'vue';
import VueRouter from 'vue-router';
import Index from '../components/Index'
Vue.use(VueRouter);
//Vue.http.headers.common['token'] = 'YXBpOnBhc3N3b3Jk';

export default new VueRouter({
    saveScrollPosition: true,
    routes: [
        {
            /*
            * 设置根目录
            * */
            path: '/',
            redirect: '/Index'
        },
        {
            path: '/index',
            component: Index
        }

    ]
});