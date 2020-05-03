<template>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mt-5 rounded-pill">
                <div class="card-header bg-primary text-white font-weight-bold text-center rounded-pill">Authentification</div>

                <div class="card-body">
                        <img src="/img/logo2.svg" width="250" height="130" class="img-fluid d-block mx-auto" alt="logo">
                    <form @submit.prevent="submit" class="mt-4">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail :</label>

                            <div class="col-md-6">
                                <input placeholder="Entrer votre adresse E-mail" id="email" type="email" v-model="email" :class="{'is-invalid': this.$page.errors.email}" class="form-control" name="email" required autocomplete="email" autofocus>
                                <span class="text-danger invalid-feedback small text-justify" v-if="!!this.$page.errors.email" role="alert">
                                    <strong>
                                        {{ this.$page.errors.email.join(',') }}
                                    </strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe : </label>

                            <div class="col-md-6">
                                <input placeholder="Entrer votre mot de passe" id="password" v-model="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-4">
                                <button class="btn btn-block btn-primary font-weight-bold btn-round" type="submit">Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                email: null,
                password: null
            }
        },

        methods: {
            submit() {
                this.$inertia.post(this.$route('login'), {
                    email: this.email,
                    password: this.password
                })
            }
        }
    }
</script>
