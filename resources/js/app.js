import './bootstrap';
import '../css/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// --- NUEVAS IMPORTACIONES PARA LA SIMULACIÓN DE AUTENTICACIÓN ---
import { getSimulatedAuthenticatedUser } from '@/Services/AuthUserService'; // Importa la función de UserService

const appName = import.meta.env.VITE_APP_NAME ;

createInertiaApp({
    title: (title) => `${appName} | ${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        // --- LÓGICA DE SIMULACIÓN DE AUTENTICACIÓN REFINADA ---
        // Generamos el usuario simulado directamente
        const simulatedUser = getSimulatedAuthenticatedUser();

        // Inyectamos el usuario simulado en las props iniciales de Inertia.
        // Esto imita perfectamente cómo Laravel ya incluye `$page.props.auth.user`
        // en la carga inicial de la página tras una autenticación exitosa.
        props.initialPage.props.auth = { user: simulatedUser };

        // --- FIN LÓGICA DE SIMULACIÓN DE AUTENTICACIÓN ---
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
