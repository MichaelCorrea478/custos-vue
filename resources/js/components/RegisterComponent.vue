<template>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrar novo usuário</p>

            <div class="alert alert-warning" v-show="message">
                <p>{{message}}</p>
                <div v-for="(v, k) in errors" :key="k" class="alert-alert-warning">
                    <p v-for="error in v" :key="error" class="text-sm text-danger">
                        {{ k }} : {{ error }}
                    </p>
                </div>
            </div>

            <form method="post" @submit.prevent="register($event)">

                <div class="input-group mb-3">
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Full name"
                           v-model="formData.name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                </div>

                <div class="input-group mb-3">
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Email"
                           v-model="formData.email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Password"
                           v-model="formData.password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Retype password"
                           v-model="formData.password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" v-model="formData.terms">
                            <label for="agreeTerms">
                                Eu concordo com os <a href="#">termos</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="#" class="text-center">Já sou registrado</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</template>

<script>
import axios from 'axios';

export default {
    props: ['csrf_token'],

    data() {
        return {
            formData: {
                _token: this.csrf_token,
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: ''
            },
            errors: null,
            message: null
        }
    },
    methods: {
        register(event) {
            let url = '/register';
            axios.post(url, this.formData)
                .then(response => {
                    this.login({
                        'email': this.formData.email,
                        'password': this.formData.password
                    });
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    this.message = error.response.data.message;
                });
        },
        login(loginData) {
            let url = 'http://127.0.0.1:8000/api/auth/login';
            axios.post(url, loginData)
                .then(response => {
                    if (response.data.access_token) {
                        document.cookie = 'token=' + response.data.access_token + ';SameSite=Lax';
                    }
                });
        }
    }

}
</script>
