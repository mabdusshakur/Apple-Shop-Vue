<script setup>
import { onMounted } from 'vue';

import MenuBar from '../../Components/MenuBar.vue';
import Footer from '../../Components/Footer.vue';
import Verify from '../../Components/Verify.vue';

import { preloader_hide, preloader_show } from '../../config';

onMounted(() => {
    setTimeout(() => {
        preloader_hide();
    }, 500);
});

</script>

<template>
    <MenuBar />
    <Verify />
    <Footer />
</template>

<style scoped></style>