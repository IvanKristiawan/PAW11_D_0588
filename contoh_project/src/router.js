//import vue router
import { createRouter, createWebHistory } from "vue-router";
//define a routes
const routes = [
  {
    path: "/",
    name: "beranda",
    component: () => import("@/components/DashboardLayout.vue"),
    children: [
      {
        path: "/departemen",
        name: "departemen.index",
        component: () => import("@/views/Departemen/indexPage.vue"),
      },
      {
        path: "/departemen/create",
        name: "departemen.create",
        component: () => import("@/views/Departemen/createPage.vue"),
      },
      {
        path: "/departemen/edit",
        name: "departemen.edit",
        component: () => import("@/views/Departemen/editPage.vue"),
      },
      {
        path: "/pegawai",
        name: "pegawai.index",
        component: () => import("@/views/Pegawai/indexPage.vue"),
      },
      {
        path: "/pegawai/create",
        name: "pegawai.create",
        component: () => import("@/views/Pegawai/createPage.vue"),
      },
      {
        path: "/pegawai/edit",
        name: "pegawai.edit",
        component: () => import("@/views/Pegawai/editPage.vue"),
      },
      {
        path: "/proyek",
        name: "proyek.index",
        component: () => import("@/views/Proyek/indexPage.vue"),
      },
      {
        path: "/proyek/create",
        name: "proyek.create",
        component: () => import("@/views/Proyek/createPage.vue"),
      },
      {
        path: "/proyek/edit",
        name: "proyek.edit",
        component: () => import("@/views/Proyek/editPage.vue"),
      },
    ],
  },
];
//create router
const router = createRouter({
  history: createWebHistory(),
  routes, // config routes
});
export default router;
