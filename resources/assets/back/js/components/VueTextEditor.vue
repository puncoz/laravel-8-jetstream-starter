<template>
    <quill-editor
        ref="myQuillEditor"
        v-model="content"
        :options="editorOption"
        @blur="onEditorBlur($event)"
        @focus="onEditorFocus($event)"
        @input="contentHasBeenAdded"
        @ready="onEditorReady($event)"/>
</template>

<script>
    import { quillEditor } from "vue-quill-editor";
    import hljs from "highlight.js"

    export default {
        components: { quillEditor },
        props: {
            value: { type: String, default: null },
        },
        data() {
            return {
                content: null,
                editorOption: {
                    modules: {
                        toolbar: [
                            ["bold", "italic", "underline", "strike"],
                            ["blockquote", "code-block"],
                            [{ header: 1 }, { header: 2 }],
                            [{ list: "ordered" }, { list: "bullet" }],
                            [{ script: "sub" }, { script: "super" }],
                            [{ indent: "-1" }, { indent: "+1" }],
                            [{ direction: "rtl" }],
                            [{ size: ["small", false, "large", "huge"] }],
                            [{ header: [1, 2, 3, 4, 5, 6, false] }],
                            [{ font: [] }],
                            [{ color: [] }, { background: [] }],
                            [{ align: [] }],
                            ["clean"],
                            ["link", "image", "video"],
                        ],
                        syntax: {
                            highlight: text => hljs.highlightAuto(text).value,
                        },
                    },
                },
            }
        },
        watch: {
            value: {
                handler(value) {
                    this.content = value
                },
                immediate: true,
            },
        },
        computed: {
            editor() {
                return this.$refs.myQuillEditor.quill
            },
        },
        methods: {
            onEditorBlur(quill) {
                // console.log("editor blur!", quill)
            },
            onEditorFocus(quill) {
                // console.log("editor focus!", quill)
            },
            onEditorReady(quill) {
                // console.log("editor ready!", quill)
            },
            onEditorChange({ quill, html, text }) {
                // console.log("editor change!", quill, html, text)
                this.content = html
            },
            contentHasBeenAdded() {
                this.$emit("input", this.content)
            },
        },
    }
</script>

<style scoped>

</style>
