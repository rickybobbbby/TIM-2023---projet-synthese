<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {LMap, LTileLayer, LTooltip, LMarker, LIcon} from "@vue-leaflet/vue-leaflet";
import {computed, reactive, ref} from "vue";

const zoom = ref(2);
const iconSize = ref(64)

const dynamicSize = computed(() => [iconSize.value, iconSize.value * 1.15])
const dynamicAnchor = computed(() => [iconSize.value / 2, iconSize.value * 1.15])

const xy = reactive({x: 0, y: 0})

const isDragging = ref(false);

const updateLatLong = (latLng, force = false) => {
    if (latLng != null && xy.y === latLng.lat && xy.x === latLng.lng && !force) return;

    if (!force) {
        xy.y = latLng.lat;
        xy.x = latLng.lng;

        if (isDragging.value === true) return; // Pour check si c'est en train d'etre drag-drop
    }

    axios.post('/games/1/tokens/1/move', {x: xy.x, y: xy.y}).
        then((resp) => console.log(resp)).catch(err => console.log(err));
}

window.Echo.private(`Game.1`)
    .listen(`.token.moved`, (e) => {
        xy.x = e.x;
        xy.y = e.y;
    });

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Session de Jeu
            </h2>
        </template>

        <div class="container w-full h-[70vh] mx-auto ">
            <l-map ref="map" :zoom="zoom" :center="[47.41322, -1.219482]">
                <l-tile-layer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    layer-type="base"
                    name="OpenStreetMap"
                ></l-tile-layer>
                <l-marker :lat-lng="[xy.y, xy.x]" draggable @update:latLng="updateLatLong($event)" @dragstart="isDragging = true" @dragend="isDragging = false; updateLatLong(null, true)">
                    <l-icon
                        :icon-size="dynamicSize"
                        :icon-anchor="dynamicAnchor"
                        icon-url="https://cdn-icons-png.flaticon.com/512/2492/2492773.png"
                    />
                    <l-tooltip>
                        Token 1
                    </l-tooltip>
                </l-marker>
            </l-map>
        </div>
        <div class="container w-full h-[70vh] mx-auto ">

        </div>

    </AppLayout>
</template>
