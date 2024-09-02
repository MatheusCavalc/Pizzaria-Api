<script setup>
import ButtonPrimary from '@/Components/ButtonPrimary.vue';
import ButtonSecondary from '@/Components/ButtonSecondary.vue';
import CloseIcon from '@/Components/Icons/CloseIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import CartIcon from '@/Components/Icons/CartIcon.vue';
import Modal from '@/Components/Modal.vue';
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
import EditIcon from '@/Components/Icons/EditIcon.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import MenuIcon from '@/Components/Icons/MenuIcon.vue';

const props = defineProps(['cart', 'total_items', 'total_value', 'infos'])

const modalFormProduct = ref(false)
const modalFormBuy = ref(false)

const address = ref('')
const payment = ref('')
const change = ref('')

let menu = ref(false)

const showMenu = () => {
    menu.value = !menu.value
}

const removeFromCart = (product_name) => {
    router.get(route('removeFromCart', product_name), {}, {
        preserveScroll: true,
        preserveState: true
    })
}

const openFormBuy = () => {
    modalFormProduct.value = false
    modalFormBuy.value = true
}

const backToCart = () => {
    modalFormBuy.value = false
    modalFormProduct.value = true
}

const continueBuy = () => {
    const number = props.infos.whatsapp_number;
    const addressText = "Endereço: " + address.value;
    const paymentText = "Pagamento: " + payment.value;
    const changeText = 'Troco para: ' + change.value

    let pedido = "Pedidos:\n";

    Object.values(props.cart).forEach((item, index) => {
        pedido += `${index + 1}. ${item.name}`;
        if (item.observations) {
            pedido += ` (${item.observations})`;
        }
        pedido += '\n';
    });

    pedido += `\n${addressText}\n${paymentText}`;

    if (payment.value === "Dinheiro") {
        pedido += `\n${changeText}`;
    }

    const url = `https://api.whatsapp.com/send?phone=${number}&text=${encodeURIComponent(pedido)}`;

    if (address.value && payment.value) {
        window.open(url, "_blank");
        modalFormProduct.value = false;
        address.value = payment.value = '';
    }

}
</script>

<template>
    <nav class="fixed top-0 left-0 z-30 w-full p-3 text-white bg-black border-b border-gray-600">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
            <a href="https://sushifortal.com.br/" class="flex items-center">
                <img src="https://www.sabornamesa.com.br/images/receitas/pins_image/r2269-pizza-toscana-pin.jpg"
                    class="h-10 mr-3 rounded-full" alt="Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Mikaela</span>
            </a>

            <div class="flex gap-1 md:order-2">
                <button type="button" @click="modalFormProduct = true"
                    class="relative px-2 py-2 mr-1 text-sm font-medium text-center text-white rounded-lg md:mr-0">
                    <CartIcon />

                    <div class="absolute right-0 bottom-1">
                        <p>
                            {{ total_items }}
                        </p>
                    </div>
                </button>

                <button @click="menu = !menu" :class="{ 'opened': menu }"
                    class="inline-flex items-center justify-center w-10 h-10 p-1 text-sm rounded-lg stroke-white lg:hidden">
                    <MenuIcon />
                </button>
            </div>

            <div :class="{ 'lg:block': menu, 'hidden lg:block': !menu }"
                class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium text-white bg-black border border-gray-100 rounded-lg md:p-0 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-black">
                    <li>
                        <a href="#Destaques"
                            class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Destaques</a>
                    </li>
                    <li>
                        <a href="#meia"
                            class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Monte
                            a Sua</a>
                    </li>
                    <li>
                        <a href="#Cardapio"
                            class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">Cardápio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <Modal :show="modalFormProduct" @close="modalFormProduct = false">
        <div class="w-full pt-6 pb-8 bg-white rounded-md lg:px-6">
            <div class="flex justify-end">
                <button class="mr-5 lg:mr-5" @click="modalFormProduct = false">
                    <CloseIcon />
                </button>
            </div>

            <div class="mt-6">
                <p class="text-2xl font-bold tracking-tight text-center text-red-700">Meu Carrinho</p>
            </div>

            <div v-if="total_items > 0">
                <div class="mt-4 overflow-y-auto lg:mx-2 max-h-80 lg:max-h-64">
                    <div v-for="(product, index) in cart" :key="product.id" class="px-4 py-3 mb-3 border-b">
                        <div class="flex justify-between">
                            <p>{{ product.name }}</p>
                            <button title="Observações" @click="product.showInput = !product.showInput">
                                <EditIcon />
                            </button>
                        </div>

                        <div class="my-3" v-show="product.showInput">
                            <label for="observations"
                                class="block mb-2 text-sm font-medium text-gray-900">Observações do pedido</label>

                            <div class="flex gap-2">
                                <input type="text" id="observations" placeholder="Ex: Sem cebola e etc"
                                    @keyup.enter="product.showInput = false" v-model="product.observations"
                                    class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                                    required>

                                <button @click="product.showInput = false"
                                    class="block p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                                    <CheckIcon />
                                </button>
                            </div>
                        </div>

                        <div v-if="product.observations && !product.showInput">
                            <p class="font-bold">Observações</p>
                            <p class="text-gray-700">{{ product.observations }}</p>
                        </div>

                        <div class="flex justify-end gap-2 mt-5">
                            <p>R${{ product.price.replace('.', ',') }}</p>
                            <button class="text-red-700" @click="removeFromCart(product.name)">
                                <TrashIcon />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mx-5 mt-3">
                    <p>Total: R${{ total_value.replace('.', ',') }}</p>
                </div>
            </div>

            <div v-else class="my-10">
                <p class="text-lg text-center">Seu carrinho está vazio</p>
            </div>

            <div class="flex flex-row-reverse mt-10 mr-4">
                <ButtonPrimary @click="openFormBuy" v-if="total_items > 0">
                    Continuar
                </ButtonPrimary>

                <ButtonSecondary @click="modalFormProduct = false">
                    Fechar
                </ButtonSecondary>
            </div>
        </div>
    </Modal>

    <Modal :show="modalFormBuy && total_items > 0 && !modalFormProduct" @close="modalFormBuy = false">
        <div class="w-full pt-8 pb-10 bg-white rounded-md lg:pr-8 lg:pl-9">
            <div class="flex justify-end">
                <button class="mr-5 lg:mr-5" @click="modalFormBuy = false">
                    <CloseIcon />
                </button>
            </div>

            <div class="mt-6">
                <p class="text-2xl font-bold tracking-tight text-center text-red-700">Preencha o
                    formulário para
                    finalizar a compra</p>
            </div>

            <div class="mx-4 mt-4">
                <div class="mb-6">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Seu
                        Endereço</label>
                    <input type="text" id="address" placeholder="Rua, 999, Bairro" v-model="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        required>
                </div>
                <div class="mb-6">
                    <label for="payment" class="block mb-2 text-sm font-medium text-gray-900">Metodo
                        de Pagamento</label>
                    <select id="payment" v-model="payment" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option selected disabled>Escolha um metodo de Pagamento</option>
                        <option value="Dinheiro">Dinheiro</option>
                        <option value="Pix">Pix</option>
                        <option value="Cartao de Crédito">Cartao de Crédito</option>
                        <option value="Cartao de Debito">Cartao de Debito</option>
                    </select>
                </div>
                <Transition>
                    <div v-show="payment == 'Dinheiro'" class="mb-6 transition-all duration-100">
                        <label for="change" class="block mb-2 text-sm font-medium text-gray-900">Troco Para</label>
                        <input type="text" id="address" placeholder="Troco" v-model="change"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                </Transition>
            </div>

            <div class="flex flex-row-reverse mt-10 mr-4">
                <ButtonPrimary @click="continueBuy">
                    Continuar
                </ButtonPrimary>

                <ButtonSecondary @click="backToCart">
                    Voltar
                </ButtonSecondary>
            </div>
        </div>
    </Modal>

    <div>
        <slot />
    </div>

    <footer class="text-white bg-black">
        <div class="w-full max-w-screen-xl p-4 py-6 mx-auto lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="https://sushifortal.com.br/" class="flex items-center">
                        <img src="https://www.sabornamesa.com.br/images/receitas/pins_image/r2269-pizza-toscana-pin.jpg"
                            class="h-12 mr-3 rounded-full" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap">Mikaela</span>
                    </a>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center ">© 2023 <a href="/"
                        class="hover:underline">Mikaela™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-3 sm:justify-center sm:mt-0">
                    <a href="/admin">Admin</a>
                </div>
            </div>
        </div>
    </footer>
</template>
