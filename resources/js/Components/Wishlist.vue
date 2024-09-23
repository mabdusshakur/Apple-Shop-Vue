                    
<script setup>
import { ref, onMounted } from 'vue';
import { preloader_hide, preloader_show } from '../config';

const wishlists = ref([]);

async function WishList() {
    let res = await axios.get(`/api/wishlists`);
    wishlists.value = res.data[0];
}

async function RemoveWishList(id) {
    preloader_show();
    let res = await axios.delete("/api/wishlists/" + id);
    preloader_hide();
    if (res.status === 200) {
        await WishList();
    } else {
        alert("Request Fail")
    }
}
onMounted(async () => {
    await WishList();
    console.log(wishlists.value);
})
</script>
<template>
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Wish List</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item">
                            <Link href="/">Home</Link>
                        </li>
                        <li class="breadcrumb-item">
                            <Link href="#">This Page</Link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="container my-5">
            <div class="row" id="byList">

                <div class="col-lg-3 col-md-4 col-6" v-for="(item, index) in wishlists" :key="index">
                    <div class="product">
                        <div class="product_img">
                            <a href="#">
                                <img :src="item['product']['image']" alt="product_img9">
                            </a>
                            <div class="product_action_box">
                                <ul class="list_none pr_action_btn">
                                    <li>
                                        <Link :href="`/product-details?id=${item['product']['product_detail']['id']}`"
                                            class="popup-ajax">
                                        <i class="icon-magnifier-add"></i></Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title">
                                <Link :href="`/product-details?id=${item['product']['product_detail']['id']}`">
                                {{ item['product']['title'] }}
                                </Link>
                            </h6>
                            <div class="product_price">
                                <span class="price">$ {{ item['product']['price'] }}</span>
                            </div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" :style="{ width: `${item['product']['star']}%` }"></div>
                                </div>
                            </div>
                            <button class="btn remove btn-sm my-2 btn-danger"
                                v-on:click="RemoveWishList(item['product']['id'])">Remove</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped></style>