<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div class="p-6 sm:px-20 bg-noir-800 border-b border-noir-100">
            <div>
                <ApplicationLogo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl text-noir-100">
                Welcome to your BattleHub!
            </div>

            <div class="mt-6 text-noir-100">
                Your platforme to recreate all you imaginary battle field. Battle is a platforme to facilitaty playing role playing game online with your friend. Here you will find all your accessible game:
            </div>
        </div>

        <div class="bg-noir-100 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-noir-100"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                    <div class="ml-4 text-lg text-noir-100 leading-7 font-semibold">
                        <a href="http://battlehub.test/games/1">Yannick Game</a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-noir-100">
                        "Welcome to my game -  contact me for information"
                        </div>

                    <a href="http://battlehub.test/games/1">
                        <div class="mt-3 flex items-center text-sm font-semibold text-principal-wash">
                            <div>Join Session</div>

                            <div class="ml-1 text-principal-wash">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-noir-100 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-noir-100"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                    <div class="ml-4 text-lg text-noir-100 leading-7 font-semibold">
                        <a href="http://battlehub.test/games/1">Public Game</a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-noir-100">
                        Placeholder
                           </div>

                    <a href="http://battlehub.test/games/1">
                        <div class="mt-3 flex items-center text-sm font-semibold text-principal-wash">
                            <div>Join Session</div>

                            <div class="ml-1 text-principal-wash">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-noir-100">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-noir-100"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                    <div class="ml-4 text-lg text-noir-100 leading-7 font-semibold">
                        <a href="http://battlehub.test/games/1">Private Game</a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-noir-100">
                        Placeholder
                          </div>
                </div>
            </div>

            <div class="p-6 border-t border-noir-100 md:border-l">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-noir-100"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                    <div class="ml-4 text-lg text-noir-100 leading-7 font-semibold">
                        Private Game
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-noir-100">
                        placeholder
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>
