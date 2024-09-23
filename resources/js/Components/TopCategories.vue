<script setup>
import { ref, onMounted } from 'vue';

const categories = ref([]);

async function TopCategory() {
    let res = await axios.get('/api/categories');
    categories.value = res.data[0];
}

onMounted(() => {
    TopCategory();
})
</script>
<template>
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s4 text-center">
                        <h2>Top Categories</h2>
                    </div>
                    <p class="leads text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                        blandit massa enim Nullam nunc varius.</p>
                </div>
            </div>
            <div class="row align-items-center" id="TopCategoryItem">
                <div class="p-2 col-2" v-for="category in categories" :key="category.id">
                    <div class="item">
                        <div class="categories_box">
                            <Link :href="`/product-by-category?id=${category.id}`">
                            <img :src="category.image" alt="category-image" />
                            <span>{{ category.name }}</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>