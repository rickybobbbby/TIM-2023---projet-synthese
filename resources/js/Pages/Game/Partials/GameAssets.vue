<script setup>
import {ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {XMarkIcon} from '@heroicons/vue/24/outline'
import {PlusCircleIcon} from '@heroicons/vue/20/solid'

// region Props and Emits
const props = defineProps({
    open: Boolean
});

const emit = defineEmits(['close', 'addPlayer']);
const open = ref(props.open)
// endregion

// region Method Emitters
const close = () => {
    emit('close');
};

const addPlayer = () => {
    emit('addPlayer');
};
// endregion

const team = [
    {
        name: 'Tom Cook',
        email: 'tom.cook@example.com',
        href: '#',
        imageUrl:
            'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Whitney Francis',
        email: 'whitney.francis@example.com',
        href: '#',
        imageUrl:
            'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Leonard Krasner',
        email: 'leonard.krasner@example.com',
        href: '#',
        imageUrl:
            'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Floyd Miles',
        email: 'floyd.miles@example.com',
        href: '#',
        imageUrl:
            'https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        name: 'Emily Selman',
        email: 'emily.selman@example.com',
        href: '#',
        imageUrl:
            'https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
]
</script>


<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-[1000]" @close="open = false">
            <div class="fixed inset-0"/>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                        <TransitionChild as="template"
                                         enter="transform transition ease-in-out duration-500 sm:duration-700"
                                         enter-from="translate-x-full" enter-to="translate-x-0"
                                         leave="transform transition ease-in-out duration-500 sm:duration-700"
                                         leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="pointer-events-auto w-screen max-w-md">
                                <form class="flex h-full flex-col divide-y divide-noir-100 bg-noir-800 shadow-xl">
                                    <div class="h-0 flex-1 overflow-y-auto">
                                        <div class="bg-principal-main py-6 px-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle class="text-base font-semibold leading-6 text-white">Game
                                                    Settings
                                                </DialogTitle>
                                                <div class="ml-3 flex h-7 items-center">
                                                    <button type="button"
                                                            class="rounded-md bg-noir-800 text-principal-wash hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                            @click="open = false">
                                                        <span class="sr-only">Close panel</span>
                                                        <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <p class="text-sm text-noir-900">Edit your game settings here.</p>
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
                                                            <input type="text" name="project-name" id="game-name"
                                                                   class="block w-full rounded-md border-0 py-1.5 text-principal-main shadow-sm ring-1 ring-inset ring-noir-100 placeholder:text-principal-main focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-sm font-medium leading-6 text-white">Game
                                                            Players</h3>
                                                        <div class="mt-2">
                                                            <ul role="list" class="divide-y divide-noir-100">
                                                                <li v-for="person in team" :key="person.email" class="flex py-4">
                                                                    <div class="ml-3">
                                                                        <p class="text-sm font-medium text-noir-100">{{ person.name }}</p>
                                                                        <p class="text-sm text-noir-100">{{ person.email }}</p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <button type="button" class="w-full justify-center inline-flex items-center gap-x-2 rounded-md bg-indigo-600 py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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
                                                class="rounded-md bg-noir-800 py-2 px-3 text-sm font-semibold text-white hover:text-noir-900 shadow-sm ring-1 ring-inset ring-noir-100 hover:bg-gray-50"
                                                @click="open = false">Cancel
                                        </button>
                                        <button type="submit"
                                                class="ml-4 inline-flex justify-center rounded-md bg-principal-main py-2 px-3 text-sm font-semibold text-white hover:text-noir-900 shadow-sm hover:bg-principal-wash focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
