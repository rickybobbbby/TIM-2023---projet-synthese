<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {LMap, LTileLayer, LTooltip, LMarker, LIcon} from "@vue-leaflet/vue-leaflet";
import {computed, ref} from "vue";

const zoom = ref(2);
const iconSize = ref(64)

const dynamicSize = computed(() => [iconSize.value, iconSize.value * 1.15])
const dynamicAnchor = computed(() => [iconSize.value / 2, iconSize.value * 1.15])

const log = (a) => {
    console.log(a)
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Session de Jeu
            </h2>
        </template>

        <div class="container w-full h-[70vh] mx-auto ">
            <l-map ref="map" v-model:zoom="zoom" :center="[47.41322, -1.219482]">
                <l-tile-layer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    layer-type="base"
                    name="OpenStreetMap"
                ></l-tile-layer>
                <l-marker :lat-lng="[0, 0]" draggable @moveend="log('moveend')">
                    <l-icon
                        :icon-size="dynamicSize"
                        :icon-anchor="dynamicAnchor"
                        icon-url="/static/images/baseball-marker.png"
                    />
                    <l-tooltip>
                        Token 1
                    </l-tooltip>
                </l-marker>
            </l-map>
        </div>
    </AppLayout>
</template>
