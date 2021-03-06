<template>
    <div class="relative">
        <div @click="open = ! open">
            <slot name="trigger"/>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false"/>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open"
                 class="absolute z-50 mt-2 rounded-md shadow-lg"
                 :class="[widthClass, alignmentClasses]"
                 style="display: none;"
                 @click="open = false">
                <div class="rounded-md shadow-xs" :class="contentClasses">
                    <slot name="content"/>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "DropDownMenu",

        props: {
            align: { type: String, required: false, default: "right" },
            width: { type: String, required: false, default: "48" },
            contentClasses: { type: Array, required: false, default: () => ["py-1", "bg-white"] },
        },

        data: () => ({
            open: false,
        }),

        computed: {
            widthClass() {
                return {
                    48: "w-48",
                }[this.width.toString()]
            },

            alignmentClasses() {
                if (this.align === "left") {
                    return "origin-top-left left-0"
                }

                if (this.align === "right") {
                    return "origin-top-right right-0"
                }

                return "origin-top"
            },
        },

        created() {
            const closeOnEscape = (e) => {
                if (this.open && e.keyCode === 27) {
                    this.open = false
                }
            }

            this.$once("hook:destroyed", () => {
                document.removeEventListener("keydown", closeOnEscape)
            })

            document.addEventListener("keydown", closeOnEscape)
        },
    }
</script>
