<template>
    <div class="select-none hover:opacity-75 cursor-pointer inline-flex items-center justify-center rounded-full"
         :class="{[bgColor]: bgColor, 'shadow-lg': dropShadow, [width]: width, [height]: height}"
         :style="randomBgColorStyle">
        <span
            class="font-bold"
            :class="{[textSize]: textSize, [textColor]: textColor}"
            v-text="user.initials"/>
    </div>
</template>

<script type="text/ecmascript-6">
    import { random } from "../utils"

    export default {
        name: "UserProfileImage",

        props: {
            user: { type: Object, required: true },
            bgColor: { type: String, required: false, default: "bg-primary" },
            textColor: { type: String, required: false, default: "text-white" },
            dropShadow: { type: Boolean, required: false, default: false },
            width: { type: String, required: false, default: "w-12" },
            height: { type: String, required: false, default: "h-12" },
            textSize: { type: String, required: false, default: "" },
            randomizeColor: { type: Boolean, required: false, default: true },
        },

        data: () => ({
            colors: ["#15BC70", "#00B4A4", "#E8DB6D", "#E7843D", "#DA3551"],
        }),

        computed: {
            randomBgColorStyle: function() {
                if (!this.randomizeColor) {
                    return ""
                }

                return `background-color: ${this.colors[random(0, this.colors.length - 1)]};`
            },
        },
    }
</script>
