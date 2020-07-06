"use strict"

export const initThirdPartyPackages = () => {
    try {
        // noinspection NestedAssignmentJS,AssignmentResultUsedJS
        window.$ = window.jQuery = require("jquery")
    } catch (e) {
        console.error(e)
    }
}
