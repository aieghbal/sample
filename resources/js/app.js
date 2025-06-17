import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';

// Vuetify imports
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Fonts
import '@mdi/font/css/materialdesignicons.css'
import '@fontsource/roboto/400.css'
import '@fontsource/roboto/700.css'

// Create Vuetify instance
const vuetify = createVuetify({
    components,
    directives,
})

createApp(App)
    .use(vuetify)
    .mount('#app');
