import Vue from "vue";
import VueRouter from "vue-router";
import AuthGuard from "./utils/auth.guard";
import { adminRoot } from "./constants/config";
import { UserRole } from "./utils/auth.roles";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: () => import(/* webpackChunkName: "home" */ "./views/home"),
  },
  {
    path: adminRoot,
    component: () => import(/* webpackChunkName: "app" */ "./views/app"),
    redirect: `${adminRoot}/dashboards`,
    meta: { loginRequired: true, roles: [UserRole.Admin, UserRole.Chef, , UserRole.Staff] },
    /*
    define with Authorization :
    meta: { loginRequired: true, roles: [UserRole.Admin, UserRole.Chef] },
    */
    children: [
      {
        path: "dashboards",
        component: () =>
          import(/* webpackChunkName: "dashboards" */ "./views/app/dashboards"),
        redirect: `${adminRoot}/dashboards/default`,
        meta: { roles: [UserRole.Admin, UserRole.Chef, UserRole.Staff ] },
        children: [
          {
            path: "default",
            component: () =>
              import(/* webpackChunkName: "dashboards" */ "./views/app/dashboards/Default"),
            // meta: { roles: [UserRole.Admin, UserRole.Chef] },
          }
        ]
      },
      {
        path: "categories",
        component: () =>
        import(/* webpackChunkName: "dashboards" */ "./views/app/foods/Categories"),
        meta: { roles: [UserRole.Admin] },
      },
      {
        path: "products",
        component: () =>
        import(/* webpackChunkName: "dashboards" */ "./views/app/foods/Products"),
        meta: { roles: [UserRole.Admin] },
      },
      {
        path: "users",
        component: () =>
        import(/* webpackChunkName: "dashboards" */ "./views/app/foods/Users"),
        meta: { roles: [UserRole.Admin] },
      },
      {
        path: "orders",
        component: () =>
        import(/* webpackChunkName: "dashboards" */ "./views/app/foods/Orders"),
        meta: { roles: [UserRole.Admin] },
      },
      {
        path: "stafforders",
        component: () =>
        import(/* webpackChunkName: "dashboards" */ "./views/app/foods/StaffOrders"),
        meta: { roles: [UserRole.Staff] },
      },
      {
        path: "cheforders",
        component: () =>
        import(/* webpackChunkName: "dashboards" */ "./views/app/foods/ChefOrders"),
        meta: { roles: [UserRole.Chef] },
      },
      {
        path: "salesreport",
        component: () =>
        import(/* webpackChunkName: "dashboards" */ "./views/app/foods/SalesReport"),
        meta: { roles: [UserRole.Admin] },
      },
      // {
      //   path: "categories",
      //   component: () =>
      //     import(/* webpackChunkName: "applications" */ "./views/app/applications"),
      //   redirect: `${adminRoot}/categories/todo`,
      //   children: [
      //     {
      //       path: "todo",
      //       component: () =>
      //         import(/* webpackChunkName: "applications" */ "./views/app/applications/Todo")
      //     },
      //   ]
      // },
      // {
      //   path: "products",
      //   component: () => import(/* webpackChunkName: "ui" */ "./views/app/ui"),
      //   redirect: `${adminRoot}/products/index`,
      //   children: [
      //     {
      //       path: "forms",
      //       component: () =>
      //         import(/* webpackChunkName : "forms" */ "./views/app/ui/forms"),
      //       redirect: `${adminRoot}/ui/forms/layouts`
      //     }
      //   ]
      // },
      // {
      //   path: "users",
      //   component: () =>
      //     import(/* webpackChunkName: "menu" */ "./views/app/menu"),
      //   redirect: `${adminRoot}/users/types`
      // },
    ]
  },
  {
    path: "/error",
    component: () => import(/* webpackChunkName: "error" */ "./views/Error")
  },
  {
    path: "/unauthorized",
    component: () => import(/* webpackChunkName: "error" */ "./views/Unauthorized")
  },
  {
    path: "/user",
    component: () => import(/* webpackChunkName: "user" */ "./views/user"),
    redirect: "/user/login",
    children: [
      {
        path: "login",
        component: () =>
          import(/* webpackChunkName: "user" */ "./views/user/Login")
      },
      {
        path: "register",
        component: () =>
          import(/* webpackChunkName: "user" */ "./views/user/Register")
      },
      {
        path: "forgot-password",
        component: () =>
          import(/* webpackChunkName: "user" */ "./views/user/ForgotPassword")
      },
      {
        path: "reset-password",
        component: () =>
          import(/* webpackChunkName: "user" */ "./views/user/ResetPassword")
      },

    ]
  },
  {
    path: "*",
    component: () => import(/* webpackChunkName: "error" */ "./views/Error")
  }
];

const router = new VueRouter({
  linkActiveClass: "active",
  routes,
  mode: "history",
});
router.beforeEach(AuthGuard);
export default router;
