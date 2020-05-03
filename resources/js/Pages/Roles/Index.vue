<template>
    <div class="card">
        <div class="card-body">
            <h2 class="text-center text-dark">Les rôles</h2>
            <inertia-link :href="$route('roles.create')" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle fa-1x"></i> Ajouter
            </inertia-link>
            <app-table :headers="['ID', 'Nom', 'Permissions', 'Actions']" :items="roles">
                <template v-slot:items="props">
                    <td>{{ props.item.id }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>
                        <template v-for="permission in props.item.permissions">
                            <span class="badge m-1 badge-info badge-pill">{{ permission.name }}</span><br>
                        </template>
                    </td>
                    <td>
                        <inertia-link title="Editer" :href="$route('roles.edit', {id: props.item.id})" class="btn btn-sm btn-warning btn-link text-lowercase px-0">
                            <i class="fas fa-edit fa-2x"></i>
                        </inertia-link>
                        <button v-if="$page.auth.user.id !== props.item.id"  @click.prevent="deleteConfirmation($route('roles.destroy', {id: props.item.id}))" class="btn btn-sm btn-danger btn-link text-lowercase px-0">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </button>
                    </td>
                </template>
            </app-table>
        </div>
    </div>
</template>


<script>
    import Layout from "../../Shared/Layout";
    import AppTable from "../../Components/AppTable";
    import {deleteConfirmation} from "../../utils";

    export default {
        layout: Layout,
        components: { AppTable },
        data() {
            return {

            }
        },

        methods: {
            deleteConfirmation
        },

        props: ['roles'],

    }
</script>
