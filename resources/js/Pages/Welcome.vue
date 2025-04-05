<script setup>
import { Head, Link } from "@inertiajs/vue3";

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
</script>

<template>
    <Head title="Mini Store" />
    <div class="bg-gray-50 min-h-screen dark:bg-gray-900">
        <!-- Header -->
        <header class="bg-white shadow dark:bg-gray-800">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center"
            >
                <!-- Logo -->
                <div class="flex items-center">
                    <svg
                        class="h-10 w-auto text-[#FF2D20]"
                        viewBox="0 0 62 65"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253Z"
                            fill="currentColor"
                        />
                    </svg>
                    <span
                        class="ml-3 text-xl font-semibold text-gray-900 dark:text-white"
                        >Mini Store</span
                    >
                </div>

                <!-- Navigation -->
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
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
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

        <!-- Featured Products Section -->
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
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

                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Category 1 -->
                    <a
                        href="#"
                        class="bg-gray-100 rounded-lg p-8 text-center dark:bg-gray-700 transition hover:shadow-lg hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    >
                        <h3
                            class="text-xl font-medium text-gray-900 dark:text-white"
                        >
                            Eletrônicos
                        </h3>
                    </a>

                    <!-- Category 2 -->
                    <a
                        href="#"
                        class="bg-gray-100 rounded-lg p-8 text-center dark:bg-gray-700 transition hover:shadow-lg hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    >
                        <h3
                            class="text-xl font-medium text-gray-900 dark:text-white"
                        >
                            Vestuário
                        </h3>
                    </a>

                    <!-- Category 3 -->
                    <a
                        href="#"
                        class="bg-gray-100 rounded-lg p-8 text-center dark:bg-gray-700 transition hover:shadow-lg hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    >
                        <h3
                            class="text-xl font-medium text-gray-900 dark:text-white"
                        >
                            Casa & Cozinha
                        </h3>
                    </a>

                    <!-- Category 4 -->
                    <a
                        href="#"
                        class="bg-gray-100 rounded-lg p-8 text-center dark:bg-gray-700 transition hover:shadow-lg hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                    >
                        <h3
                            class="text-xl font-medium text-gray-900 dark:text-white"
                        >
                            Livros
                        </h3>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
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
