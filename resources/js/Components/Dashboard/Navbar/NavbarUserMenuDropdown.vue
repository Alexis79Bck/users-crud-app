<template>
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img :src="user.avatar" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline">{{ user.name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="user-header bg-primary">
                <img :src="user.avatar" class="img-circle elevation-2" alt="User Image">
                <p>{{ user.name }}<small>{{ user.role }}</small></p>
            </li>
            <li class="user-footer">
                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                <a href="#" class="btn btn-default btn-flat float-right">Cerrar Sesión</a>
            </li>
        </ul>
    </li>
</template>

<script setup>
const user = {
    name: 'Alexander Pierce',
    role: 'Administrador',
    avatar: 'dist/img/user2-160x160.jpg'
}
</script>