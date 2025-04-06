<script setup>
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { useCartStore } from "@/stores/cartStore";

const cartStore = useCartStore();
</script>

<template>
    <div
        class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50 flex justify-end cart-overlay"
        @click="cartStore.toggleCartModal"
    >
        <div class="bg-white w-80 h-full shadow-lg" @click.stop>
            <div class="flex justify-between items-center border-b p-4">
                <h2 class="text-lg font-semibold">Carrinho de Compras</h2>
                <button
                    @click="cartStore.toggleCartModal"
                    class="text-gray-500 hover:text-gray-700"
                >
                    <XMarkIcon class="h-6 w-6" />
                </button>
            </div>

            <div class="p-4 flex flex-col h-full">
                <div class="flex-grow">
                    <div v-if="cartStore.cart.length > 0">
                        <ul>
                            <li
                                v-for="item in cartStore.cart"
                                :key="item.id"
                                class="flex justify-between items-center border-b py-2"
                            >
                                <span
                                    >{{ item.name }} (x{{
                                        item.quantity
                                    }})</span
                                >
                                <span
                                    >R$
                                    {{
                                        (item.price * item.quantity).toFixed(2)
                                    }}</span
                                >
                                <button
                                    @click="cartStore.removeFromCart(item.id)"
                                    class="text-red-500 hover:text-red-700"
                                >
                                    Remover
                                </button>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <p class="font-semibold">
                                Quantidade de Items: {{ cartStore.totalItems }}
                            </p>
                            <p class="font-semibold">
                                Valor total: R$
                                {{ cartStore.totalPrice.toFixed(2) }}
                            </p>
                        </div>
                    </div>
                    <p v-else>Seu carrinho está vazio.</p>
                </div>

                <div class="mt-4">
                    <button
                        @click="cartStore.toggleCartModal"
                        class="w-full bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
                    >
                        Fechar
                    </button>
                    <button
                        v-if="cartStore.cart.length > 0"
                        class="w-full mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    >
                        Finalizar Compra
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
