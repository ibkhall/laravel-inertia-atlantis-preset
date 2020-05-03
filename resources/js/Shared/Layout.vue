<template>
    <div class="wrapper" :class="{sidebar_minimize: $page.config.toggle_sidebar}">
        <app-navbar></app-navbar>
        <app-sidebar :routes="routes"></app-sidebar>
        <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <app-breadcrumb :route="route"></app-breadcrumb>
                        <slot/>
                    </div>
                </div>
                <app-footer></app-footer>
        </div>
    </div>
</template>

<script>
    import AppSidebar from './AppSidebar'
    import AppNavbar from './AppNavbar'
    import AppFooter from './AppFooter'
    import AppBreadcrumb from './AppBreadcrumb'
    import routes from "../routes";

    export default {
        data(){
            return {
                routes: routes,
                route: {}
            }
        },
        components: {AppSidebar, AppNavbar, AppFooter, AppBreadcrumb},
        methods: {
            showNotification(type, title, message, icon) {
                $.notify({
                    icon,
                    title,
                    message,
                },{
                    type,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 2000,
                });
            }
        },
        updated() {

            $('body').attr('data-background-color', this.$page.config.theme)
            document.title = this.$page.title || 'Laravel'
            let flashes = this.$page.flashes
            if (flashes.success) {
                this.showNotification('success','Succès !', flashes.success, 'fas fa-check-circle')
            }else if(flashes.danger) {
                this.showNotification('danger', 'Erreur ', flashes.danger, 'far fa-times-circle')

            }else if(flashes.warning) {
                this.showNotification('warning', 'Avertissement !', flashes.warning, 'fas fa-exclamation-circle')

            }else if(flashes.info) {
                this.showNotification('info', 'Info', flashes.info, 'fas fa-info-circle')

            }
            this.$page.flashes = {}
        },
        watch: {
            '$page.title': {
                handler: function () {
                    this.route = this.routes.find(function(item) {
                        if (item.items !== undefined) {
                             return item.items.find((it) => it.url === (window.location.origin + window.location.pathname)) !== undefined
                        }
                    })
                },
                deep: true,
                immediate: true
            }
        },
        mounted() {
            document.title = this.$page.title || 'Laravel'
        }
    }
</script>
