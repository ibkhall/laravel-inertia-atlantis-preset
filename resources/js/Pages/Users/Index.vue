<template>
    <div class="card">
        <div class="card-body">
            <h2 class="text-center text-dark">Les utilisateurs</h2>
            <inertia-link :href="$route('users.create')" class="btn btn-sm btn-primary">
                <i class="fas fa-user-plus fa-1x"></i> Ajouter
            </inertia-link>
            <app-table :headers="['ID', 'Avatar', 'Nom', 'Email', 'Rôles', 'Actions']" :items="users">
                <template v-slot:items="props">
                    <td>{{ props.item.id }}</td>
                    <td><img :src="props.item.avatar" width="50" height="50" :alt="'user'+props.item.id"></td>
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.email }}</td>
                    <td>
                        <template v-for="role in props.item.roles">
                            <span class="badge badge-success badge-pill m-1">{{ role.name }}</span><br>
                        </template>
                    </td>
                    <td>
                        <inertia-link title="Editer" :href="$route('users.edit', {id: props.item.id})" class="btn btn-sm btn-warning btn-link text-lowercase px-0">
                            <i class="fas fa-user-edit fa-2x"></i>
                        </inertia-link>
                        <button v-if="$page.auth.user.id !== props.item.id"  @click="deleteConfirmation($route('users.destroy', {id: props.item.id}))" class="btn btn-sm btn-danger btn-link text-lowercase px-0">
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

        props: ['users'],

    }
</script>
