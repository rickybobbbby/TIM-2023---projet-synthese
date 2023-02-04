<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {LMap, LTileLayer, LTooltip, LMarker, LIcon} from "@vue-leaflet/vue-leaflet";
import {computed, reactive, ref} from "vue";

const props = defineProps({
    gameId: Number,
    tokens: Array,
})

const tokens = reactive([]);

for (const token of props.tokens) {
    tokens.push({
        id: token.id,
        name: token.name,
        latitude: token.latitude,
        longitude: token.longitude,
        image: token.image,
        isDragging: false
    });
}

const zoom = ref(2);
const iconSize = ref(64)

const dynamicSize = computed(() => [iconSize.value, iconSize.value * 1.15])
const dynamicAnchor = computed(() => [iconSize.value / 2, iconSize.value * 1.15])

const updateLatLong = (token, latLng) => {
    if (token.latitude === latLng.lat && token.longitude === latLng.lng) return;

    token.latitude = latLng.lat;
    token.longitude = latLng.lng;

    if (token.isDragging === true) return; // Pour check si c'est en train d'etre drag-drop

    axios.post(`/games/${props.gameId}/tokens/${token.id}/move`, {longitude: token.longitude, latitude: token.latitude}).
        then((resp) => console.log(resp)).catch(err => console.log(err));
}

window.Echo.private(`Game.1`)
    .listen(`.token.moved`, (e) => {
        console.log(e);
        for (const token of tokens) {
            if (token.id === e.tokenId) {
                token.latitude = e.latitude;
                token.longitude = e.longitude;
            }
        }
    });

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Session de Jeu
            </h2>
        </template>

        <div class="w-full h-[70vh] mx-auto ">
            <l-map ref="map" :zoom="zoom" :center="[47.41322, -1.219482]">
                <l-tile-layer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    layer-type="base"
                    name="OpenStreetMap"
                ></l-tile-layer>
                <l-marker v-for="token in tokens" :lat-lng="[token.latitude, token.longitude]" draggable @update:latLng="updateLatLong(token, $event)" @dragstart="token.isDragging = true" @dragend="token.isDragging = false; updateLatLong(token, {lng: token.longitude, lat: token.latitude})">
                    <l-icon
                        :icon-size="dynamicSize"
                        :icon-anchor="dynamicAnchor"
                        :icon-url="token.image"
                    />
                    <l-tooltip>
                        Token 1
                    </l-tooltip>
                </l-marker>
            </l-map>
        </div>


    </AppLayout>
</template>
