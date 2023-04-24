import { createApp, nextTick } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from './App.vue';
import Login from './Login.vue';
import Register from './Register.vue';
import Main from './Main.vue';
import Personal from './Personal.vue';
import Order from './Order.vue';
import Info from './Info.vue';
import AddOrder from './AddOrder.vue';
import Organizations from './Organizations.vue';
import AddOrganization from './AddOrganization.vue';
import Search from './Search.vue';
import AllOrders from './AllOrders.vue';
import SingleOrganization from './SingleOrganization.vue';
import EditOrganization from './EditOrganization.vue';
import EditOrder from './EditOrder.vue';
import SingleOrder from './SingleOrder.vue';
import AllOrganizations from './AllOrganizations.vue';
import SearchOrders from './SearchOrders.vue';
import SearchOrganizations from './SearchOrganizations.vue';
import Admin from './admin/Admin.vue';
import Users from './admin/Users.vue';
import Categories from './admin/Categories.vue';
import News from './admin/News.vue';
import AddNews from './admin/AddNews.vue';
import EditNews from './admin/EditNews.vue';
//const login = () => import('./Login.vue');

const routes =[
{
    path: "/",
    name: Main,
    component: Main
},

{
    path: "/login", 
    name: Login,
    component: Login
},

{
    path: "/register", 
    name: Register,
    component: Register
},

{
    path: "/orders/all", 
    name: AllOrders,
    component: AllOrders
},

{
    path: "/organizations/all", 
    name: AllOrganizations,
    component: AllOrganizations
},

{
    path: "/organization/:id", 
    name: SingleOrganization,
    component: SingleOrganization
},

{
    path: "/redact/organization/:id", 
    name: EditOrganization,
    component: EditOrganization
},

{
    path: "/redact/order/:id", 
    name: EditOrder,
    component: EditOrder
},

{
    path: "/order/:id", 
    name: SingleOrder,
    component: SingleOrder
},

{
    path: "/search", 
    name: Search,
    component: Search,
    children: [

        {path: "organizations/:text",
        name: SearchOrganizations,
        component: SearchOrganizations
         },

         {path: "orders/:text",
         name: SearchOrders,
        component: SearchOrders
         }
    ]
},

{
    path: "/personal", 
    name: Personal,
    component: Personal,
    children: [

        {path: "order",
        component: Order
         },

         {path: "organizations",
        component: Organizations
         },

         {path: "info",
        component: Info
         }, 
         {path: "add-order",
         component: AddOrder
          },
          {path: "add-organization",
         component: AddOrganization
          }
    ]
},

{
    path: "/admin", 
    name: Admin,
    component: Admin,
    children: [

        {path: "users",
        component: Users
         },

         {path: "categories",
        component: Categories
         },
         

        {path: "news",
          component: News
         },

        {path: "add-news",
         component: AddNews
         },

         {path: "edit-news/:id",
         component: EditNews
         }
    ]
},


{
    path: '/:nf(.*)', redirect: '/'
}
];

const router = createRouter({
    routes, 
    history: createWebHistory(import.meta.env.BASE_URL)

});

// router.beforeEach((to, from, next) => {
//     const token = localStorage.getItem('x_xsrf_token');
//     if (to.path !== '/login' ||  to.path === '/register' && !token) next()
//     if (to.path === '/login' || to.path === '/register'  && token) next({ path: '/personal' })
//     // если пользователь не авторизован, то `next` будет вызываться дважды
//     else next()
//   })

  router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    if(!token){
        if(to.path === '/login' ||  to.path === '/register' || to.path === '/'){
            return next()
        } 

        if(to.path === '/personal'){
            next({ path: '/login' })
        }
        
    }

    if(token){
        if(to.path === '/login' ||  to.path === '/register'){
            next({ path: '/personal/info' })
        }
        
    }
 
    // если пользователь не авторизован, то `next` будет вызываться дважды
    next()
  })


// router.beforeEach((to, from, next) => {
//     const token = localStorage.getItem('x_xsrf_token');
//     if (to.path !== '/login' && !token) next({ path: '/login' })
//     if (to.path === '/login' || to.path === '/register'  && token) next({ path: '/personal' })
//     // если пользователь не авторизован, то `next` будет вызываться дважды
//     else next()
//   })

// router.beforeEach((to, from, next) => {
//     const token = localStorage.getItem('x_xsrf_token')
//     console.log(token);

//     if(to.path !== 'login'){
//         if(!token){
//             next({ path: '/login' })
//         }
//     }

//     if(to.path == 'login' && token ){
//         if(!token){
//           next({ path: '/personal' })
//         }
//     }


    //next();
// })


export default router