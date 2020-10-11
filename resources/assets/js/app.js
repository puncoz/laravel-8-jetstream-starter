"use strict"

import { InertiaApp }         from "@inertiajs/inertia-vue"
import { InertiaForm }        from "laravel-jetstream"
import PortalVue              from "portal-vue"
import Vue                    from "vue"
import { Plugin as Fragment } from "vue-fragment"
import { Bootstrap }          from "./Bootstrap"
import InteractsWithErrorBags from "./Mixins/InteractsWithErrorBags"
import ConfirmDialog          from "./Plugins/ConfirmDialog"

Bootstrap()

Vue.use(InertiaApp)
Vue.use(InertiaForm)
Vue.use(PortalVue)
Vue.use(ConfirmDialog, { closeOnBackdrop: false })
Vue.use(Fragment)

Vue.extend({
    mixins: [InteractsWithErrorBags],
})

const app = document.getElementById("app")

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app)
