<script setup>
import {ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {TrashIcon, XMarkIcon} from '@heroicons/vue/24/outline'
import {PlusCircleIcon, CheckCircleIcon} from '@heroicons/vue/20/solid'
import {useForm} from "@inertiajs/vue3";

// region Props, Emits and Vars
const props = defineProps({
    open: {
        type: Boolean,
        default: false,
    },
    game: {
        type: Object,
        required: true,
    },
    players: {
        type: Array,
        required: true,
    }
});


const emit = defineEmits(['close', 'playerInvited', 'playedKicked', 'nameUpdated']);
// endregion

// region Form Data
const gameNameForm = useForm({
    name: props.game.name,
});

const kickPlayerForm = useForm({

});

// endregion

// region Method Emitters
const close = () => {
    emit('close');
};

const updateName = () => {
    if (props.game.name.trim() === gameNameForm.name.trim() || gameNameForm.processing === true) return;

    gameNameForm.post(route('game', {game: props.game.id}), {
        errorBag: 'updateName',
        preserveScroll: true,
        onSuccess: () => {
            emit('nameUpdated', gameNameForm.name);
        },
        onError: () => {

        },
    });
};

const invitePlayer = () => {
    emit('playerAdded');
};

const kickPlayer = (playerId) => {
    kickPlayerForm.delete(route('game.player.kick', {game: props.game.id, player: playerId}), {
        errorBag: 'kickPlayer',
        preserveScroll: true,
        onSuccess: () => {
            emit('playedKicked', playerId);
            console.log("Kicked", playerId);
        }
    });
};
// endregion

</script>


<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-[1000]" @close="close">
            <div class="fixed inset-0"/>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                        <TransitionChild as="template"
                                         enter="transform transition ease-in-out duration-300 sm:duration-400"
                                         enter-from="translate-x-full" enter-to="translate-x-0"
                                         leave="transform transition ease-in-out duration-300 sm:duration-400"
                                         leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="pointer-events-auto w-screen max-w-md">
                                <div class="flex h-full flex-col divide-y divide-noir-100 bg-noir-800 shadow-xl">
                                    <div class="h-0 flex-1 overflow-y-auto">
                                        <div class="bg-principal-main py-6 px-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle class="text-base font-semibold leading-6 text-white">Game
                                                    Settings
                                                </DialogTitle>
                                                <div class="ml-3 flex h-7 items-center">
                                                    <button type="button"
                                                            class="rounded-md bg-noir-800 text-principal-wash hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                            @click="close">
                                                        <span class="sr-only">Close panel</span>
                                                        <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <p class="text-sm text-noir-900">Change your game title and invite players from here.</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-1 flex-col justify-between">
                                            <div class="divide-y divide-noir-100 px-4 sm:px-6">
                                                <div class="space-y-6 pt-6 pb-5">
                                                    <div>
                                                        <label for="game-name"
                                                               class="block text-sm font-medium leading-6 text-white">Game
                                                            name</label>
                                                        <div class="mt-2">
                                                            <div class="mt-2 flex rounded-md shadow-sm">
                                                                <div class="relative flex flex-grow items-stretch focus-within:z-10">
                                                                    <input @keydown.enter.prevent="updateName" :readonly="gameNameForm.processing" type="text" v-model="gameNameForm.name" name="game-name" id="game-name" class="block w-full rounded-none rounded-l-md border-0 py-1.5 text-noir-100 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-principal-wash sm:text-sm sm:leading-6 read-only:bg-noir-500" />
                                                                </div>
                                                                <button :disabled="gameNameForm.processing" @click="updateName" type="button" class="relative bg-principal-wash -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-noir-900 hover:text-noir-100 hover:bg-principal-main">
                                                                    <CheckCircleIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-sm font-medium leading-6 text-white">Game
                                                            Players</h3>
                                                        <div class="mt-2 mb-4">
                                                            <ul role="list" class="-my-5 divide-y divide-noir-100">
                                                                <li v-for="player in players" :key="player.player.id" class="py-4">
                                                                    <div class="flex items-center space-x-4">
                                                                        <div class="min-w-0 flex-1">
                                                                            <p class="truncate text-sm font-medium text-noir-100">{{ player.username }}</p>
                                                                            <p class="truncate text-sm text-noir-300">{{ player.name }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <button @click="kickPlayer(player.player.id)" :disabled="kickPlayerForm.processing" type="button" class="inline-flex items-center justify-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                                                                                <TrashIcon class="w-6 h-6"/>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <button type="button" class="w-full justify-center inline-flex items-center gap-x-2 rounded-md bg-principal-wash py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:bg-principal-wash focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-principal-wash">
                                                            Add a Player
                                                            <PlusCircleIcon class="-mr-0.5 h-5 w-5" aria-hidden="true" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-shrink-0 justify-end px-4 py-4">
                                        <button type="button"
                                                class="rounded-md bg-noir-800 py-2 px-3 text-sm font-semibold text-white hover:text-noir-900 shadow-sm ring-1 ring-inset ring-noir-100 hover:bg-principal-main"
                                                @click="close">Close
                                        </button>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
