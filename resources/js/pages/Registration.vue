<template>
<div class="container">
    <div class="row g-0">
        <div class="col-12 col-md-7 background-left">

        </div>
        <div class="col-12 col-md-5 form align-self-center">
            <form>
                <div class="app-name">Zmanim</div>
                <h1>Create an account</h1>
                <div class="row mb-3">
                    <label for="name" class="form-label">Name*</label>

                    <div class="col-md">
                        <input id="name" type="text" class="form-control" name="name" v-model="name" required autocomplete="name" autofocus>

                        <!-- <span class="invalid-feedback" role="alert">
                            <strong>error1</strong>
                        </span> -->
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="form-label">Email Address*</label>

                    <div class="col-md">
                        <input id="email" type="email" class="form-control" name="email" v-model="email" required autocomplete="email">

                        <!-- <span class="invalid-feedback" role="alert">
                            <strong>error2</strong>
                        </span> -->
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="form-label">Password*</label>

                    <div class="col-md">
                        <input id="password" type="password" class="form-control" name="password" v-model="password" required autocomplete="new-password">

                        <!-- <span class="invalid-feedback" role="alert">
                            <strong>error3</strong>
                        </span> -->
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-form-label">Confirm Password*</label>

                    <div class="col-md">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="passwordConfirm" required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" id="terms">
                    <label class="form-check-label" for="terms">I accept the <a href="/terms">Terms and Conditions</a></label>
                </div>

                <div class="mb-5">
                    <button type="submit" class="btn btn-primary" @click.prevent="registration">Register</button>
                </div>
                
                <p>
                    Already have an account? <a href="/login" @click.prevent="$router.push('/login')">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>
</template>

<script>

export default {
    name: "Registration",
    data() {
        return {
            name: "",
            email: "",
            password: "",
            passwordConfirm:""
        }
    },

    methods: {
        registration() {
            axios.get('/sanctum/csrf-cookie').then(() => {
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirm
                }).then((response) => {
                    this.$router.push('/login');
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