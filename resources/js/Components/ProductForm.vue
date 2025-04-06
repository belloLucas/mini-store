<script setup>
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    editMode: {
        type: Boolean,
        default: false,
    },
    productId: {
        type: Number,
        default: null,
    },
    initialProduct: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(["cancel", "success"]);

const form = useForm({
    name: "",
    product_category_id: "",
    description: "",
    price: "",
    image_url: "",
});

onMounted(() => {
    if (props.initialProduct) {
        form.name = props.initialProduct.name;
        form.product_category_id = props.initialProduct.product_category_id;
        form.description = props.initialProduct.description || "";
        form.price = props.initialProduct.price;
        form.image_url = props.initialProduct.image_url || "";
    }
});

const submitForm = () => {
    if (props.editMode) {
        form.put(route("products.update", props.productId), {
            onSuccess: () => {
                form.reset();
                emit("success");
            },
        });
    } else {
        form.post(route("products.store"), {
            onSuccess: () => {
                form.reset();
                emit("success");
            },
        });
    }
};

const cancelEdit = () => {
    form.reset();
    emit("cancel");
};
</script>

<template>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold mb-4">
                {{ editMode ? "Editar Produto" : "Cadastrar Novo Produto" }}
            </h3>

            <form @submit.prevent="submitForm" class="space-y-4">
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Nome do Produto</label
                    >
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required
                    />
                    <div
                        v-if="form.errors.name"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>

                <div>
                    <label
                        for="category"
                        class="block text-sm font-medium text-gray-700"
                        >Categoria</label
                    >
                    <select
                        id="category"
                        v-model="form.product_category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required
                    >
                        <option value="" disabled>
                            Selecione uma categoria
                        </option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.product_category_id"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.product_category_id }}
                    </div>
                </div>

                <div>
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                        >Descrição</label
                    >
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    ></textarea>
                    <div
                        v-if="form.errors.description"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.description }}
                    </div>
                </div>

                <div>
                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700"
                        >Preço</label
                    >
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div
                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                        >
                            <span class="text-gray-500">R$</span>
                        </div>
                        <input
                            id="price"
                            v-model="form.price"
                            type="number"
                            min="0"
                            step="0.01"
                            class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required
                        />
                    </div>
                    <div
                        v-if="form.errors.price"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.price }}
                    </div>
                </div>

                <div>
                    <label
                        for="imageUrl"
                        class="block text-sm font-medium text-gray-700"
                        >URL da Imagem</label
                    >
                    <input
                        id="imageUrl"
                        v-model="form.image_url"
                        type="url"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    />
                    <div
                        v-if="form.errors.image_url"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.image_url }}
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button
                        v-if="editMode"
                        type="button"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        @click="cancelEdit"
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        :disabled="form.processing"
                    >
                        {{
                            form.processing
                                ? "Salvando..."
                                : editMode
                                ? "Atualizar Produto"
                                : "Salvar Produto"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
