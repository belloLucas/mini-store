<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ProductList from "../Components/ProductList.vue";
import ProductForm from "../Components/ProductForm.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    products: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const activeTab = ref("dashboard");
const editMode = ref(false);
const currentProductId = ref(null);

const handleEditProduct = (product) => {
    editMode.value = true;
    currentProductId.value = product.id;
    activeTab.value = "products";
};

const handleCancelEdit = () => {
    editMode.value = false;
    currentProductId.value = null;
};

const handleFormSuccess = () => {
    editMode.value = false;
    currentProductId.value = null;
    activeTab.value = "dashboard";
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Lista de Produtos
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Tab Navigation -->
                <div class="mb-6 border-b border-gray-200">
                    <ul
                        class="flex flex-wrap -mb-px text-sm font-medium text-center"
                    >
                        <li class="mr-2">
                            <a
                                href="#"
                                @click.prevent="activeTab = 'dashboard'"
                                :class="[
                                    'inline-block p-4 rounded-t-lg',
                                    activeTab === 'dashboard'
                                        ? 'text-blue-600 border-b-2 border-blue-600'
                                        : 'hover:text-gray-600 hover:border-gray-300',
                                ]"
                            >
                                Lista de Produtos
                            </a>
                        </li>
                        <li class="mr-2">
                            <a
                                href="#"
                                @click.prevent="
                                    activeTab = 'products';
                                    editMode = false;
                                "
                                :class="[
                                    'inline-block p-4 rounded-t-lg',
                                    activeTab === 'products'
                                        ? 'text-blue-600 border-b-2 border-blue-600'
                                        : 'hover:text-gray-600 hover:border-gray-300',
                                ]"
                            >
                                {{
                                    editMode
                                        ? "Editar Produto"
                                        : "Cadastrar Produtos"
                                }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Products List -->
                <ProductList
                    v-if="activeTab === 'dashboard'"
                    :products="products"
                    @edit-product="handleEditProduct"
                />

                <!-- Create/Edit Product Form -->
                <ProductForm
                    v-else-if="activeTab === 'products'"
                    :categories="categories"
                    :edit-mode="editMode"
                    :product-id="currentProductId"
                    :initial-product="
                        editMode
                            ? products.find((p) => p.id === currentProductId)
                            : null
                    "
                    @cancel="handleCancelEdit"
                    @success="handleFormSuccess"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
