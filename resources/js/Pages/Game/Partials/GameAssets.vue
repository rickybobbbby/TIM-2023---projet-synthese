<script setup>
import {ref} from 'vue'
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import {XMarkIcon, CloudArrowUpIcon} from '@heroicons/vue/24/outline'
import {PlusCircleIcon} from '@heroicons/vue/20/solid'
import {useForm} from "@inertiajs/vue3";
import {EllipsisVerticalIcon} from '@heroicons/vue/20/solid'

// region Props, Variables and Emits
const props = defineProps({
    open: {
        type: Boolean,
        default: false,
    },
    game: {
        type: Object,
        required: true,
    },
    tokens: {
        type: Array,
        required: true,
    },
    asset: {
        type: Object,
        required: false,
    },
});

const tabs = [
    {name: 'Maps', ref: 'maps'},
    {name: 'Character Tokens', ref: 'tokens'},
];

const currentTab = ref('maps')

const emit = defineEmits(['close', 'assetStored']);
// endregion

// region Form Variables
const assetUploadForm = useForm({
    file: null,
});

const tokenUploadForm = useForm({
    file: null,
})
// endregion

// region Method Emitters
const close = () => {
    emit('close');
};

const switchTab = (slug) => {
    currentTab.value = slug;
};

const uploadAsset = () => {
    if (assetUploadForm.processing === true) return;

    assetUploadForm.post(route('game.asset.store', {game: props.game.id}), {
        errorBag: 'uploadAsset',
        preserveScroll: true,
        onSuccess: () => {
            emit('assetStored');
        },
    });
};


// endregion

const team = [
    {
        name: 'Leslie Alexander',
        handle: 'lesliealexander',
        href: '#',
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        status: 'online',
    },
    // More people...
];

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
                                <div class="flex h-full flex-col overflow-y-auto bg-noir-800 shadow-xl">
                                    <div class="mb-4">
                                        <div class="bg-principal-main py-6 px-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <DialogTitle class="text-base font-semibold leading-6 text-white">
                                                    Game Assets
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
                                                <p class="text-sm text-noir-900">
                                                    Change your Map assets or drop your tokens here.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-b border-gray-200">
                                        <div class="px-6">
                                            <nav class="-mb-px flex space-x-6">
                                                <button v-for="tab in tabs" :key="tab.ref" @click="switchTab(tab.ref)"
                                                        :class="[tab.ref === currentTab ? 'border-principal-wash text-principal-wash' : 'border-transparent text-noir-300 hover:border-gray-300 hover:text-noir-100', 'whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium']">
                                                    {{ tab.name }}
                                                </button>
                                            </nav>
                                        </div>
                                    </div>

                                    <div class="flex flex-1 flex-col justify-between">
                                        <div class="divide-y divide-noir-100 px-4 sm:px-6">
                                            <div class="pt-6 pb-5">
                                                <!-- Maps -->
                                                <div v-show="currentTab === 'maps'">
                                                    <div class="max-w-xl">
                                                        <label
                                                            class="flex flex-col justify-center w-full h-32 px-4 transition border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                                                            <span class="flex justify-center items-center space-x-2">
                                                                <CloudArrowUpIcon class="w-6 h-6 text-white"/>

                                                                <span class="font-medium text-white">
                                                                    Drop files to Attach, or
                                                                    <span class="text-principal-main underline">browse</span>
                                                                </span>
                                                            </span>
                                                            <span class="flex justify-center items-center space-x-2">
                                                                <span class="block text-sm text-gray-400">
                                                                    JPEG, PNG and BMP files only.
                                                                </span>
                                                            </span>
                                                            <input type="file" @change="uploadAsset" @input="assetUploadForm.file = $event.target.files[0]" name="file_asset" class="hidden">
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- End Maps -->
                                                <!-- Tokens -->
                                                <div v-show="currentTab === 'tokens'">
                                                    <div class="max-w-xl">
                                                        <label
                                                            class="flex flex-col justify-center w-full h-32 px-4 transition border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                                                            <span class="flex justify-center items-center space-x-2">
                                                                <CloudArrowUpIcon class="w-6 h-6 text-white"/>

                                                                <span class="font-medium text-white">
                                                                    Drop files to Attach, or
                                                                    <span class="text-principal-main underline">browse</span>
                                                                </span>
                                                            </span>
                                                            <span class="flex justify-center items-center space-x-2">
                                                                <span class="block text-sm text-gray-400">
                                                                    JPEG, PNG and BMP files only.
                                                                </span>
                                                            </span>
                                                            <input type="file" name="file_token" class="hidden">
                                                        </label>
                                                    </div>

                                                    <ul role="list"
                                                        class="flex-1 divide-y divide-gray-200 overflow-y-auto">
                                                        <li v-for="person in team" :key="person.handle">
                                                            <div class="group relative flex items-center py-6 px-5">
                                                                <a :href="person.href" class="-m-1 block flex-1 p-1">
                                                                    <div
                                                                        class="absolute inset-0 group-hover:bg-noir-900"
                                                                        aria-hidden="true"/>
                                                                    <div
                                                                        class="relative flex min-w-0 flex-1 items-center">
                                                                        <span class="relative inline-block flex-shrink-0">
                                                                            <img class="h-10 w-10 rounded-full" :src="person.imageUrl"
                                                                                 alt=""/>
                                                                            <span
                                                                                :class="[person.status === 'online' ? 'bg-green-400' : 'bg-gray-300', 'absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white']"
                                                                                aria-hidden="true"/>
                                                                        </span>
                                                                        <div class="ml-4 truncate">
                                                                            <p class="truncate text-sm font-medium text-noir-100">
                                                                                {{ person.name }}</p>
                                                                            <p class="truncate text-sm text-noir-300">
                                                                                {{ '@' + person.handle }}</p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <Menu as="div"
                                                                      class="relative ml-2 inline-block flex-shrink-0 text-left">
                                                                    <MenuButton
                                                                        class="group relative inline-flex h-8 w-8 items-center justify-center rounded-full bg-principal-wash hover:bg-principal-main focus:outline-none focus:ring-2 focus:ring-principal-wash focus:ring-offset-2">
                                                                        <span class="sr-only">Open options menu</span>
                                                                        <span
                                                                            class="flex h-full w-full items-center justify-center rounded-full">
                                                                            <EllipsisVerticalIcon
                                                                                class="h-5 w-5 text-gray-400 group-hover:text-noir-300"
                                                                                aria-hidden="true"/>
                                                                        </span>
                                                                    </MenuButton>
                                                                    <transition
                                                                        enter-active-class="transition ease-out duration-100"
                                                                        enter-from-class="transform opacity-0 scale-95"
                                                                        enter-to-class="transform opacity-100 scale-100"
                                                                        leave-active-class="transition ease-in duration-75"
                                                                        leave-from-class="transform opacity-100 scale-100"
                                                                        leave-to-class="transform opacity-0 scale-95">
                                                                        <MenuItems
                                                                            class="absolute top-0 right-9 z-10 w-48 origin-top-right rounded-md bg-principal-main shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                                            <div class="py-1">
                                                                                <MenuItem v-slot="{ active }">
                                                                                    <a href="#"
                                                                                       :class="[active ? 'bg-gray-100 text-noir-100' : 'text-noir-100', 'block px-4 py-2 text-sm']">View
                                                                                        profile</a>
                                                                                </MenuItem>
                                                                                <MenuItem v-slot="{ active }">
                                                                                    <a href="#"
                                                                                       :class="[active ? 'bg-gray-100 text-noir-100' : 'text-noir-100', 'block px-4 py-2 text-sm']">Send
                                                                                        message</a>
                                                                                </MenuItem>
                                                                            </div>
                                                                        </MenuItems>
                                                                    </transition>
                                                                </Menu>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- End Tokens -->
                                            </div>
                                        </div>
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
