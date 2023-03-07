<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-noir-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-bg-noir-100 active:bg-noir-100 focus:outline-none focus:border-noir-100 focus:ring focus:ring-noir-100 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
