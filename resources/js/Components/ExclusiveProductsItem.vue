<script setup>
import { defineProps } from 'vue';

defineProps({
    items: {
        type: Array,
        required: true
    }
});

</script>
<template>
    <div class="col-lg-3 col-md-4 col-6" v-for="(item, index) in items" :key="index">
        <div class="product">
            <div class="product_img">
                <a href="#">
                    <img :src="item.image" alt="product_img9" />
                </a>
                <div class="product_action_box">
                    <ul class="list_none pr_action_btn">
                        <li>
                            <a :href="`/details?id=${item.id}`" class="popup-ajax"><i
                                    class="icon-magnifier-add"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="product_info">
                <h6 class="product_title">
                    <a :href="`/details?id=${item.id}`">{{ item.title }}</a>
                </h6>
                <div class="product_price">
                    <span class="price">${{ item.price }}</span>
                </div>
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" :style="{ width: `${item.star}%` }"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
