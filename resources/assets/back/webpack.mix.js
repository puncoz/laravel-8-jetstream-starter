const mix = require("laravel-mix")
const path = require("path")
const tailwindCss = require("tailwindcss")
const webpack = require('webpack');
require("laravel-mix-purgecss")
const MomentLocalesPlugin = require('moment-locales-webpack-plugin');

mix.setPublicPath(path.normalize("public/assets/back-office"))
mix.setResourceRoot("/assets/back-office/")

if (mix.inProduction()) {
    mix.options({
        // purifyCss: true,
        uglify: {
            uglifyOptions: {
                compress: {
                    drop_console: true,
                },
            },
        },
    })
    mix.purgeCss({ whitelistPatterns: [/multiselect/, /quill-editor/, /ql-/] })
} else {
    mix.webpackConfig({devtool: "inline-source-map"}).sourceMaps()
}

function resolve(dir) {
    return path.join(__dirname, dir)
}

mix.webpackConfig({
    plugins: [
        // To strip all locales except “en”
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
    ],
    resolve: {
        alias: {
            "@": resolve("resources/assets/back/js"),
            vue$: "vue/dist/vue.runtime.esm.js",
            ziggy: path.resolve("vendor/tightenco/ziggy/dist/js/route.js"),
        },
    },

    output: {
        publicPath: path.normalize("/assets/back-office/"),
        chunkFilename: "[name].js?id=[chunkhash]",
    },

    watchOptions: {
        ignored: /node_modules/,
    },
}).babelConfig({
    plugins: ["@babel/plugin-syntax-dynamic-import"],
})

mix.js("resources/assets/back/js/app.js", "js/app.js").version()

// @todo extract not working with dynamic import until webpack upgraded to v5
// mix.extract([
//     "jquery", "lodash",
//     "axios", "vue",
// ])

mix.autoload({
    jquery: ["$", "window.jQuery"],
})

mix.sass("resources/assets/back/sass/app.scss", "css/app.css")
    .options({
        processCssUrls: true,
        postCss: [tailwindCss("./tailwind.config.js")],
    })
    .version()
