import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/scss/app.scss", "resources/js/main.js"],
            refresh: ["resources/routes/**", "routes/**", "resources/views/**"],
        }),
    ],
});
