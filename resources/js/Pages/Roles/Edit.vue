<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center">Edition rôle</div>

                <div class="card-body">
                    <form @submit.prevent="submit" class="mt-4">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom du rôle :</label>

                            <div class="col-md-6">
                                <input placeholder="Nom d'utilisateur" id="name" type="text" v-model="name" :class="{'is-invalid': this.$page.errors.email}" class="form-control" name="email" required autocomplete="email">
                                <span class="text-danger invalid-feedback small text-justify" v-if="!!this.$page.errors.name" role="alert">
                                    <strong>
                                        {{ this.$page.errors.name.join(',') }}
                                    </strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Permissions</label>
                            <div class="selectgroup selectgroup-pills col-md-6">
                                <label class="selectgroup-item p-1" v-for="p in permissions">
                                    <input type="checkbox" v-model="permission" :value="p.name" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">{{ p.name }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-4">
                                <button class="btn btn-block btn-primary font-weight-bold btn-round" type="submit"><i class="fas fa-save"></i> Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import Layout from "../../Shared/Layout";

    export default {
        layout: Layout,
        data() {
            return {
                name: null,
                permission: []
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.$route('roles.update', {id: this.role.id}), {
                    name: this.name,
                    permission: this.permission
                })
            }
        },
        props: ['role', 'permissions'],
        mounted() {
            this.role.permissions.forEach((item) => this.permission.push(item.name) )
            this.name = this.role.name
        }
    }
</script>
