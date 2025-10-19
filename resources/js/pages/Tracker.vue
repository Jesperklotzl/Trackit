<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import type { AppPageProps, User } from '@/types';
import { router } from '@inertiajs/vue3'

const page = usePage<AppPageProps>();
const user = computed<User | null>(() => page.props.auth.user ?? null);


function addTimestamp() {
    router.post('/', {}, {
        onSuccess: () => {
            router.reload({ only: ['data'] }) // reload just the 'data' prop
        },
    })
}

</script>

<template>

    {{user}}

    <div class="min-h-screen bg-background-light dark:bg-background-dark font-display flex flex-col items-center justify-between p-4">
        <!-- Header -->
        <div class="flex w-full items-center justify-between">
            <button
                @click="resetCounter"
                class="flex size-10 items-center justify-center rounded-full text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800"
            >
                <span class="material-symbols-outlined">restart_alt</span>
            </button>
        </div>

        <!-- Capsule -->
        <div class="flex flex-col items-center justify-center flex-1">
            <div
                class="relative w-64 h-80 rounded-full bg-slate-200 dark:bg-slate-800 flex flex-col items-center justify-center shadow-lg overflow-hidden"
            >
                <div
                    class="absolute inset-x-0 bottom-0 bg-primary dark:bg-primary transition-all duration-300 ease-in-out"
                    :style="{ height: fillHeight + '%' }"
                ></div>

                <button
                    class="relative z-10 w-[calc(100%-1rem)] h-[calc(100%-1rem)] rounded-full border-4 border-slate-200 dark:border-slate-800 flex flex-col items-center justify-center active:scale-[0.98] transition-transform duration-150"
                    @click="addTimestamp"
                >
                    <p class="text-white text-base font-normal tracking-wide opacity-80 mb-2">
                        Today's Progress
                    </p>
                    <h1 class="text-white text-7xl font-bold mb-4">{{ count }}</h1>
                    <p class="text-white text-sm font-normal opacity-70">
                        Last press: {{ lastPressDisplay }}
                    </p>
                </button>
            </div>
        </div>

        <div class="h-10"></div>
    </div>
</template>
