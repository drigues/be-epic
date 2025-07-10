import './bootstrap';
import { createApp } from 'vue';
import Alpine from 'alpinejs';
import HelloWorld from './components/HelloWorld.vue';
import LinkManager from './components/LinkManager.vue';

window.Alpine = Alpine;
Alpine.start();

const app = createApp({});
app.component('hello-world', HelloWorld);
app.mount('#vue-root');

app.component('link-manager', LinkManager);
app.mount('#vue-link-manager');
