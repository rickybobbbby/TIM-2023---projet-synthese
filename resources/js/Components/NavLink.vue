<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-principal-main text-sm font-medium leading-5 text-noir-100 focus:outline-none focus:border-noir-100 transition'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-noir-100 hover:text-principal-wash hover:border-noir-100 focus:outline-none focus:text-bg-noir-100 focus:border-noir-100 transition';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
