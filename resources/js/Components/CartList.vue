<script setup>
import { ref, onMounted } from 'vue';
import PaymentMethodList from './PaymentMethodList.vue';

const cartItems = ref([]);
const total = ref(0);
const paymentMethods = ref([]);
const showModal = ref(false);

async function CartList() {

    let res = await axios.get(`/api/carts`);
    cartItems.value = res.data[0];
    await CartTotal(cartItems.value);
}

const getPrice = (item) => {
    const item_price = item['product']['price'];
    const discount_price = item['product']['discount_price'];
    const is_discount = item['product']['is_discount'];
    return (is_discount ? discount_price : item_price) * item['quantity'];
}

async function CartTotal(data) {
    let Total = 0;
    data.forEach((item, i) => {
        const final_price = getPrice(item);
        Total = Total + parseFloat(final_price);
    })
    total.value = Total;
}

async function RemoveCartList(id) {
    $(".preloader").delay(90).fadeIn(100).removeClass('loaded');
    let res = await axios.delete("/api/carts/" + id);
    $(".preloader").delay(90).fadeOut(100).addClass('loaded');
    if (res.status === 200) {
        await CartList();
    } else {
        alert("Request Fail")
    }
}


async function CheckOut() {
    $(".preloader").delay(90).fadeIn(100).removeClass('loaded');

    let res = await axios.post("/api/invoices");

    $(".preloader").delay(90).fadeOut(100).addClass('loaded');

    if (res.status === 201) {
        showModal.value = true;
        paymentMethods.value = res.data[0]['payment_methods']
    } else {
        alert("Request Fail");
    }
}


onMounted(() => {
    CartList();
});

</script>


<template>

    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Cart List</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item">
                            <Link href="/">Home</Link>
                        </li>
                        <li class="breadcrumb-item">
                            <Link href="#">This Page</Link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="byList">
                                <tr v-for="(item, index) in cartItems" :key="index">
                                    <td class="product-thumbnail"><img :src="item['product']['image']" alt="product">
                                    </td>
                                    <td class="product-name">{{ item['product']['title'] }} </td>
                                    <td class="product-quantity"> {{ item['quantity'] }} </td>
                                    <td class="product-subtotal">$ {{ getPrice(item) }}</td>
                                    <td class="product-remove">
                                        <Link class="remove" v-on:click.prevent="RemoveCartList(item['product_id'])">
                                        <i class="ti-close"></i>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="px-0" colspan="6">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-lg-4 col-md-6 mb-md-0 mb-3">
                                                Total: $ <span id="total">{{ total }}</span>
                                            </div>
                                            <div class="col-lg-8 col-md-6 text-md-end text-start">
                                                <button class="btn btn-line-fill btn-sm" type="submit"
                                                    v-on:click.prevent="CheckOut">Check Out</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <PaymentMethodList :showModal="showModal" :items="paymentMethods" @closeModal="showModal = false" />

</template>


<style scoped></style>