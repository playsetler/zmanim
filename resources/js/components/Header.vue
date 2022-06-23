<template>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-md">
            <a class="navbar-brand" href="#"><img src="../../img/brand.png" class="img-fluid">Zmanim</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/layouts">Layouts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/media">Media</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item"
                                    href="/logout"
                                    @click.prevent="logout"><i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </a>

                                <form id="logout-form" class="d-none">
                                </form>
                            </li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    name: "Header",
    methods: {
        logout() {
            this.axios
                .post('/logout')
                .then(response => {
                    localStorage.removeItem('token');
                    this.$router.push({ name: 'login', params: { referer: this.$route.name } });
                })
        }
    }
}
</script>
