<template>
    <!-- This is an example component -->
    <div class='mt-2 w-full items-center justify-center' v-if="quoteData.content">
        <div class="border px-6 w-full bg-white">
            <div class="mt-4 mb-6">
                <div class="mb-3 text-xl font-bold">{{ quoteData.content }}</div>
                <div v-if="quoteData.originator.name" class="text-sm text-neutral-600">- {{ quoteData.originator.name }}</div>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from 'axios';
import { reactive } from 'vue';

const quoteData = reactive({
    content: "",
    originator: {
        name: "",
    }
});

const options = {
  method: 'GET',
  url: 'https://quotes15.p.rapidapi.com/quotes/random/',
  headers: {
    'X-RapidAPI-Key': 'b80ee0016bmsh487cd4cb596f7f5p1d5942jsnad9a98a79850',
    'X-RapidAPI-Host': 'quotes15.p.rapidapi.com'
  }
};

axios.request(options).then(function (response) {
    quoteData.content = response.data.content;
    quoteData.originator.name = response.data.originator.name;
}).catch(function (error) {
	console.error(error);
});
</script>
