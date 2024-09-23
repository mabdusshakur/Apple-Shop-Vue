<script setup>
import { router } from '@inertiajs/vue3'
import { preloader_hide, preloader_show } from '../config';

async function verify() {
    let code = document.getElementById('code').value;
    let email = sessionStorage.getItem('email');

    if (code.length === 0) {
        alert("Code Required!");
    } else {
        preloader_show();

        axios.post("/api/auth/verify-otp", {
            email: email,
            otp: code
        }).then(res => {
            if (res.data.success === true) {
                setLoggedIn();
                if (sessionStorage.getItem("last_location")) {
                    router.visit(sessionStorage.getItem("last_location"))
                } else {
                    router.visit('/')
                }
            } else {
                preloader_hide();
                alert("Something Went Wrong");
            }
        }).catch(e => {
            preloader_hide();
            alert(e.response.data.message);
        })
    }
}
</script>

<template>
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3>Verification</h3>
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" id="code" name="email" type="text" required=""
                                    placeholder="Verification Code">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-fill-out btn-block" name="login" type="submit"
                                    v-on:click="verify">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
