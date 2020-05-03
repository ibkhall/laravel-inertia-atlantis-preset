<template>
    <div class="table-responsive card card-body mt-1">
        <input type="text" @input="getItems" v-model="search" class="form-control border border-secondary border-bottom-0 p-3 rounded form-control-plaintext ml-auto w-25" placeholder="Rechercher...">
        <table class="table mt-1 table-sm table-hover table-bordered">
            <thead class="bg-table-header text-white text-center">
            <tr>
                <th v-for="item in headers" class="font-13 font-weight-bold p-1 border-0" style="box-shadow: 0 4px 4px rgba(17,40,62,0.78); border-radius: 4px">
                    {{ item }}
                </th>
            </tr>
            </thead>
            <tbody>
                <tr :class="{'bg-ok': item.type === 'BONI', 'bg-none': item.type === 'MALI'}" v-for="item in searchedItems" class="text-center font-12">
                    <slot name="items" v-bind:item="item"></slot>
                </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" v-if="searchedItems.length > 0">
            <ul class="pagination">
                <li class="page-item" :class="{disabled: 1===items.current_page}">
                    <inertia-link preserve-scroll preserve-state class="page-link text-primary" :href="items.prev_page_url ? items.prev_page_url+'&query='+search : ''">
                        <i class="material-icons">navigate_before</i>
                    </inertia-link>
                </li>
                <li v-for="i in items.last_page" class="page-item" :class="{active: i===items.current_page}">
                    <inertia-link preserve-scroll preserve-state class="page-link" :href="items.path+'?page='+i+'&query='+search">
                        {{ i }}
                    </inertia-link>
                </li>
                <li class="page-item" :class="{disabled: items.last_page===items.current_page}">
                    <inertia-link preserve-scroll preserve-state class="page-link text-primary" :href="items.next_page_url ? items.next_page_url+'&query='+search : ''">
                        <i class="material-icons">navigate_next</i>
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
                search: ''
            }
        },
        methods: {
            getItems() {
                let parts = window.location.href.split('?')
                let obj = {}
                if(parts[1]) {
                    let queries = parts[1].split('&')
                    for(let q of queries) {
                        let item = q.split('=')
                        if(item[0] !== 'query') {
                            obj[item[0]] = item[1]
                        }
                    }

                }

                this.$inertia.replace(window.location.pathname, {
                    method: 'get',
                    data: {
                        query: this.search,
                        ...obj
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
