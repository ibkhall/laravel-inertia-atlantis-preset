<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center">Configuartion du système</div>

                <div class="card-body">
                    <form @submit.prevent="submit" class="mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="name">Nom du système
                                        :</label>

                                    <div class="col-md-6">
                                        <input :class="{'is-invalid': this.$page.errors.email}" class="form-control"
                                               id="name" placeholder="Nom d'utilisateur" required type="text"
                                               v-model="name">
                                        <span class="text-danger invalid-feedback small text-justify" role="alert"
                                              v-if="!!this.$page.errors.name">
                                    <strong>
                                        {{ this.$page.errors.name.join(',') }}
                                    </strong>
                                </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input aria-label="logo" ref="file" @change="handleFileUpload" id="logo" type="file" name="logo" :data-default-file="config.logo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="form-group">
                                            <label class="form-label d-block">Thème mode</label>
                                            <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input checked="" class="selectgroup-input" type="radio"
                                                           v-model="theme" value="bg1">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                        class="fa fa-sun"></i></span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input class="selectgroup-input" type="radio" v-model="theme"
                                                           value="dark">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                        class="fa fa-moon"></i></span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Thème Entête du logo</label>
                                            <div class="row gutters-xs">
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_logo" type="radio"
                                                               v-model="theme_logo" value="blue">
                                                        <span class="colorinput-color bg-primary"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_logo" type="radio"
                                                               v-model="theme_logo" value="purple">
                                                        <span class="colorinput-color bg-secondary"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_logo" type="radio"
                                                               v-model="theme_logo" value="light-blue">
                                                        <span class="colorinput-color bg-info"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_logo" type="radio"
                                                               v-model="theme_logo" value="green">
                                                        <span class="colorinput-color bg-success"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_logo" type="radio"
                                                               v-model="theme_logo" value="orange">
                                                        <span class="colorinput-color bg-warning"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_logo" type="radio"
                                                               v-model="theme_logo" value="red">
                                                        <span class="colorinput-color bg-danger"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_logo" type="radio"
                                                               v-model="theme_logo" value="dark">
                                                        <span class="colorinput-color bg-dark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Thème Sidebar</label>
                                            <div class="row gutters-xs">
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_sidebar"
                                                               type="radio" v-model="theme_sidebar" value="bg1">
                                                        <span class="colorinput-color bg-primary"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_sidebar"
                                                               type="radio" v-model="theme_sidebar" value="dark">
                                                        <span class="colorinput-color bg-dark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Thème Navbar</label>
                                            <div class="row gutters-xs">
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_navbar" type="radio"
                                                               v-model="theme_navbar" value="blue">
                                                        <span class="colorinput-color bg-primary"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_navbar" type="radio"
                                                               v-model="theme_navbar" value="purple">
                                                        <span class="colorinput-color bg-secondary"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_navbar" type="radio"
                                                               v-model="theme_navbar" value="light-blue">
                                                        <span class="colorinput-color bg-info"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_navbar" type="radio"
                                                               v-model="theme_navbar" value="green">
                                                        <span class="colorinput-color bg-success"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_navbar" type="radio"
                                                               v-model="theme_navbar" value="orange">
                                                        <span class="colorinput-color bg-warning"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_navbar" type="radio"
                                                               v-model="theme_navbar" value="red">
                                                        <span class="colorinput-color bg-danger"></span>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="colorinput">
                                                        <input class="colorinput-input" name="theme_navbar" type="radio"
                                                               v-model="theme_navbar" value="dark">
                                                        <span class="colorinput-color bg-dark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-4">
                                <button class="btn btn-block btn-primary font-weight-bold btn-round" type="submit">
                                    Enregistrer les modifications
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
                name: null,
                theme: null,
                theme_logo: null,
                theme_sidebar: null,
                theme_navbar: null,
                logo: null
            }
        },

        methods: {
            handleFileUpload(){
                this.logo = this.$refs.file.files[0];
            },
            submit() {
                console.log(this.logo)
                let data = new FormData()
                data.append('name', this.name || '')
                data.append('theme', this.theme || '')
                data.append('theme_logo', this.theme_logo || '')
                data.append('theme_sidebar', this.theme_sidebar || '')
                data.append('theme_navbar', this.theme_navbar || '')
                data.append('logo', this.logo || '')

                this.$inertia.post(this.$route('config.system'), data, {
                    preserveState: true,
                    preserveScroll: true,
                    only: [],
                })
            }
        },
        props: ['config'],
        mounted() {
            $('#logo').dropify({
                messages: {
                    'default': 'Glisser et déposer une image ou cliquer',
                    'replace': 'Glisser et déposer ou cliquer pour remplacer',
                    'remove':  'Enlever',
                    'error':   'Ooops, Une erreur est survenue.'
                }
            })
            this.name = this.config.name
            this.theme = this.config.theme
            this.theme_logo = this.config.theme_logo
            this.theme_sidebar = this.config.theme_sidebar
            this.theme_navbar = this.config.theme_navbar
        }
    }
</script>
