import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({
        cart: [],
        isCartModalOpen: false,
        notification: null,
    }),
    getters: {
        totalItems: (state) => state.cart.length,
        totalPrice: (state) =>
            state.cart.reduce(
                (sum, item) => sum + item.price * item.quantity,
                0
            ),
    },
    actions: {
        addToCart(product) {
            const existingItem = this.cart.find(
                (item) => item.id === product.id
            );
            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.cart.push({ ...product, quantity: 1 });
            }
            this.showNotification(
                `${product.name} foi adicionado ao carrinho!`
            );
        },
        removeFromCart(productId) {
            this.cart = this.cart.filter((item) => item.id !== productId);
        },
        toggleCartModal() {
            this.isCartModalOpen = !this.isCartModalOpen;
        },
        showNotification(message) {
            this.notification = message;
            setTimeout(() => {
                this.notification = null;
            }, 3000);
        },
    },
    persist: {
        key: "cart",
        storage: localStorage,
    },
});
