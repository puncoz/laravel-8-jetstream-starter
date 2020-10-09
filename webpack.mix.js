const mix = require("laravel-mix")
const path = require("path")

mix.setPublicPath(path.normalize("public/assets"))
mix.setResourceRoot("/assets/")

if (mix.inProduction()) {
    mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true,
                },
            },
        },
    })
} else {
    mix.webpackConfig({ devtool: "inline-source-map" }).sourceMaps()
}

function resolve(dir) {
    return path.join(__dirname, dir)
}

mix.webpackConfig({
    resolve: {
        alias: {
            "@": resolve("resources/js"),
            vue$: "vue/dist/vue.esm.js",
            ziggy: path.resolve("vendor/tightenco/ziggy/dist/js/route.js"),
        },
    },

    output: {
        publicPath: path.normalize("/assets/"),
        chunkFilename: "[name].js?id=[chunkhash]",
    },

    watchOptions: {
        ignored: /node_modules/,
    },
}).babelConfig({
    plugins: ["@babel/plugin-syntax-dynamic-import"],
})

mix.js("resources/assets/js/app.js", "js/app.js").version()

// @todo extract not working with dynamic import until webpack upgraded to v5
mix.extract([
    "@inertiajs/inertia", "@inertiajs/inertia-vue",
    "@tailwindcss/ui", "axios", "laravel-jetstream",
    "lodash", "portal-vue", "qs", "vue", "vue-fragment", "vue-multiselect",
])

mix.sass("resources/assets/sass/app.scss", "css/app.css").version()
mix.postCss("resources/assets/sass/tailwind.css", "css/tailwind.css", [
    require("postcss-import"),
    require("tailwindcss"),
])
