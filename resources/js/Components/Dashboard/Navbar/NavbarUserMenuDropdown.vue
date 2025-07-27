<template>
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img :src="userAvatar" class="user-image img-circle elevation-2" alt="User Image">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="d-flex flex-row gap-4 user-header bg-lightblue">

                <img :src="userAvatar" class="img-circle elevation-2" alt="User Image">

                <p>
                    {{ userName }}
                    <small v-if="userRole">{{ userRole }}</small>
                </p>
            </li>
            <li class="user-footer">
                <Link :href="route('profile.edit')" class="btn btn-default btn-flat">Perfil</Link>
                <Link :href="route('logout')" method="post" as="button" class="btn btn-default btn-flat float-right">
                Cerrar Sesión</Link>
            </li>
        </ul>
    </li>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { AuthUser } from '@/Types/AuthUser';

const page = usePage();

const user = computed<AuthUser | undefined>(() => page.props.auth?.user);

const userName = computed(() => user.value?.name || 'Invitado');
const userRole = computed(() => user.value?.role || '');
const userAvatar = computed(() => user.value?.avatar_url || '/assets/images/default-avatar.png');
</script>