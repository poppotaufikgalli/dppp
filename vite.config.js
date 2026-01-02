import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
//import tailwindcss from '@tailwindcss/vite';
import dotenv from 'dotenv';

dotenv.config();

export default defineConfig(({ mode }) => {
    return {
        plugins: [
            laravel({
                input: ['resources/scss/styles.scss', 'resources/js/app.js'],
                //input: ['resources/js/app.js'],
                refresh: true,
            }),
            //tailwindcss(),
        ],
        css: {
            preprocessorOptions: {
                scss: {
                    api: 'modern-compiler', // or "modern"
                    silenceDeprecations: ['mixed-decls', 'color-functions', 'global-builtin', 'import'],
                }
            }
        },
    }
});
