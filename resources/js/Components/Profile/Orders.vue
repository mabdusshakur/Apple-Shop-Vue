<script setup>
import { ref, onMounted } from 'vue';
const orderList = ref([]);
const productList = ref([]);
const showModal = ref(false);

async function OrderListRequest() {
    let res = await axios.get("/api/invoices");
    orderList.value = res.data[0]
}

async function InvoiceProductList(id) {

    $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
    let res = await axios.get("/api/invoices/" + id);

    productList.value = res.data[0][0]['invoice_products'];

    showModal.value = true;
    $(".preloader").delay(90).fadeOut(100).addClass('loaded');

}

onMounted(() => {
    OrderListRequest();
})
</script>

<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Payable</th>
                                <th>Shipping</th>
                                <th>Delivery</th>
                                <th>Payment</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody id="OrderList">
                            <tr v-for="(item, index) in orderList" :key="index">
                                <td>{{ item['id'] }}</td>
                                <td>${{ item['payable'] }} </td>
                                <td>{{ Object.entries(JSON.parse(item['ship_details'])).map(([key, value]) => `${key}:
                                    ${value}`).join('') }}</td>
                                <td>{{ item['delivery_status'] }}</td>
                                <td>{{ item['payment_status'] }}</td>
                                <td>
                                    <button class="btn more btn-danger btn-sm" v-on:click="InvoiceProductList(item.id)">
                                        More
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div v-if="showModal" class="modal show" id="InvoiceProductModal" aria-labelledby="exampleModalLabel"
        aria-hidden="true" tabindex="-1" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-6" id="exampleModalLabel">Products</h6>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"
                        v-on:click="showModal = false"></button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="productList">
                            <tr v-for="(item, index) in productList" :key="index">
                                <td>{{ item['product']['title'] }}</td>
                                <td>{{ item['quantity'] }}</td>
                                <td>${{ item['price'] }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</template>

<style scoped></style>