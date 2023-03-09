<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {LMap, LTooltip, LMarker, LIcon, LImageOverlay} from "@vue-leaflet/vue-leaflet";
import {computed, onBeforeUnmount, onMounted, reactive, ref} from "vue";

import GameSettings from "./Partials/GameSettings.vue";
import GameAssets from "./Partials/GameAssets.vue";
import {CRS} from "leaflet";

// region Props
const props = defineProps({
    game: Object,
    tokens: Array,
    players: Array,
    asset: {
        type: Object,
        required: false
    },
});

// endregion

// region Reactive variables declaration
const tokens = reactive([]);
const zoom = ref(2);
const iconSize = ref(64)

const dynamicSize = computed(() => [iconSize.value, iconSize.value * 1.15])
const dynamicAnchor = computed(() => [iconSize.value / 2, iconSize.value * 1.15])

for (const token of props.tokens) {
    tokens.push({
        id: token.id,
        name: token.name,
        latitude: token.latitude,
        longitude: token.longitude,
        url: token.url,
        isDragging: false
    });
}

const gameSettingsOpen = ref(false)
const gameAssetsOpen = ref(false);
// endregion

// region Vue Method Handlers
const updateLatLong = (token, latLng) => {
    if (token.latitude === latLng.lat && token.longitude === latLng.lng) return;

    token.latitude = latLng.lat;
    token.longitude = latLng.lng;

    if (token.isDragging === true) return; // Pour check si c'est en train d'etre drag-drop

    axios.post(`/games/${props.game.id}/tokens/${token.id}/move`, {longitude: token.longitude, latitude: token.latitude})
        .then((resp) => console.log(resp)).catch(err => console.log(err));
}
// endregion

// region Echo Live Channel Lifecycle Hooks
onMounted(() => {
    window.Echo.private(`Game.${props.game.id}`)
        .listen(`.token.moved`, (e) => {
            for (const token of tokens) {
                if (token.id === e.tokenId) {
                    token.latitude = e.latitude;
                    token.longitude = e.longitude;
                }
            }
        });
});

onBeforeUnmount(() => {
    window.Echo.leave(`Game.${props.game.id}`);
});
// endregion

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="font-semibold text-xl text-white leading-tight">
                        Game Session: {{ game.name }}
                    </h2>
                </div>

                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <button @click="gameAssetsOpen = true" type="button" class="inline-flex items-center rounded-md bg-principal-main px-3 py-2 text-sm font-semibold text-noir-100 shadow-sm ring-noir-100 hover:text-noir-900 hover:bg-principal-wash">Assets</button>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <button @click="gameSettingsOpen = true" type="button" class="inline-flex items-center rounded-md bg-principal-main px-3 py-2 text-sm font-semibold text-noir-100 shadow-sm ring-noir-100 hover:text-noir-900 hover:bg-principal-wash">Settings</button>
                </div>
            </div>
        </template>

        <GameAssets
            :game="game" :tokens="tokens" :asset="asset"
            :open="gameAssetsOpen" @close="gameAssetsOpen = false"
        />

        <GameSettings
            :game="game" @name-updated="newValue => game.name = newValue"
            :players="players"
            :open="gameSettingsOpen" @close="gameSettingsOpen = false"
        />

        <div class="w-full h-[85vh] mx-auto">
            <l-map v-if="asset" use-global-leaflet ref="map" :crs="CRS.Simple" :zoom="zoom" :center="[0, 0]" :bounds="[[-(asset.height/3), -(asset.width/3)], [(asset.height/3), (asset.width/3)]]" :max-bounds="[[-(asset.height/3), -(asset.width/3)], [(asset.height/3), (asset.width/3)]]">
                <l-image-overlay :url="asset.url" :bounds="[[-(asset.height/3), -(asset.width/3)], [(asset.height/3), (asset.width/3)]]" ></l-image-overlay>
                <l-marker v-for="token in tokens" :lat-lng="[token.latitude, token.longitude]" draggable @update:latLng="updateLatLong(token, $event)" @dragstart="token.isDragging = true" @dragend="token.isDragging = false; updateLatLong(token, {lng: token.longitude, lat: token.latitude})">
                    <l-icon
                        :icon-size="dynamicSize"
                        :icon-anchor="dynamicAnchor"
                        :icon-url="token.url"
                    />
                    <l-tooltip>
                        token
                    </l-tooltip>
                </l-marker>
            </l-map>
        </div>
    </AppLayout>
</template>
