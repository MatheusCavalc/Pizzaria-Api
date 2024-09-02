<script setup>
import GridProduct from '@/Components/GridProduct.vue';
import FacebookIcon from '@/Components/Icons/FacebookIcon.vue';
import InstagramIcon from '@/Components/Icons/InstagramIcon.vue';
import WhatsappIcon from '@/Components/Icons/WhatsappIcon.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref, watch } from 'vue';
import { Head, router } from '@inertiajs/vue3'
import MakeYours from '@/Components/MakeYours.vue';

const props = defineProps(['infos', 'categories', 'promotion', 'half', 'cart', 'total_items', 'total_value'])

const open = ref(false)

const selectedMenu = ref('')

const changeSelectedMenu = (menu) => {
    open.value = false
    selectedMenu.value = menu
}

onMounted(() => {
    changeSelectedMenu(props.categories[0].name);
})

const addProduct = ref(false)

const addToCart = (product) => {
    addProduct.value = true
    setTimeout(() => addProduct.value = false, 2500)

    router.get(route('addToCart', product.id), {}, {
        preserveScroll: true,
        preserveState: true
    })
}
</script>

<template>

    <Head title="Mikaela Pizzaria" />

    <AppLayout :cart="cart" :total_items="total_items" :total_value="total_value" :infos="infos">
        <!--Home Section-->
        <section class="py-40 bg-home">
            <div class="flex justify-center">
                <div class="">
                    <img class="object-cover w-48 h-48 border border-white rounded-full"
                        src="https://www.sabornamesa.com.br/images/receitas/pins_image/r2269-pizza-toscana-pin.jpg"
                        alt="">
                </div>
            </div>

            <div class="mt-3 space-y-2">
                <p class="text-4xl font-bold text-center text-white font-title">Mikaela Pizzaria</p>

                <div class="flex justify-center">
                    <p v-if="infos.store_open"
                        class="order-1 px-4 py-1 mt-auto text-white border border-red-500 rounded-lg lg:order-2 w-fit animate-pulse">
                        <p class="mt-auto text-center lg:text-left">Aberto</p>
                    </p>

                    <p v-else
                        class="order-1 px-4 py-1 mt-auto text-white border border-red-500 rounded-lg lg:order-2 w-fit">
                        <p class="mt-auto text-center lg:text-left">Fechado</p>
                    </p>
                </div>

                <p class="text-center text-white">{{ infos.address }}</p>
            </div>

            <div class="flex justify-center mt-4">
                <div class="flex justify-center gap-2">
                    <a :href="'https://api.whatsapp.com/send?phone=' + infos.whatsapp_number" target="_blank"
                        class="transition ease-in-out fill-white hover:scale-125 delay-50 hover:-translate-y-1">
                        <WhatsappIcon />
                    </a>

                    <div v-for="social in infos.social_links">
                        <a :href="social.link" target="_blank" class="">
                            <InstagramIcon
                                class="w-10 h-10 transition ease-in-out fill-white hover:scale-125 delay-50 hover:-translate-y-1"
                                v-if="social.social == 'Instagram'" />
                            <FacebookIcon
                                class="w-10 h-10 transition ease-in-out fill-white hover:scale-125 delay-50 hover:-translate-y-1"
                                v-if="social.social == 'Facebook'" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-base text-center text-white lg:text-lg">
                <p class="font-bold">Funcionamento</p>
                <p>{{ infos.open_days }}</p>
                <p>{{ infos.opening_hours }}</p>
            </div>
        </section>

        <!--Menu Section-->
        <div class="sticky top-[65px] w-full bg-white border-b z-20 lg:px-10 lg:py-4">
            <div class="relative z-30 w-full lg:w-1/2">
                <div class="hidden lg:block">
                    <div class="flex justify-between px-5 cursor-pointer hover:font-medium" @click="open = !open">
                        <p class="text-lg">{{ selectedMenu }}</p>

                        <button class="transition duration-300 ease-in-out"
                            :class="{ 'rotate-180': open, 'rotate-0': !open }">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </div>

                    <Transition>
                        <div v-show="open"
                            class="absolute flex flex-row px-5 overflow-y-auto bg-white rounded-lg shadow-xl top-8 w-72 lg:w-full max-h-52 lg:flex-col">
                            <a :href="'#' + menu.location" v-for="menu in categories">
                                <p @click="changeSelectedMenu(menu.name)" class="w-full py-2 text-lg border-b">{{
                                    menu.name
                                    }}
                                </p>
                            </a>
                        </div>
                    </Transition>
                </div>

                <div class="flex px-4 py-4 overflow-x-auto hide-scrollbar gap-7 lg:hidden">
                    <a :href="'#' + menu.location" class="flex-shrink-0" v-for="menu in categories">
                        <p @click="changeSelectedMenu(menu.name)"
                            :class="{ 'border-b-2 border-red-600': selectedMenu == menu.name }">
                            {{ menu.name }}
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <!--Most Requested-->
        <a id="Destaques" />
        <section class="pb-12 lg:pb-20">

            <div class="pt-20 pb-8 lg:pt-12 lg:py-14">
                <p class="text-2xl font-bold text-center text-black lg:text-4xl">Destaques</p>
            </div>

            <div v-for="product in promotion" :key="product.id" class="mb-10">
                <div class="gap-8 mx-4 lg:grid lg:grid-cols-2 lg:mx-20">

                    <div class="">
                        <img v-if="product.image" class="object-cover w-full h-48 rounded-lg lg:h-full" :src="`storage/${product.image}`" alt="">
                        <img v-else class="object-cover w-full h-48 rounded-lg lg:h-full" :src="product.link_image" alt="">
                    </div>

                    <div class="mx-4 mt-5 lg:mt-20">
                        <p class="text-3xl text-center">{{ product.name }}</p>

                        <p class="mt-4 text-left text-gray-500">{{ product.description }}
                        </p>

                        <div class="flex justify-end mt-4">
                            <p class="text-xl font-bold text-red-700 lg:text-3xl">R${{ product.price.replace('.', ',')
                                }}
                            </p>
                        </div>

                        <div class="mt-4">
                            <button @click="addToCart(product)" class="px-5 py-2.5 bg-red-700 rounded-lg text-white">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Transition>
            <div v-show="addProduct" class="fixed bottom-4 right-4">
                <div
                    class="flex items-center w-full max-w-xs p-4 space-x-3 text-red-700 bg-white divide-x divide-black rounded-lg shadow-xl space-x">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <div class="pl-4 text-sm font-bold text-red-700">
                        <p>Adicionado ao Carrinho!</p>
                    </div>
                </div>
            </div>
        </Transition>

        <!--Make Yours-->
        <MakeYours :half="half" />

        <!--Menu List-->
        <section class="text-red-600 bg-white pb-28 lg:pb-20">
            <a class="py-8" id="Cardapio"></a>
            <div class="pt-20 pb-8 lg:pt-0 lg:py-14">
                <p class="text-2xl font-bold text-center text-black lg:text-4xl">Nosso Cardápio</p>
            </div>

            <div v-for="category in categories">
                <GridProduct :location="category.location" :title="category.name"
                    :array="category.products" />
            </div>
        </section>
    </AppLayout>
</template>
