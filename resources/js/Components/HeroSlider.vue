<script setup>
import {ref, onMounted} from 'vue';

const heroSliders = ref([]);
    async function Hero() {
        let res = await axios.get('/api/product-sliders');
        heroSliders.value = res.data[0];
    }

    onMounted(async () => {
        await Hero();
        console.log(heroSliders.value);
    })
</script>

<template>
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
    <div class="carousel slide carousel-fade light_arrow" id="carouselExampleControls" data-bs-ride="carousel">
        <div class="carousel-inner" id="carouselSection">

            <div v-for="(item, index) in heroSliders" :key="index" :class="['carousel-item', 'background_bg', { active: index === 0 }]" :style="{backgroundImage: `url(${item.image})`}">
                <div class="banner_slide_content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-9">
                                <div class="banner_content overflow-hidden">
                                    <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="0.5s">{{ item.price }}</h5>
                                    <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="1s">{{ item.title }}</h2>
                                    <Link class="btn btn-fill-out rounded-0 staggered-animation text-uppercase" :href="`/product-details?id=${item.product_id}`" data-animation="slideInLeft" data-animation-delay="1.5s">Shop Now</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <Link class="carousel-control-prev" data-bs-slide="prev" href="#carouselExampleControls" role="button"><i class="ion-chevron-left"></i></Link>
        <Link class="carousel-control-next" data-bs-slide="next" href="#carouselExampleControls" role="button"><i class="ion-chevron-right"></i></Link>
    </div>
</div>
</template>

<style scoped></style>