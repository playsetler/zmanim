import { createRouter, createWebHistory } from "vue-router";
import Login from "./pages/Login";
import Registration from "./pages/Registration";
import Layouts from "./pages/Layouts";
import Layout from "./pages/Layout";
import Profile from "./pages/Profile";
import Test from "./pages/Test";
import Media from "./pages/Media";

const routes = [
    {
        path:"/",
        name: "Layouts",
        component: Layouts,
        alias: ['/index.html', '/home', '/layouts'],
        meta: { requiresAuth: true }
    },
    {
        path:"/login",
        name: "Login",
        component: Login
    },
    {
        path:"/register",
        name: "Registration",
        component: Registration
    },
    {
        path:"/layouts/:id",
        name: "Layout",
        component: Layout
    },
    {
        path:"/profile",
        name: "Profile",
        component: Profile
    },
    {
        path:"/create",
        name: "Create",
        component: Layout,
        meta: { requiresAuth: true }
    },
    {
        path:"/edit/:id",
        name: "Edit",
        component: Layout,
        meta: { requiresAuth: true }
    },
    {
        path:"/media/:mediaType/:mediaId?",
        name: "Media",
        component: Media,
        meta: { requiresAuth: true }
    },
    {
        path:"/test",
        name: "Test",
        component: Test
    }];

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    if (!token) {
        if(to.name == 'Login' || to.name == 'Registration') {
            return next();
        } else {
            return next({name: 'Login', params: { referer: from.name }});
        }
    }
  
    if((to.name == 'Login' || to.name == 'Registration') && token) {
        return next({ name: from.name || 'Layouts' });
    }
  
    next();
  });

export default router