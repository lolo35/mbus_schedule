import { createRouter, createWebHashHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Cookies from 'js-cookie';

const isAuthenticated = () => {
  let loginState = Cookies.get('jwt', { path: '/'});
  if(!loginState){
    return false;
  }else{
    return true;
  }
};
const routes = [
  {
    path: '/',
    name: 'Home',
    components: {
      default: Home,
    },
    children: [
      {
        name: "Routes",
        path: "/routes",
        components: { 
          home: () => import('../views/Routes.vue')
        }
      }
    ]
  },
  {
    path: "/login",
    name: "Login",
    component: () => import('../views/Login.vue'),
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if(to.name !== "Login" && !isAuthenticated()) next ({name: "Login"}) 
  else next();
});

export default router
