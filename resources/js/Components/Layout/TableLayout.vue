<script setup>
import LinkButton from '../Forms/LinkButton.vue';

defineProps({
    tableTitle: { type: String, default: ''},
    tableHeads: { type: [Object, Array], default : {} },
    buttonLink: { type: String, default: ''},
});
</script>

<template>
    <section class="flex py-1 bg-blueGray-50">
        <div class="w-full mt-8">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded border">
                <div class="rounded-t mb-0 px-4 py-3 border-0 bg-slate-200">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="text-lg">{{ tableTitle }} <LinkButton v-if="buttonLink" class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-1 mt-3 mr-3 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline mt-0 float-right" :href="buttonLink" :variant="'info'">Add to {{tableTitle}}</LinkButton></h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center bg-transparent w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-6 bg-slate-100 align-middle py-3 text-base text-center" v-for="th in tableHeads">{{ th }}</th>
                            </tr>
                        </thead>

                        <slot />

                    </table>
                </div>
            </div>
        </div>
    </section>
</template>
