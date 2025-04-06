<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { ShoppingCartIcon } from "@heroicons/vue/24/outline";
import Cart from "@/Components/Cart.vue";
import { useCartStore } from "@/stores/cartStore";

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    products: {
        type: Array,
        required: true,
    },
});

const plainProducts = JSON.parse(JSON.stringify(props.products));

const selectedCategory = ref(null);

const filteredProducts = computed(() => {
    if (!selectedCategory.value) return [];
    return plainProducts.filter(
        (product) => product.category_id === selectedCategory.value
    );
});

const categories = computed(() => {
    const uniqueCategories = [];
    plainProducts.forEach((product) => {
        if (
            !uniqueCategories.some(
                (category) => category.id === product.category_id
            )
        ) {
            uniqueCategories.push({
                id: product.category_id,
                name: product.category_name,
            });
        }
    });
    return uniqueCategories;
});

const selectCategory = (categoryId) => {
    selectedCategory.value = categoryId;
};

const cartStore = useCartStore();
</script>

<template>
    <Head title="Mini Store" />
    <div class="bg-gray-50 min-h-screen dark:bg-gray-900">
        <div
            v-if="cartStore.notification"
            class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg transition-opacity duration-300"
        >
            {{ cartStore.notification }}
        </div>
        <header class="bg-white shadow dark:bg-gray-800">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center"
            >
                <div class="flex items-center">
                    <svg
                        viewBox="0 0 50 52"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-auto"
                    >
                        <path
                            d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-21.483L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z"
                            fill="#FF2D20"
                            fill-rule="evenodd"
                        />
                    </svg>
                    <span
                        class="ml-3 text-xl font-semibold text-gray-900 dark:text-white"
                        >Mini Store</span
                    >
                </div>

                <nav v-if="canLogin" class="flex items-center space-x-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="px-4 py-2 text-sm font-medium text-white bg-[#FF2D20] rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        >
                            Registrar
                        </Link>
                    </template>
                    <ShoppingCartIcon
                        class="h-6 w-6 text-gray-700 dark:text-white cursor-pointer"
                        @click="cartStore.toggleCartModal"
                    />
                </nav>
            </div>
        </header>

        <Cart
            v-if="cartStore.isCartModalOpen"
            :total-items="cartStore.totalItems"
            :total-price="cartStore.totalPrice"
            @close="cartStore.toggleCartModal(item.id)"
            @remove-item="cartStore.removeFromCart"
        ></Cart>

        <div class="relative py-16 bg-white overflow-hidden dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                        <div class="mt-12 lg:mt-0">
                            <h1
                                class="text-4xl font-extrabold text-gray-900 sm:text-5xl dark:text-white"
                            >
                                Descubra produtos incríveis na Mini Store
                            </h1>
                            <p
                                class="mt-6 text-xl text-gray-500 dark:text-gray-300"
                            >
                                Navegue por uma ampla variedade de produtos e
                                encontre o que você ama. Oferecemos qualidade e
                                preços acessíveis para todos os gostos.
                            </p>
                            <div class="mt-8 flex space-x-4">
                                <a
                                    href="#featured"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#FF2D20] hover:bg-red-600"
                                >
                                    Compre agora
                                </a>
                                <a
                                    href="#categories"
                                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                >
                                    Navegue por Categorias
                                </a>
                            </div>
                        </div>
                        <div class="mt-12 lg:mt-0 flex justify-center">
                            <img
                                class="h-auto w-full max-w-md"
                                src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                alt="Shopping illustration"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="featured" class="bg-gray-50 py-16 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2
                        class="text-3xl font-extrabold text-gray-900 dark:text-white"
                    >
                        Produtos em Destaque
                    </h2>
                    <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
                        Explore nossa seleção de produtos mais populares
                    </p>
                </div>

                <div
                    v-if="plainProducts && plainProducts.length > 0"
                    class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3"
                >
                    <div
                        v-for="product in plainProducts.slice(0, 3)"
                        :key="product.id"
                        class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 transition hover:shadow-lg"
                    >
                        <img
                            :src="product.image_url"
                            alt="Product Image"
                            class="h-48 w-full object-cover rounded-md mb-4"
                        />
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            {{ product.name }}
                        </h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-300">
                            {{ product.description }}
                        </p>
                        <p
                            class="mt-4 text-lg font-bold text-gray-900 dark:text-white"
                        >
                            R$ {{ product.price.toFixed(2) }}
                        </p>
                        <button
                            @click="cartStore.addToCart(product)"
                            class="mt-4 w-full bg-[#FF2D20] text-white px-4 py-2 rounded-md hover:bg-red-600"
                        >
                            Adicionar ao Carrinho
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="categories" class="bg-white py-16 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2
                        class="text-3xl font-extrabold text-gray-900 dark:text-white"
                    >
                        Navegue por Categorias
                    </h2>
                    <p class="mt-4 text-lg text-gray-500 dark:text-gray-300">
                        Encontre o que procura em nossas categorias
                    </p>
                </div>

                <!-- Botões de categorias -->
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <button
                        v-for="category in categories"
                        :key="category.id"
                        @click="selectCategory(category.id)"
                        :class="{
                            'bg-gray-200 dark:bg-gray-600 text-gray-900 dark:text-white':
                                selectedCategory === category.id,
                            'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white':
                                selectedCategory !== category.id,
                        }"
                        class="rounded-lg p-8 text-center transition hover:shadow-lg hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    >
                        <h3 class="text-xl font-medium">
                            {{ category.name }}
                        </h3>
                    </button>
                </div>

                <!-- Produtos da categoria selecionada -->
                <div v-if="selectedCategory" class="mt-12">
                    <div
                        v-if="filteredProducts.length > 0"
                        class="mt-8 grid gap-8 md:grid-cols-2 lg:grid-cols-3"
                    >
                        <div
                            v-for="product in filteredProducts"
                            :key="product.id"
                            class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-700 transition hover:shadow-lg"
                        >
                            <img
                                :src="product.image_url"
                                alt="Product Image"
                                class="h-48 w-full object-cover rounded-md mb-4"
                            />
                            <h3
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                {{ product.name }}
                            </h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-300">
                                {{ product.description }}
                            </p>
                            <p
                                class="mt-4 text-lg font-bold text-gray-900 dark:text-white"
                            >
                                R$ {{ product.price.toFixed(2) }}
                            </p>
                            <button
                                @click="cartStore.addToCart(product)"
                                class="mt-4 w-full bg-[#FF2D20] text-white px-4 py-2 rounded-md hover:bg-red-600"
                            >
                                Adicionar ao Carrinho
                            </button>
                        </div>
                    </div>
                    <p
                        v-else
                        class="mt-8 text-center text-gray-500 dark:text-gray-300"
                    >
                        Nenhum produto encontrado nesta categoria.
                    </p>
                </div>
            </div>
        </div>

        <footer class="bg-gray-800 text-white py-12 border-t border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Mini Store</h3>
                        <p class="text-gray-300">
                            Mini Store é sua loja online de confiança para
                            produtos incríveis. Navegue por uma ampla variedade
                            de categorias e encontre o que você ama. Nossa
                            missão é oferecer qualidade e preços acessíveis para
                            todos os gostos.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">
                            Acesso Rápido
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-300 hover:text-white"
                                    >Sobre</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-300 hover:text-white"
                                    >Contato</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-300 hover:text-white"
                                    >Perguntas Frequentes</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-300 hover:text-white"
                                    >Política de Privacidade</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contato</h3>
                        <p class="text-gray-300">Email: info@ministore.com</p>
                        <p class="text-gray-300">Telefone: (11) 1111-1111</p>
                    </div>
                </div>
                <div
                    class="mt-8 pt-8 border-t border-gray-700 text-center text-sm text-gray-400"
                >
                    <p>
                        Mini Store © {{ new Date().getFullYear() }}. Todos os
                        direitos reservados.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
