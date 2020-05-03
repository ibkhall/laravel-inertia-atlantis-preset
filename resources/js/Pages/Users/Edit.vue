<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center">Edition utilisateur</div>

                <div class="card-body">
                    <form @submit.prevent="submit" class="mt-4">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom d'utilisateur :</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail :</label>

                            <div class="col-md-6">
                                <input placeholder="Entrer votre adresse E-mail" id="email" type="email" v-model="email" :class="{'is-invalid': this.$page.errors.email}" class="form-control" name="email" required>
                                <span class="text-danger invalid-feedback small text-justify" v-if="!!this.$page.errors.email" role="alert">
                                    <strong>
                                        {{ this.$page.errors.email.join(',') }}
                                    </strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Rôles: </label>
                            <div class="selectgroup selectgroup-pills col-md-6">
                                <label class="selectgroup-item p-1" v-for="r in roles">
                                    <input type="checkbox" v-model="role" :value="r.name" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">{{ r.name }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input aria-label="avatar" ref="file" @change="handleFileUpload" id="avatar" type="file" :data-default-file="'/'+user.avatar">
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
                email: null,
                name: null,
                role: [],
                avatar: null
            }
        },

        methods: {
            handleFileUpload(){
                this.avatar = this.$refs.file.files[0];
            },
            submit() {
                let data = new FormData()
                data.append('_method', 'PUT')
                data.append('name', this.name || '')
                data.append('email', this.email || '')
                data.append('role', this.role || '')
                data.append('avatar', this.avatar || '')
                this.$inertia.post(this.$route('users.update', {id: this.user.id}), data)
            }
        },
        props: ['user', 'roles'],
        mounted() {
            $('#avatar').dropify({
                messages: {
                    'default': 'Glisser et déposer une image ou cliquer',
                    'replace': 'Glisser et déposer ou cliquer pour remplacer',
                    'remove':  'Enlever',
                    'error':   'Ooops, Une erreur est survenue.'
                }
            })
            this.user.roles.forEach((item) => this.role.push(item.name) )
            this.name = this.user.name
            this.email = this.user.email
        }
    }
</script>
