<script setup>
import { ref, onMounted } from 'vue';

const brands = ref([]);

async function TopBrands() {
    let res = await axios.get("/api/brands");
    brands.value = res.data[0];
}

onMounted(() => {
    TopBrands();
})
</script>

<template>
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s4 text-center">
                        <h2>Top Brands</h2>
                    </div>
                    <p class="leads text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                        blandit massa enim Nullam nunc varius.</p>
                </div>
            </div>
            <div class="row align-items-center" id="TopBrandItem">
                <div class="p-2 col-2" v-for="brand in brands" :key="brand.id">
                    <div class="item">
                        <div class="categories_box">
                            <Link :href="`/product-by-brand?id=${brand.id}`">
                            <img :src="brand.image" alt="brand-image" />
                            <span>{{ brand.name }}</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>