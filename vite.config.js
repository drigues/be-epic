// VITE.CONFIG.JS

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
    cors: true,
    hmr: { host: 'localhost', protocol: 'ws', port: 5173 },
  },
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/guest.css',
        'resources/js/guest.js',
      ],
      refresh: true,
    }),
    vue(),  // enable .vue SFC support
  ],
  resolve: {
    alias: {
      // Ensure we load the compiler-included build
      'vue': 'vue/dist/vue.esm-bundler.js',
      // optional shortcut for your JS folder
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
});
