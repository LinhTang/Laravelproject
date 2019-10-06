/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import Vue from "vue";
import Vuetify from "vuetify";
import VueRouter from "vue-router";
import VueResource from "vue-resource";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VueResource);

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "bf61d2270aa3026f30ab", //Add your pusher key here
    cluster: 'eu',
    forceTLS: true
});
import "vuetify/dist/vuetify.min.css";

import Auth from "./auth";

Vue.prototype.$auth = new Auth(window.user);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("admin", require("./components/Admin.vue").default);
Vue.component("order", require("./components/Order.vue").default);
Vue.component("company", require("./components/Company.vue").default);

import Dashboard from "./pages/Dashboard.vue";
import Menu from "./pages/Menu.vue";
import Users from "./pages/Users.vue";
import Roles from "./pages/Roles.vue";
import Morder from "./pages/Morder.vue";
import Welcome from "./pages/Welcome.vue";

const routes = [
    {
        path: "/admin/welcome",
        component: Welcome
    },

    {
        path: "/admin/roles",
        component: Roles
    },

    {
        path: "/admin/users",
        component: Users
    },

    {
        path: "/admin/menu",
        component: Menu
    },
    {
        path: "/company/morder",
        component: Morder
    },
    {
        path: "/company/dashboard",
        component: Dashboard
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    vuetify: new Vuetify(),
    data: {
        chatMessage : [],
        userId : null,
        chats : [],
        chatWindows : [],
        chatStatus : 0,
        chatWindowStatus : [],
        chatCount : [] 
    },
    created(){
        window.Echo.channel('chat-message'+window.userid)
            .listen('ChatMessage', (e) => {
                console.log(e.user);
                this.userId = e.user.sourceuserid;
                if(this.chats[this.userId]){
                    this.show = 1;
                    this.$set(app.chats[this.userId], this.chatCount[this.userId] ,e.user);
                    this.chatCount[this.userId]++;
                    console.log("pusher");
                    console.log(this.chats[this.userId]);                   
                }else{
                    this.createChatWindow(e.user.sourceuserid,e.user.name)
                    this.$set(app.chats[this.userId], this.chatCount[this.userId] ,e.user);
                    this.chatCount[this.userId]++;
                }
                
        });
    },
    http: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    },
    methods: {
    sendMessage(event){
            this.userId = event.target.id;
            var message = this.chatMessage[this.userId];
            
            this.$http.post('chat',{
                'userid' : this.userId,
                'message' : message
            }).then(response => {
                
                this.chatMessage[this.userId] = '';
                this.$set(app.chats[this.userId], this.chatCount[this.userId] , {
                    "message": message, 
                    "name" : window.username
            });
            this.chatCount[this.userId]++;
                console.log("send");
            }, response => {
                this.error = 1;
                console.log("error");
                console.log(response);
            });
        },
    getUserId(event){
        this.userId = event.target.id;
        this.createChatWindow(this.userId,event.target.innerHTML);
        console.log(this.userId);
    },
    createChatWindow(userid,username){
        if(!this.chatWindowStatus[userid]){
            
            this.chatWindowStatus[userid] = 1;
            this.chatMessage[userid] = '';
            this.$set(app.chats, userid , {});
            this.$set(app.chatCount, userid , 0);
            this.chatWindows.push({"senderid" : userid , "name" : username});
        }
        
    }
}});