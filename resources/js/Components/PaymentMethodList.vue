<script setup>
import { defineProps, defineEmits } from 'vue';

defineProps({
    items: {
        type: Array,
        required: true
    },
    showModal: {
        type: Boolean,
        required: true,
        default: false
    }
});

const emit = defineEmits('closeModal');

function closeModal() {
    emit('closeModal');
}
</script>

<template>
    <div v-if="showModal" class="modal fade show" id="paymentMethodModal" style="display: block;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pay Now</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        @click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody id="paymentList">
                            <tr v-for="(item, index) in items" :key="index">
                                <td><img class="w-50" :src="item['logo']" alt="product"></td>
                                <td>
                                    <p>{{ item.name }}</p>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" :href="item['redirectGatewayURL']">Pay</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>