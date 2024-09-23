<script setup>
import { ref, onMounted } from 'vue';
import ExclusiveProductsItem from './ExclusiveProductsItem.vue';

const popularItems = ref([]);
const newItems = ref([]);
const topItems = ref([]);
const specialItems = ref([]);
const trendingItems = ref([]);

async function Popular() {
    let res = await axios.get('/api/products/?remark=popular');
    popularItems.value = res.data[0];
}


async function New() {
    let res = await axios.get('/api/products/?remark=new');
    newItems.value = res.data[0];
}


async function Top() {
    let res = await axios.get('/api/products/?remark=top');
    topItems.value = res.data[0];
}



async function Special() {
    let res = await axios.get('/api/products/?remark=special');
    specialItems.value = res.data[0];
}


async function Trending() {
    let res = await axios.get('/api/products/?remark=trending');
    trendingItems.value = res.data[0];
}

onMounted(async () => {
    await Popular();
    await New();
    await Top();
    await Special();
    await Trending();
})

</script>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="heading_s1 text-center">
                    <h2>Exclusive Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-style1">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">
                        <li class="nav-item">
                            <Link class="nav-link active" id="arrival-tab" data-bs-toggle="tab" href="#Popular"
                                role="tab" aria-controls="arrival" aria-selected="true">Popular</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" id="sellers-tab" data-bs-toggle="tab" href="#New" role="tab"
                                aria-controls="sellers" aria-selected="false">New</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" id="featured-tab" data-bs-toggle="tab" href="#Top" role="tab"
                                aria-controls="featured" aria-selected="false">Top</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" id="special-tab" data-bs-toggle="tab" href="#Special" role="tab"
                                aria-controls="special" aria-selected="false">Special</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" id="special-tab" data-bs-toggle="tab" href="#Trending" role="tab"
                                aria-controls="special" aria-selected="false">Trending</Link>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Popular" role="tabpanel" aria-labelledby="arrival-tab">
                        <div class="row shop_container" id="PopularItem">
                            <ExclusiveProductsItem :items="popularItems" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="New" role="tabpanel" aria-labelledby="sellers-tab">
                        <div class="row shop_container" id="NewItem">
                            <ExclusiveProductsItem :items="newItems" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Top" role="tabpanel" aria-labelledby="featured-tab">
                        <div class="row shop_container" id="TopItem">
                            <ExclusiveProductsItem :items="topItems" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Special" role="tabpanel" aria-labelledby="special-tab">
                        <div class="row shop_container" id="SpecialItem">
                            <ExclusiveProductsItem :items="specialItems" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Trending" role="tabpanel" aria-labelledby="special-tab">
                        <div class="row shop_container" id="TrendingItem">
                            <ExclusiveProductsItem :items="trendingItems" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>