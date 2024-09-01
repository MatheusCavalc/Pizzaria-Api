<script setup>
import ButtonSecondary from './ButtonSecondary.vue';
import ButtonPrimary from './ButtonPrimary.vue';
import CloseIcon from './Icons/CloseIcon.vue';
import CheckIcon from './Icons/CheckIcon.vue';
import Modal from './Modal.vue';
import { router } from '@inertiajs/vue3'
import { ref } from 'vue';

const props = defineProps(['half'])

const showModal = ref(false)

const toastNotification = ref(false)
const message = ref('')

const firstPart = ref('')
const secondPart = ref('')

const addToCartPart = () => {
    if (firstPart.value && secondPart.value) {
        message.value = 'Adicionado ao Carrinho';
        toastNotification.value = true
        setTimeout(() => toastNotification.value = false, 2500)

        router.get(route('combineToCart', {
            product_id_1: firstPart.value.id,
            product_id_2: secondPart.value.id
        }), {}, {
            preserveScroll: true,
            preserveState: true
        })

        showModal.value = false
        firstPart.value = secondPart.value = ''
    } else {
        message.value = 'Escolha os dois Sabores';
        toastNotification.value = true
        setTimeout(() => toastNotification.value = false, 2500)
    }
}
</script>

<template>
    <a class="py-8" id="meia"></a>
    <section class="pb-12 lg:pb-20">
        <div class="pt-20 pb-8 lg:pt-0 lg:py-14">
            <p class="text-2xl font-bold text-center text-black lg:text-4xl">Monte sua Pizza</p>
        </div>

        <div class="flex justify-center">
            <div class="grid grid-cols-2 gap-4 mx-6 lg:grid-cols-5 lg:mx-0">
                <div v-for="option in half" :key="option.id" class="p-1 border border-red-700 rounded">
                    <div>
                        <img v-if="option.image" :src="`storage/${option.image}`" class="object-cover w-full rounded h-28" alt="">
                        <img v-else :src="option.link_image" class="object-cover w-full rounded h-28" alt="">
                    </div>
                    <p class="mt-1 font-bold text-center">{{ option.name }}</p>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-10 lg:mt-4 lg:mx-28 lg:justify-end">
            <button @click="showModal = true" class="px-5 py-2.5 bg-red-700 rounded-lg text-white">
                Montar
            </button>
        </div>

        <!--Modal-->
        <Modal :show="showModal" @close="showModal = false">
            <div class="w-full pt-8 pb-10 bg-white rounded-md lg:pr-8 lg:pl-9">
                <!--Close Button-->
                <div class="flex justify-end">
                    <button class="mr-5 lg:mr-5" @click="showModal = false">
                        <CloseIcon />
                    </button>
                </div>

                <!--Modal Title-->
                <div class="mx-4 mt-3 lg:mx-10">
                    <div class="text-center">
                        <p class="text-lg text-red-700 lg:text-xl">Escolha os sabores</p>
                    </div>
                </div>

                <!--First Part List-->
                <div class="mx-4 mt-3 lg:mx-4">
                    <h3 class="mb-2 font-medium text-gray-900 lg:text-lg">Escolha o primeiro
                        sabor: {{ firstPart.name }}</h3>

                    <ul class="flex w-full gap-3 pb-2 overflow-x-auto">
                        <li v-for="option in half" :key="option.id" class="max-h-100 fl">
                            <input type="radio" :id="option.name" :value="option" v-model="firstPart"
                                class="hidden peer" required>

                            <label :for="option.name"
                                class="inline-flex items-center justify-between p-1 text-black bg-white border-2 border-gray-200 rounded-lg cursor-pointer min-w-40 peer-checked:border-red-600 hover:text-gray-700 peer-checked:text-black">

                                <div class="relative block w-40">
                                    <div>
                                        <img v-if="option.image" :src="`storage/${option.image}`" class="object-cover w-full h-28" alt="">
                                        <img v-else :src="option.link_image" class="object-cover w-full h-28" alt="">
                                    </div>
                                    <div class="absolute bottom-0 left-0 w-full backdrop-blur-sm bg-white/30">
                                        <div class="flex justify-center w-full">
                                            <p class="text-lg font-semibold">
                                                {{ option.name }}
                                            </p>
                                        </div>

                                        <div class="flex justify-center w-full">
                                            <p class="text-sm">
                                                R$ {{ option.price.replace('.', ',') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </label>
                        </li>

                    </ul>
                </div>

                <!--Second Part List-->
                <div class="mx-4 mt-3 lg:mx-4">
                    <h3 class="mb-2 font-medium text-gray-900 lg:text-lg">Escolha o segundo
                        sabor:
                        {{
                            secondPart.name }}</h3>
                    <ul class="flex w-full gap-3 pb-2 overflow-x-auto">

                        <li v-for="option in half" :key="option.id" class="max-h-100 fl">
                            <input type="radio" :id="option.id" :value="option" v-model="secondPart" class="hidden peer"
                                required>

                            <label :for="option.id"
                                class="inline-flex items-center justify-between p-1 text-black bg-white border-2 border-gray-200 rounded-lg cursor-pointer min-w-40 peer-checked:border-red-600 hover:text-gray-700 peer-checked:text-black">

                                <div class="relative block w-40">
                                    <div>
                                        <img v-if="option.image" :src="`storage/${option.image}`" class="object-cover w-full h-28" alt="">
                                        <img v-else :src="option.link_image" class="object-cover w-full h-28" alt="">
                                    </div>
                                    <div class="absolute bottom-0 left-0 w-full backdrop-blur-sm bg-white/30">
                                        <div class="flex justify-center w-full">
                                            <p class="text-lg font-semibold">
                                                {{ option.name }}
                                            </p>
                                        </div>

                                        <div class="flex justify-center w-full">
                                            <p class="text-sm">
                                                R$ {{ option.price.replace('.', ',') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </label>
                        </li>

                    </ul>
                </div>

                <!--Buttons-->
                <div class="flex flex-row-reverse mt-10 mr-5">
                    <ButtonPrimary @click="addToCartPart()">
                        Adicionar
                    </ButtonPrimary>

                    <ButtonSecondary @click="showModal = false">
                        Fechar
                    </ButtonSecondary>
                </div>
            </div>
        </Modal>

        <!--Toast Message-->
        <Transition>
            <div v-show="toastNotification" class="fixed z-50 bottom-4 right-4">
                <div
                    class="flex items-center w-full max-w-xs p-4 space-x-3 text-red-700 bg-white divide-x divide-black rounded-lg shadow-xl space-x">
                    <CheckIcon />
                    <div class="pl-4 text-sm font-bold text-red-700">
                        <p>{{ message }}</p>
                    </div>
                </div>
            </div>
        </Transition>
    </section>
</template>
