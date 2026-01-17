import "./bootstrap";
import Vue from "vue";
import ElementUI from "element-ui";

import VerifyCertificate from "./views/certificates/VerifyCertificate.vue";

Vue.use(ElementUI);
Vue.prototype.$http = window.axios;

Vue.component("courses-index", require("./views/courses/index.vue").default);
Vue.component(
    "certificates-index",
    require("./views/certificates/index.vue").default
);

Vue.component(
    "register-form",
    require("./components/RegisterForm.vue").default
);
Vue.component("verify-certificate", VerifyCertificate);

Vue.prototype.$eventHub = new Vue();

// ✅ SOLO UN ROOT: #app
if (document.getElementById("app")) {
    new Vue({
        el: "#app",
    });
}
