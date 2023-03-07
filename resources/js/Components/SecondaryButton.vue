<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-noir-800 border border-noir-100 rounded-md font-semibold text-xs text-bg-noir-100 uppercase tracking-widest shadow-sm hover:text-noir-100 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-noir-100 active:bg-principal-main disabled:opacity-25 transition">
        <slot />
    </button>
</template>
