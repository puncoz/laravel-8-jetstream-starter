"use strict"

import Vue             from "vue"
import httpInit        from "./httpInit"
import progressBarInit from "./progressBarInit"
import routeInit       from "./routeInit"

export const Bootstrap = () => {
    httpInit()
    routeInit()
    progressBarInit()

    window.Bus = new Vue({ name: "Bus" })

    Vue.config.errorHandler = (err, vm, info) => {
        console.error(err, vm, info)
    }
}
