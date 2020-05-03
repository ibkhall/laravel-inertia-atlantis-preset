<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center">Créer un nouvel utilisateur</div>

                <div class="card-body">
                    <form @submit.prevent="submit" class="mt-4">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="name">Nom d'utilisateur :</label>

                            <div class="col-md-6">
                                <input :class="{'is-invalid': this.$page.errors.email}" autocomplete="email"
                                       class="form-control" id="name" name="email" placeholder="Nom d'utilisateur"
                                       required type="text" v-model="name">
                                <span class="text-danger invalid-feedback small text-justify" role="alert"
                                      v-if="!!this.$page.errors.name">
                                    <strong>
                                        {{ this.$page.errors.name.join(',') }}
                                    </strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="email">Adresse E-mail :</label>

                            <div class="col-md-6">
                                <input :class="{'is-invalid': this.$page.errors.email}" class="form-control" id="email"
                                       name="email" placeholder="Entrer votre adresse E-mail" required type="email"
                                       v-model="email">
                                <span class="text-danger invalid-feedback small text-justify" role="alert"
                                      v-if="!!this.$page.errors.email">
                                    <strong>
                                        {{ this.$page.errors.email.join(',') }}
                                    </strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="password">Mot de passe :</label>

                            <div class="col-md-6">
                                <input :class="{'is-invalid': this.$page.errors.password}" class="form-control" id="password"
                                       name="password" placeholder="Entrer votre mot de passe" required type="password"
                                       v-model="password">
                                <span class="text-danger invalid-feedback small text-justify" role="alert"
                                      v-if="!!this.$page.errors.password">
                                    <strong>
                                        {{ this.$page.errors.password.join(',') }}
                                    </strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="password_confirmation">Confirmation mot de passe :</label>

                            <div class="col-md-6">
                                <input :class="{'is-invalid': this.$page.errors.password_confirmation}" class="form-control" id="password_confirmation"
                                       name="password" placeholder="Confirmation de mot de passe" required type="password"
                                       v-model="password_confirmation">
                                <span class="text-danger invalid-feedback small text-justify" role="alert"
                                      v-if="!!this.$page.errors.password_confirmation">
                                    <strong>
                                        {{ this.$page.errors.password_confirmation.join(',') }}
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
                            <input aria-label="avatar" ref="file" @change="handleFileUpload" id="avatar" type="file">
                        </div>



                        <div class="form-group row justify-content-center">
                            <div class="col-md-4">
                                <button class="btn btn-block btn-primary font-weight-bold btn-round" type="submit"><i
                                    class="fas fa-1x fa-save"></i> Enregister
                                </button>
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
                password: null,
                password_confirmation: null,
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
                data.append('name', this.name || '')
                data.append('email', this.email || '')
                data.append('password', this.password || '')
                data.append('password_confirmation', this.password_confirmation || '')
                data.append('role', this.role || '')
                data.append('avatar', this.avatar || '')
                this.$inertia.post(this.$route('register'), data)
            }
        },
        props: ['roles'],
        mounted() {
            $('#avatar').dropify({
                messages: {
                    'default': 'Glisser et déposer une image ou cliquer',
                    'replace': 'Glisser et déposer ou cliquer pour remplacer',
                    'remove':  'Enlever',
                    'error':   'Ooops, Une erreur est survenue.'
                }
            })
        }
    }
</script>
