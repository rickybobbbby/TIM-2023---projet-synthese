<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" type="submit" class="block w-full px-4 py-2 text-sm leading-5 text-bg-noir-100 text-left hover:bg-noir-900 focus:outline-none focus:bg-noir-900 transition">
            <slot />
        </button>

        <a v-else-if="as =='a'" :href="href" class="block px-4 py-2 text-sm leading-5 text-bg-noir-100 hover:bg-noir-900 focus:outline-none focus:bg-noir-900 transition">
            <slot />
        </a>

        <Link v-else :href="href" class="block px-4 py-2 text-sm leading-5 text-bg-noir-100 hover:bg-noir-900 focus:outline-none focus:bg-noir-900 transition">
            <slot />
        </Link>
    </div>
</template>
