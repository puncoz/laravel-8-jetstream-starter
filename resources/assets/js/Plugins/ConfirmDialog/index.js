"use strict"

import ConfirmDialogComponent from "./ConfirmDialog"

class ConfirmDialog {
    constructor() {
        this.initialized = []
    }

    install(Vue, options) {
        const Dialog = Vue.extend(ConfirmDialogComponent)

        const dialogWrapper = document.createElement("div")
        dialogWrapper.setAttribute("id", "confirm-dialog")
        document.body.appendChild(dialogWrapper)

        const dialog = new Dialog()
        dialog.$mount("#confirm-dialog")

        Vue.directive("confirm", {
            bind: (el, binding) => {
                if (typeof binding.value.id === "undefined") {
                    throw new Error(
                        "'id' should be defined in v-confirm directives.",
                    )
                }

                if (this.initialized[binding.value.id]) {
                    return
                }
                this.initialized[binding.value.id] = true

                el.addEventListener("click", () => {
                    options = { ...options, ...binding.value }
                    dialog.open(options)
                })
            },

            unbind: (el, binding) => {
                this.initialized[binding.value.id] = false
            },
        })
    }
}

export default new ConfirmDialog()
