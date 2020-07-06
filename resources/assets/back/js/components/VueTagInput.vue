<template>
    <multiselect
        v-model="selectedTags"
        :options="defaultTags"
        :multiple="true"
        track-by="value"
        label="label"
        :taggable="true"
        :tag-placeholder="tagPlaceholder"
        :placeholder="placeholder"
        :close-on-select="false"
        tag-position="bottom"
        @input="tagHasBeenSelected"
        @tag="addNewTag"/>
</template>

<script>
    import Multiselect from "vue-multiselect"

    export default {
        components: { Multiselect },
        props: {
            defaultTags: { required: true, type: Array },
            placeholder: { type: String, default: "Select or add new tag" },
            tagPlaceholder: { type: String, default: "Add this as new tag" },
            // eslint-disable-next-line vue/require-default-prop
            value: { type: Array },
        },
        data() {
            return {
                selectedTags: [],
            }
        },
        watch: {
            value: {
                handler(value) {
                    this.selectedTags = value
                },
                immediate: true,
            },
        },
        methods: {
            addNewTag(newTag) {
                const tag = {
                    value: newTag,
                    label: newTag,
                }
                this.defaultTags.push(tag)
                this.selectedTags.push(tag)
                this.tagHasBeenSelected()
            },
            tagHasBeenSelected() {
                this.$emit("input", this.selectedTags)
            },
        },
    }
</script>
