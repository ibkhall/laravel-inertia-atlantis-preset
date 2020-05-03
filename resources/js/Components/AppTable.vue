<template>
    <div class="">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group mb-0 form-inline">
                    <label for="limit" class="col-5 text-muted">Afficher</label>
                    <select id="limit" v-model="limit" @change="getItems"  class="form-control col-4 rounded">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 offset-md-6">
                <input aria-label="search" type="text" @input="getItems" v-model="search" class="form-control rounded  ml-auto" placeholder="Rechercher...">
            </div>
        </div>
        <table class="table table-bordered table table-head-bg-primary mt-1">
            <thead>
            <tr class="text-center">
                <th v-for="item in headers">{{ item }}</th>
            </tr>
            </thead>
            <tbody>
            <tr  v-for="item in searchedItems" class="text-center">
                <slot name="items" v-bind:item="item"></slot>
            </tr>
            </tbody>
        </table>
    <nav aria-label="Page navigation example" v-if="searchedItems.length > 0">
        <ul class="pagination">
            <li class="page-item" :class="{disabled: 1===items.current_page}">
                <inertia-link preserve-scroll preserve-state class="page-link text-primary" :href="items.prev_page_url ? items.prev_page_url+'&q='+search+'&limit='+limit : ''">
                    <i class="fas fa-long-arrow-alt-left"></i>
                </inertia-link>
            </li>
            <li v-for="i in items.last_page" class="page-item" :class="{active: i===items.current_page}">
                <inertia-link preserve-scroll preserve-state class="page-link" :href="items.path+'?page='+i+'&q='+search+'&limit='+limit">
                    {{ i }}
                </inertia-link>
            </li>
            <li class="page-item" :class="{disabled: items.last_page===items.current_page}">
                <inertia-link preserve-scroll preserve-state class="page-link text-primary" :href="items.next_page_url ? items.next_page_url+'&q='+search+'&limit='+limit : ''">
                    <i class="fas fa-long-arrow-alt-right"></i>
                </inertia-link>
            </li>
        </ul>
    </nav>
</div>
</template>
<script>
    export default {
        data() {
            return {
                search: '',
                limit: 5
            }
        },
        methods: {
            getItems() {


                this.$inertia.replace(window.location.pathname, {
                    method: 'get',
                    data: {
                        q: this.search,
                        limit: this.limit,
                    },
                    preserveState: true,
                    preserveScroll: true,
                    only: [],
                })
            }
        },
        props: ['headers', 'items'],
        computed: {
            searchedItems() {
                return this.items.data
            }
        }
    }
</script>
