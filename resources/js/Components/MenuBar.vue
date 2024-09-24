<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3'
const categories = ref([]);

async function Category() {
    let res = await axios.get('/api/categories');
    categories.value = res.data[0];
}

function logout() {
    axios.post('/api/auth/logout')
        .then(res => {
            router.visit('/login')
            sessionStorage.removeItem('is_auth');
        })
}

function isLoggedIn() {
    return sessionStorage.getItem('is_auth');
}

console.log(isLoggedIn());

onMounted(async () => {
    await Category();
})
</script>
<template>
    <header class="header_wrap fixed-top header_with_topbar">
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                            <ul class="contact_detail text-lg-start text-center">
                                <li><i class="ti-mobile"></i><span>123-456-7890</span></li>
                                <li><i class="ti-email"></i><span>info@apple.com</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end text-center">
                            <ul class="header_list">
                                <li>
                                    <Link href="/policy?type=about">About</Link>
                                </li>

                                <li v-if="isLoggedIn()">
                                    <Link href="/profile"> <i class="linearicons-user"></i> Account</Link>
                                </li>
                                <li v-if="isLoggedIn()">
                                    <Link class="btn btn-danger btn-sm" @click="logout">
                                    Logout</Link>
                                </li>
                                <li v-else>
                                    <Link class="btn btn-danger btn-sm" href="/login">Login</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom_header dark_skin main_menu_uppercase">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <Link class="navbar-brand" href="/">
                    <img class="logo_dark" src="/public/user/assets/images/logo_dark.png" alt="logo" />
                    </Link>
                    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        type="button" aria-expanded="false">
                        <span class="ion-android-menu"></span>
                    </button>
                    <div class="navbar-collapse justify-content-end collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li>
                                <Link class="nav-link nav_item" href="/">Home</Link>
                            </li>
                            <li class="dropdown">
                                <Link class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#">Products
                                </Link>
                                <div class="dropdown-menu">
                                    <ul id="CategoryItem">
                                        <li v-for="category in categories" :key="category.id">
                                            <Link class="dropdown-item nav-link nav_item"
                                                :href="`/product-by-category?id=${category.id}`">{{ category.name }}
                                            </Link>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <Link class="nav-link nav_item" href="/wish-list"><i class="ti-heart"></i>
                                Wish</Link>
                            </li>
                            <li>
                                <Link class="nav-link nav_item" href="/cart-list"><i class="linearicons-cart"></i> Cart
                                </Link>
                            </li>
                            <li>
                                <Link class="nav-link search_trigger" href="javascript:void(0);"><i
                                    class="linearicons-magnifier"></i> Search</Link>
                                <div class="search_wrap">
                                    <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                                    <form>
                                        <input class="form-control" id="search_input" type="text" placeholder="Search">
                                        <button class="search_icon" type="submit"><i
                                                class="ion-ios-search-strong"></i></button>
                                    </form>
                                </div>
                                <div class="search_overlay"></div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<style scoped></style>