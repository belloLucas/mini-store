<script setup>
import { ref, computed } from "vue";
import { useCartStore } from "@/stores/cartStore";
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline";
import cep from "cep-promise";

const cartStore = useCartStore();

// Estados para os inputs
const cepInput = ref("");
const street = ref("");
const city = ref("");
const state = ref("");
const cardNumber = ref("");
const cardExpiry = ref("");
const cardCVC = ref("");
const email = ref("");
const password = ref("");
const cardHolder = ref("");

const formatCardNumber = (value) => {
    return value
        .replace(/\D/g, "")
        .slice(0, 16)
        .replace(/(\d{4})(?=\d)/g, "$1 ")
        .trim();
};

const formatCardExpiry = (value) => {
    return value
        .replace(/\D/g, "")
        .replace(/^(\d{2})(\d{1,2})/, "$1/$2")
        .slice(0, 5);
};

const formatCardCVC = (value) => {
    return value.replace(/\D/g, "").slice(0, 3);
};

const formatCep = (value) => {
    return value
        .replace(/\D/g, "")
        .slice(0, 8)
        .replace(/(\d{5})(\d)/, "$1-$2");
};

const updateQuantity = (productId, action) => {
    const product = cartStore.cart.find((item) => item.id === productId);
    if (product) {
        if (action === "increase") {
            product.quantity++;
        } else if (action === "decrease" && product.quantity > 1) {
            product.quantity--;
        }
    }
};

const searchCep = async () => {
    try {
        const result = await cep(cepInput.value);

        street.value = result.street;
        city.value = result.city;
        state.value = result.state;
    } catch (error) {
        console.error("Erro ao buscar o CEP:", error);
        alert("Erro ao buscar o CEP. Verifique o número e tente novamente.");
    }
};

const isFormValid = computed(() => {
    return (
        email.value.trim() !== "" &&
        password.value.trim() !== "" &&
        cepInput.value.trim() !== "" &&
        street.value.trim() !== "" &&
        city.value.trim() !== "" &&
        state.value.trim() !== "" &&
        cardNumber.value.trim() !== "" &&
        cardHolder.value.trim() !== "" &&
        cardExpiry.value.trim() !== "" &&
        cardCVC.value.trim() !== "" &&
        cartStore.cart.length > 0
    );
});

const submitOrder = () => {
    const orderData = {
        contactInfo: {
            email: email.value,
            password: password.value,
        },
        deliveryInfo: {
            cep: cepInput.value,
            street: street.value,
            city: city.value,
            state: state.value,
        },
        paymentInfo: {
            cardNumber: cardNumber.value,
            cardHolder: cardHolder.value,
            cardExpiry: cardExpiry.value,
            cardCVC: cardCVC.value,
        },
        orderInfo: {
            items: cartStore.cart.map((item) => ({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: item.quantity,
                subtotal: item.price * item.quantity,
            })),
            totalItems: cartStore.totalItems,
            totalPrice: cartStore.totalPrice,
        },
    };
    console.log("Dados do pedido:", orderData);
};
</script>

<template>
    <div class="bg-gray-100 min-h-screen">
        <div
            class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 lg:grid-cols-3 gap-8"
        >
            <!-- Left Section -->
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">
                    Finalização do Pedido
                </h1>

                <!-- Contact Information -->
                <div class="mb-6">
                    <label
                        class="block text-lg font-semibold text-gray-900 mb-2"
                    >
                        Informações de Contato
                    </label>
                    <form class="space-y-4">
                        <input
                            type="email"
                            v-model="email"
                            placeholder="Email"
                            class="w-3/4 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                        />
                        <input
                            type="password"
                            v-model="password"
                            placeholder="Senha"
                            class="w-3/4 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                        />
                    </form>
                </div>

                <!-- Delivery Information -->
                <div class="mb-6">
                    <label
                        class="block text-lg font-semibold text-gray-900 mb-2"
                    >
                        Informações de Entrega
                    </label>
                    <form class="space-y-4">
                        <div class="flex space-x-2 w-3/4">
                            <input
                                type="text"
                                v-model="cepInput"
                                @input="cepInput = formatCep(cepInput)"
                                placeholder="CEP"
                                required
                                class="flex-1 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                            />
                            <button
                                type="button"
                                @click="searchCep"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 flex items-center justify-center"
                            >
                                <MagnifyingGlassIcon class="h-5 w-5" />
                            </button>
                        </div>
                        <input
                            type="text"
                            v-model="street"
                            placeholder="Rua"
                            required
                            class="w-3/4 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                        />
                        <input
                            type="text"
                            v-model="city"
                            placeholder="Cidade"
                            required
                            class="w-3/4 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                        />
                        <input
                            type="text"
                            v-model="state"
                            placeholder="Estado"
                            required
                            class="w-3/4 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                        />
                    </form>
                </div>

                <!-- Payment Information -->
                <div>
                    <label
                        class="block text-lg font-semibold text-gray-900 mb-2"
                    >
                        Informações de Pagamento
                    </label>
                    <form class="space-y-4">
                        <input
                            type="text"
                            v-model="cardNumber"
                            @input="cardNumber = formatCardNumber(cardNumber)"
                            placeholder="Número do Cartão"
                            required
                            class="w-3/4 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                        />

                        <input
                            type="text"
                            v-model="cardHolder"
                            placeholder="Titular do Cartão"
                            class="w-3/4 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                        />

                        <div class="flex space-x-4 w-3/4">
                            <input
                                type="text"
                                v-model="cardExpiry"
                                @input="
                                    cardExpiry = formatCardExpiry(cardExpiry)
                                "
                                placeholder="Vencimento (MM/YY)"
                                required
                                class="flex-1 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                            />

                            <input
                                type="text"
                                v-model="cardCVC"
                                @input="cardCVC = formatCardCVC(cardCVC)"
                                placeholder="Código de Segurança"
                                required
                                class="flex-1 px-4 py-2 border rounded-md bg-gray-50 text-gray-900"
                            />
                        </div>

                        <button
                            type="button"
                            :disabled="!isFormValid"
                            @click="submitOrder"
                            :class="[
                                'w-3/4 px-4 py-2 rounded-md',
                                isFormValid
                                    ? 'bg-green-500 text-white hover:bg-green-600'
                                    : 'bg-gray-300 text-gray-500 cursor-not-allowed',
                            ]"
                        >
                            Fechar Pedido
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Section -->
            <div
                class="bg-white p-6 rounded-lg shadow-md flex flex-col w-full h-auto"
            >
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    Seu Carrinho
                </h2>
                <div v-if="cartStore.cart.length > 0" class="space-y-6 w-full">
                    <div
                        v-for="item in cartStore.cart"
                        :key="item.id"
                        class="border-b pb-4 mb-4"
                    >
                        <!-- Informações do Produto -->
                        <div class="flex items-start mb-3">
                            <img
                                :src="item.image_url"
                                alt="Product Image"
                                class="w-16 h-16 object-cover rounded-md mr-4"
                            />

                            <div class="flex-1">
                                <h3
                                    class="text-lg font-semibold text-gray-900 mb-1"
                                >
                                    {{ item.name }}
                                </h3>
                                <p class="text-gray-500">
                                    R$
                                    {{
                                        (item.price * item.quantity).toFixed(2)
                                    }}
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-start items-center mt-2">
                            <div class="flex items-center space-x-2">
                                <button
                                    @click="updateQuantity(item.id, 'decrease')"
                                    class="w-10 h-10 flex items-center justify-center bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                                >
                                    -
                                </button>
                                <input
                                    type="text"
                                    :value="item.quantity"
                                    readonly
                                    class="w-10 h-10 text-center border rounded-md bg-gray-50 text-gray-900 appearance-none"
                                />
                                <button
                                    @click="updateQuantity(item.id, 'increase')"
                                    class="w-10 h-10 flex items-center justify-center bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                                >
                                    +
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div
                            class="flex justify-between items-center mt-4 pt-4"
                        >
                            <span class="text-xl font-bold text-gray-900"
                                >Total:</span
                            >
                            <span class="text-xl font-bold text-gray-900"
                                >R$ {{ cartStore.totalPrice.toFixed(2) }}</span
                            >
                        </div>
                    </div>
                </div>
                <p v-else class="text-gray-500">Seu carrinho está vazio.</p>
            </div>
        </div>
    </div>
</template>
