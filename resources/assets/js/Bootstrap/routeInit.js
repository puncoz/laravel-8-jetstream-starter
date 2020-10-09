"use strict"

import Vue       from "vue"
import route     from "ziggy"
import { Ziggy } from "../routes.generated"

export default () => {
    const customRoute = (name, params, absolute) => route(name, params, absolute, Ziggy)

    Vue.prototype.$route = customRoute

    Vue.mixin({
        methods: {
            route: customRoute,
        },
    })
}
