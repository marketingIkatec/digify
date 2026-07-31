import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { viteStaticCopy } from "vite-plugin-static-copy";

export default defineConfig({
    build: {
        manifest: false,
        rollupOptions: {
            input: {
                app: "resources/css/app.css",
                app_admin: "resources/css/app.admin.css",
                app_blog: "resources/css/app.blog.css",
                app_colorbox: "resources/css/app.colorbox.css",
                js_app: "resources/js/app.js",
                js_blog: "resources/js/app.blog.js",
                js_admin: "resources/js/app.admin.js",
                js_colorbox: "resources/js/app.jquery.colorbox.js",
            },
            output: {
                // **REMOVE O HASH DOS NOMES**
                entryFileNames: `assets/[name].js`,
                chunkFileNames: `assets/[name].js`,
                assetFileNames: `assets/[name].[ext]`,
            },
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/app.admin.css",
                "resources/css/app.blog.css",
                "resources/js/app.admin.js",
                "resources/js/app.blog.js",
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: "resources/images/*",
                    dest: "images",
                },
            ],
        }),
    ],
});
