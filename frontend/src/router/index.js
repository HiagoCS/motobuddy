import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/home/index.vue'
import ProfileView from '../views/profile/index.vue'
import ConfigView from '../views/config/index.vue'
import RegisterView from '../views/register/index.vue'
import LoginView from '../views/login/index.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      props:true
    },
    {
      path: '/profile/me',
      name: 'my-profile',
      component: ProfileView
    },
    {
      path: '/config',
      name: 'config',
      component: ConfigView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    }
  ]
})

export default router
