<script setup>
import { onMounted } from 'vue';

import MenuBar from '../Components/MenuBar.vue';
import Footer from '../Components/Footer.vue';
import TopBrands from '../Components/TopBrands.vue';
import TopCategories from '../Components/TopCategories.vue';
import ExclusiveProducts from '../Components/ExclusiveProducts.vue';
import HeroSlider from '../Components/HeroSlider.vue';
import {preloader_hide, preloader_show} from '../config';

onMounted(() => {
    setTimeout(() => {
       preloader_hide();
    }, 500);
});

</script>

<template>
    <MenuBar />
    <HeroSlider />
    <TopCategories />
    <ExclusiveProducts />
    <TopBrands />
    <Footer />
</template>

<style scoped></style>