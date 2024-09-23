<script setup>
import { onMounted } from 'vue';

import MenuBar from '../../Components/MenuBar.vue';
import Footer from '../../Components/Footer.vue';
import Login from '../../Components/Login.vue';

import { preloader_hide, preloader_show } from '../../config';

onMounted(() => {
    setTimeout(() => {
        preloader_hide();
    }, 500);
});

</script>

<template>
    <MenuBar />
    <Login />
    <Footer />
</template>

<style scoped></style>