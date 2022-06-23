require("./bootstrap");
window.Vue = require("vue").default;
import { createApp } from "vue";
import App from './App.vue';
import router from "./router";

const app = createApp(App);
app.config.unwrapInjectedRef = true;
app.use(router).mount("#app");