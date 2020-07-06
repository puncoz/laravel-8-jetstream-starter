import { InertiaApp } from "@inertiajs/inertia-vue"
import Vue            from "vue"
import VueQuillEditor from "vue-quill-editor"

import {
    httpConfig,
    initThirdPartyPackages,
    routeConfig,
}             from "./utils"
import Errors from "./utils/Error"

initThirdPartyPackages()
httpConfig()
routeConfig()

Vue.use(InertiaApp)
Vue.use(VueQuillEditor)

window.Bus = new Vue({ name: "Bus" })

Vue.config.errorHandler = (err, vm, info) => {
    console.error(err, vm, info)
}

const app = document.getElementById("app")

// noinspection ObjectAllocationIgnored
new Vue({ /* eslint-disable-line no-new */
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: async name => (await import("./pages/" + name)).default,
            transformProps: props => {
                return {
                    ...props,
                    errors: new Errors(props.errors),
                }
            },
        },
    }),
}).$mount(app)
