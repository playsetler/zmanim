<template>
<div class="container">
    <div class="row g-0">
        <div class="col-12 col-md-7 background-left">

        </div>
        <div class="col-12 col-md-5 form align-self-center">
            <form>
                <div class="app-name">Zmanim</div>
                <h1>Login</h1>
                <div class="row mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="col-md">
                        <input id="email" type="email" class="form-control" name="email" v-model="email" required autocomplete="email" autofocus>

                        <!-- <span class="invalid-feedback" role="alert">
                            <strong>error1</strong>
                        </span> -->
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="form-label">Password</label>

                    <div class="col-md">
                        <input id="password" type="password" class="form-control" name="password" v-model="password" required autocomplete="current-password">

                        <!-- <span class="invalid-feedback" role="alert">
                            <strong>error2</strong>
                        </span> -->
                    </div>
                </div>
                <div class="mb-5">
                    <button type="submit" class="btn btn-primary" @click.prevent="login">Login</button>
                    <a href="#">Forgot Your Password?</a>
                </div>
                
                <p>
                    Don't have an account? <a href="/register" @click.prevent="$router.push('/register')">Register now</a>
                </p>
            </form>
        </div>
    </div>
</div>
</template>

<script>

export default {
    name: "Login",
    data() {
        return {
            email: "",
            password: ""
        }
    },

    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(() => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    localStorage.setItem('token', response.config.headers['X-XSRF-TOKEN']);
                    this.$router.push({ name: this.$route.params.referer || 'Layouts' });
                })
                .catch(error => {
                    if(error.response.status == 422 || error.response.status == 403) {
                        this.msg = "Неверный Email или пароль";
                        console.log(this.msg)
                    };
                    return error;
                });
            });
        },
    }
}
</script>

<style>
.container, .row {
    height: 100%;
}

body {
    background-color: var(--accent-color-regular);
}

.form form {
    background-color: var(--white);
    padding: 40px 50px 30px 50px;
    box-shadow: 0 8px 20px rgb(0 0 0 / 20%);
}

.background-left {
    background: url("../../img/back.png") no-repeat center center;
    background-size: contain;
}

.app-name {
    font-size: 42px;
    text-align: center;
    color: var(--accent-color-regular);
    font-weight: bold;
}

.form form h1 {
    font-size: 1.75rem;
    text-align: center;
}
</style>