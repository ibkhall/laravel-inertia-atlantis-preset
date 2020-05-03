<template>
    <div class="sidebar sidebar-style-2" :data-background-color="$page.config.theme_sidebar">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <img :src="'/'+$page.auth.user.avatar" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ $page.auth.user.name }}
									<span class="user-level">{{ $page.auth.user.email }}</span>
									<span class="caret"></span>
								</span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <inertia-link :href="$route('users.edit', {id: $page.auth.user.id})">
                                        <span class="link-collapse">Paramètres du compte</span>
                                    </inertia-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-primary">
                    <template v-for="route in routes">
                        <li class="nav-item mb-2" :class="{active: (window.location.origin+window.location.pathname) === route.url}" v-if="route.url">
                            <inertia-link :href="route.url">
                                <i :class="route.icon"></i>
                                <p>{{ route.label }}</p>
                            </inertia-link>
                        </li>
                        <li class="nav-item mb-2" :class="{active: route.items.map((item) => item.url).includes((window.location.origin+window.location.pathname))}" v-else>
                            <a data-toggle="collapse" :href="'#'+route.label" :aria-expanded="route.items.map((item) => item.url).includes((window.location.origin+window.location.pathname))">
                                <i :class="route.icon"></i>
                                <p>{{ route.label }}</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" :class="{show: route.items.map((item) => item.url).includes((window.location.origin+window.location.pathname))}" :id="route.label">
                                <ul class="nav nav-collapse">
                                    <li v-for="item in route.items" :class="{active: (window.location.origin+window.location.pathname) === item.url}">
                                        <inertia-link :href="item.url">
                                            <span class="sub-item">{{ item.label }}</span>
                                        </inertia-link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['routes'],
        computed: {
            window: function () {
                return window
            }
        }
    }
</script>
