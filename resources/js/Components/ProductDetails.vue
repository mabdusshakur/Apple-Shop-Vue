<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3'

const productDetails = ref([]);
const product_id = ref('');
const product_sizes = ref([]);
const product_colors = ref([]);
const quantity = ref(1);


const product_title = ref('');
const product_price = ref('');
const product_short_des = ref('');
const product_description = ref('');
const product_img1 = ref('');
const product_img2 = ref('');
const product_img3 = ref('');
const product_img4 = ref('');


const currentImage = ref('');

let searchParams = new URLSearchParams(window.location.search);
let id = searchParams.get('id');


async function getProductDetails() {
    let res = await axios.get("/api/product-details/" + id);
    productDetails.value = await res.data[0];

    product_title.value = productDetails.value['product']['title'];
    product_price.value = productDetails.value['product']['price'];
    product_short_des.value = productDetails.value['product']['short_des'];
    product_description.value = productDetails.value['description'];
    product_img1.value = productDetails.value['img1'];
    product_img2.value = productDetails.value['img2'];
    product_img3.value = productDetails.value['img3'];
    product_img4.value = productDetails.value['img4'];
    currentImage.value = productDetails.value['img1'];

    product_id.value = productDetails.value['product_id'];
    product_sizes.value = productDetails.value['size'].split(',');
    product_colors.value = productDetails.value['color'].split(',');

    // product_id = Details['product_id'];
    // // return console.log(Details);


    // document.getElementById('product_img1').src = Details['img1'];
    // document.getElementById('img1').src = Details['img1'];
    // document.getElementById('img2').src = Details['img2'];
    // document.getElementById('img3').src = Details['img3'];
    // document.getElementById('img4').src = Details['img4'];

    // document.getElementById('p_title').innerText = Details['product']['title'];
    // document.getElementById('p_price').innerText = `$ ${Details['product']['price']}`;
    // document.getElementById('p_des').innerText = Details['product']['short_des'];
    // document.getElementById('p_details').innerHTML = Details['description'];
}

function changeImage(imageSrc) {
    currentImage.value = imageSrc;
}


// async function productReview() {

//     let res = await axios.get("/api/reviews/?product_id=" + product_id).catch((e) => {
//         if (e.response.status === 401) {
//             $(".preloader").delay(90).fadeOut(100).addClass('loaded');
//             $("#reviewList").append("<li class='list-group-item'>Please Login to see the review</li>");
//         }
//     });

//     let Details = await res.data[0];

//     $("#reviewList").empty();

//     Details.forEach((item, i) => {
//         let each = `<li class="list-group-item">
//                 <h6>${item['customer_profile']['cus_name']}</h6>
//                 <p class="m-0 p-0">${item['description']}</p>
//                 <div class="rating_wrap">
//                     <div class="rating">
//                         <div class="product_rate" style="width:${parseFloat(item['rating'] * 100)}%"></div>
//                     </div>
//                 </div>
//             </li>`;
//         $("#reviewList").append(each);
//     })
// }

async function AddToCart() {
    let p_size = document.getElementById('p_size').value;
    let p_color = document.getElementById('p_color').value;
    let p_qty = document.getElementById('p_qty').value;

    if (p_size.length === 0) {
        alert("Product Size Required !");
    } else if (p_color.length === 0) {
        alert("Product Color Required !");
    } else if (p_qty === 0) {
        alert("Product Qty Required !");
    } else {
        $(".preloader").delay(90).fadeIn(100).removeClass('loaded');

        await axios.post("/api/carts", {
            "product_id": product_id.value,
            "color": p_color,
            "size": p_size,
            "quantity": p_qty
        }).then((res) => {
            $(".preloader").delay(90).fadeOut(100).addClass('loaded');
            if (res.data.success === true) {
                alert("Request Successful")
            }
        }).catch((e) => {
            if (e.response.status === 401) {
                sessionStorage.setItem("last_location", window.location.href)
                router.visit('/login')
            }
        });
    }
}


async function AddToWishList() {
    await axios.post("/api/wishlists", {
        "product_id": product_id.value,
    }).then((res) => {
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');
        if (res.data.success === true) {
            alert("Request Successful")
        }
    }).catch((e) => {
        if (e.response.status === 401) {
            sessionStorage.setItem("last_location", window.location.href)
            router.visit('/login')
        }
    });
}


// async function AddReview() {
//     let reviewText = document.getElementById('reviewTextID').value;
//     let reviewScore = document.getElementById('reviewScore').value;
//     if (reviewScore.length === 0) {
//         alert("Score Required !")
//     } else if (reviewText.length === 0) {
//         alert("Review Required !")
//     } else {
//         $(".preloader").delay(90).fadeIn(100).removeClass('loaded');

//         let res = await axios.post("/api/reviews", {
//             description: reviewText,
//             rating: reviewScore,
//             product_id: product_id
//         });

//         $(".preloader").delay(90).fadeOut(100).addClass('loaded');
//         await productReview();
//     }
// }

const increaseQuantity = () => {
    quantity.value++;
}

const decreaseQuantity = () => {
    if (quantity.value > 1) {
        quantity.value--;
    }
}

onMounted(async () => {
    await getProductDetails();
})
</script>


<template>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
                    <div class="product-image">
                        <div class="product_img_box">
                            <img class="w-100" id="product_img1" :src="currentImage" />
                        </div>
                        <div class="row p-2">
                            <a class="col-3 product_img_box p-1" href="#" @click.prevent="changeImage(product_img1)">
                                <img id="img1" :src="product_img1" />
                            </a>
                            <a class="col-3 product_img_box p-1" href="#" @click.prevent="changeImage(product_img2)">
                                <img id="img2" :src="product_img2" />
                            </a>
                            <a class="col-3 product_img_box p-1" href="#" @click.prevent="changeImage(product_img3)">
                                <img id="img3" :src="product_img3" />
                            </a>
                            <a class="col-3 product_img_box p-1" href="#" @click.prevent="changeImage(product_img4)">
                                <img id="img4" :src="product_img4" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title" id="p_title">{{ product_title }}</h4>
                            <h1 class="price" id="p_price">{{ product_price }}</h1>
                        </div>
                        <div>
                            <p id="p_des">{{ product_short_des }}</p>
                        </div>
                    </div>

                    <label class="form-label">Size</label>
                    <select class="form-select" id="p_size">
                        <option v-for="(item, index) in product_sizes" :key="index" :value='item'>{{ item }}</option>
                    </select>

                    <label class="form-label">Color</label>
                    <select class="form-select" id="p_color">
                        <option v-for="(item, index) in product_colors" :key="index" :value='item'>{{ item }}</option>
                    </select>

                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input class="minus" type="button" value="-" v-on:click="decreaseQuantity">
                                <input class="qty" id="p_qty" name="quantity" type="text" :value="quantity" title="Qty"
                                    size="4">
                                <input class="plus" type="button" value="+" v-on:click="increaseQuantity">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button class="btn btn-fill-out btn-addtocart" type="button" v-on:click="AddToCart"><i
                                    class="icon-basket-loaded"></i> Add to cart</button>
                            <a class="add_wishlist" href="#" v-on:click.prevent="AddToWishList"><i
                                    class="icon-heart"></i></a>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped></style>