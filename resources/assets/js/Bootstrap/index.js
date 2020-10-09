"use strict"

import Vue       from "vue"
import httpInit  from "./httpInit"
import routeInit from "./routeInit"

export const Bootstrap = () => {
    httpInit()
    routeInit()

    window.Bus = new Vue({ name: "Bus" })

    Vue.config.errorHandler = (err, vm, info) => {
        console.error(err, vm, info)
    }
}
