import Vue from 'vue'
const vue = Vue.prototype;
export default [
    {
        url: vue.$route('home'),
        label: 'Dashboard',
        icon: 'fas fa-home',
    },
    {
        label: 'Configuration',
        icon: 'fas fa-cogs',
        items: [
            {
                url: vue.$route('config.system'),
                label: 'Système'
            }
        ]
    },
    {
        label: 'Administration',
        icon: 'fas fa-users-cog',
        items: [
            {
                url: vue.$route('users.index'),
                label: 'Utilisateurs'
            },
            {
                url: vue.$route('roles.index'),
                label: 'Rôles'
            }
        ]
    }
]
