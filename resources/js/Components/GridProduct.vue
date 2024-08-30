<script setup>
import { router } from '@inertiajs/vue3'
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import CloseIcon from './Icons/CloseIcon.vue';
import CheckIcon from './Icons/CheckIcon.vue';
import ButtonPrimary from './ButtonPrimary.vue';
import ButtonSecondary from './ButtonSecondary.vue';
import ExclamationIcon from './Icons/ExclamationIcon.vue';
import CartIcon from './Icons/CartIcon.vue';

const props = defineProps(['location', 'title', 'array'])

const addProduct = ref(false)

const products = props.array.map(product => ({
    ...product,
    showDescription: ref(false)
}))

const addToCart = (product) => {
    product.showDescription = false;

    addProduct.value = true
    setTimeout(() => addProduct.value = false, 2500)

    router.get(route('addToCart', product.id), {}, {
        preserveScroll: true
    })
}

</script>

<template>
    <a class="py-8" :id="location"></a>
    <section class="pb-14 lg:pb-24">
        <div class="my-4 ml-6 text-left">
            <h2 class="text-xl font-bold text-black lg:text-3xl">
                {{ title }}</h2>
        </div>

        <div class="flex justify-center mx-3">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-2 lg:gap-x-4 gap-y-5">

                <!--Product-->
                <div v-for="product in array" :key="product.id"
                    class="relative flex flex-row items-center bg-white border border-gray-200 rounded-lg shadow">

                    <!--Name, description, price and add button-->
                    <div class="flex flex-col justify-between p-4 leading-normal w-7/12">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 lg:text-2xl">{{ product.name }}
                        </h5>
                        <p @click="product.showDescription = true" class="text-gray-600 text-sm line-clamp-1">{{
                            product.description }}</p>
                        <p class="mb-3 font-normal text-right text-red-700 lg:text-lg">R${{ product.price.replace('.',
                            ',') }}</p>
                        <div>
                            <button @click="addToCart(product)"
                                class="flex gap-2 items-center justify-center w-full rounded-md bg-red-700 px-5 py-2.5 text-center text-sm lg:font-medium text-white hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300">
                                <CartIcon />
                                Adicionar ao carrinho
                            </button>
                        </div>
                    </div>

                    <!--Product Image-->
                    <div class="relative w-5/12">
                        <img @click="product.showDescription = true"
                            class="object-cover w-full rounded-none rounded-r-lg h-52 lg:h-64" :src="product.link_image"
                            :alt="product.name">
                        <span :title="product.description" @click="product.showDescription = true"
                            class="absolute top-0 right-0 m-2 text-sm font-medium text-center text-white rounded-full">
                            <ExclamationIcon />
                        </span>
                    </div>

                    <!-- Modal Description -->
                    <Modal :show="product.showDescription" @close="product.showDescription = false">
                        <div class="w-full pt-8 pb-10 bg-white rounded-md lg:pr-8 lg:pl-9">
                            <div class="flex justify-end">
                                <button @click="product.showDescription = false">
                                    <CloseIcon />
                                </button>
                            </div>

                            <div class="mx-4 mt-3 lg:mx-10">
                                <div class="text-center">
                                    <p class="text-lg text-red-700 lg:text-xl">{{ product.name }}</p>
                                </div>

                                <div class="mt-4">
                                    <img class="object-cover w-full rounded-lg h-72" :src="product.link_image"
                                        :alt="product.name" />
                                </div>

                                <div class="mt-5">
                                    <p class="text-black">{{ product.description }}</p>
                                </div>
                            </div>

                            <div class="flex flex-row-reverse mt-10 mr-5">
                                <ButtonPrimary @click="addToCart(product)">
                                    Adicionar
                                </ButtonPrimary>

                                <ButtonSecondary @click="product.showDescription = false">
                                    Fechar
                                </ButtonSecondary>
                            </div>
                        </div>
                    </Modal>
                </div>
            </div>
        </div>

        <!-- Toast Message -->
        <Transition>
            <div v-show="addProduct" class="fixed z-50 bottom-4 right-4">
                <div
                    class="flex items-center w-full max-w-xs p-4 space-x-3 text-red-700 bg-white divide-x divide-black rounded-lg shadow-xl space-x">
                    <CheckIcon />
                    <div class="pl-4 text-sm font-bold text-red-700">
                        <p>Adicionado ao Carrinho!</p>
                    </div>
                </div>
            </div>
        </Transition>
    </section>
</template>
