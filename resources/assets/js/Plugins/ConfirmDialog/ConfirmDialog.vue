<template>
    <div v-show="openDialog" class="confirm-dialog" :class="config.customClass" @click.stop="closeOnBackdrop">
        <div class="confirm-dialog--content confirm-dialog--content--radius">
            <div class="confirm-dialog--header">
                <div v-if="config.showIcon">
                    <div v-if="config.iconType !== 'img'" class="confirm-dialog--header--icon"
                         :class="`confirm-dialog--header--icon--${config.iconType}`">
                        <div class="confirm-dialog--header--line"
                             :class="`confirm-dialog--header--line--${config.iconType}`"/>
                        <div class="confirm-dialog--header--line"
                             :class="`confirm-dialog--header--line--${config.iconType}-2`"/>
                    </div>
                    <div v-else class="confirm-dialog--header--icon">
                        <img :src="config.iconUrl" alt="">
                    </div>
                </div>
                <strong class="confirm-dialog--header--title" v-text="config.title"/>
            </div>

            <div class="confirm-dialog--body">
                <div v-html="config.message"/> <!-- eslint-disable-line vue/no-v-html -->
            </div>

            <div class="confirm-dialog--footer">
                <button class="button button-confirm button-radius button-red" :class="config.confirmButtonClass"
                        @click="handleConfirm" v-text="config.confirmButtonText"/>
                <button class="button button-cancel button-radius button-gray" :class="config.cancelButtonClass"
                        @click="handleCancel" v-text="config.cancelButtonText"/>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import defaultConfig from "./config"

    export default {
        name: "ConfirmDialog",

        data: () => ({
            config: { ...defaultConfig },

            openDialog: false,
            onConfirmHandler: null,
            onCancelHandler: null,
            data: null,
        }),

        methods: {
            open(config) {
                const { data, onConfirmHandler, onCancelHandler, ...additionalConfigs } = config

                this.config = { ...this.config, ...additionalConfigs }
                this.data = { ...data }
                this.onConfirmHandler = onConfirmHandler
                this.onCancelHandler = onCancelHandler

                this.openDialog = true
            },

            closeOnBackdrop() {
                if (this.config.closeOnBackdrop) {
                    this.close()
                }
            },

            handleConfirm() {
                if (typeof this.onConfirmHandler !== "undefined") {
                    this.onConfirmHandler(this.data)
                }

                this.close()
            },

            handleCancel() {
                if (typeof this.onCancelHandler !== "undefined") {
                    this.onCancelHandler(this.data)
                }

                this.close()
            },

            close() {
                this.openDialog = false
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./style";
</style>
