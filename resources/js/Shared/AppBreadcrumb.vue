<template>
    <div class="page-header" v-if="route">
        <h4 class="page-title">{{ route.label }}</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ label }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ route.label }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                label: null
            }
        },
        props: ['route'],
        computed: {
            window: function () {
                return window
            }
        },
        watch: {
            '$page.title': {
                handler: function () {
                    if(this.route) {
                        this.label = this.route.items.find((item) => item.url === (window.location.origin+window.location.pathname)).label
                    }
                },
                deep: true,
                immediate: true
            }
        }
    }
</script>
