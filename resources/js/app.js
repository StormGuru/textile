import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler";
import App from "./App.vue";
import router from "./router.js";

const app = createApp({
    components: {
     App
    }
});
app.use(router).mount('#app');