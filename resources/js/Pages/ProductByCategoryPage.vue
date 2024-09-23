<script setup>
import { onMounted } from 'vue';

import MenuBar from '../Components/MenuBar.vue';
import Footer from '../Components/Footer.vue';
import TopBrands from '../Components/TopBrands.vue';
import ByCategoryList from '../Components/ByCategoryList.vue';

import { preloader_hide, preloader_show } from '../config';

onMounted(() => {
    setTimeout(() => {
        preloader_hide();
    }, 500);
});

</script>

<template>
    <MenuBar />
    <ByCategoryList />
    <TopBrands />
    <Footer />
</template>

<style scoped></style>