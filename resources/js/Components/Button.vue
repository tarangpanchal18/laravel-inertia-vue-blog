<script setup>
var btnClass = '';
const props = defineProps({
  type: { type: String, default: "button" },
  title: { type: String, default: "" },
  processing: { type: Boolean, default: false },
});

</script>

<template>
    <button
    :type="type"
    :title="title"
    :disabled="processing"
  >
    <slot />
  </button>
</template>
