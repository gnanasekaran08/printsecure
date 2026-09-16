<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import type { Snippet } from 'svelte';
    import AppLogoIcon from '@/components/AppLogoIcon.svelte';
    import { home } from '@/routes';

    let {
        title = '',
        description = '',
        children,
    }: {
        title?: string;
        description?: string;
        children?: Snippet;
    } = $props();
</script>

<div class="min-h-svh bg-[#f7f8f5] p-2 text-[#17221d] sm:p-6 lg:p-10">
    <div class="mx-auto grid min-h-[calc(100svh-1rem)] max-w-6xl overflow-hidden rounded-[1.5rem] border border-[#dce6df] bg-white shadow-[0_24px_80px_rgba(38,67,50,0.1)] sm:min-h-[calc(100svh-3rem)] sm:rounded-[2rem] lg:grid-cols-[0.85fr_1.15fr]">
        <aside class="relative hidden overflow-hidden bg-[#e8f4eb] p-10 lg:flex lg:flex-col lg:justify-between lg:p-12">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full border-[20px] border-[#d3ead9]"></div>
            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full border-[28px] border-[#d3ead9]"></div>
            <div class="relative">
                <Link href={home()} class="inline-flex items-center">
                    <AppLogoIcon class="h-12 w-auto" />
                    <span class="sr-only">PrintSecure home</span>
                </Link>
                <p class="mt-20 max-w-sm text-4xl font-semibold leading-tight tracking-[-0.04em] [font-family:'Space_Grotesk',sans-serif]">
                    Print what matters.<br /><span class="text-[#2f8f5b]">Keep it private.</span>
                </p>
                <p class="mt-5 max-w-sm leading-7 text-[#5f806b]">
                    A simpler way to send documents to a local print shop, without creating another account to manage.
                </p>
            </div>
        </aside>

        <main class="flex items-center justify-center p-5 sm:p-10 lg:p-16">
            <div class="w-full max-w-md">
                <div class="mb-8 flex items-center justify-between sm:mb-10 lg:hidden">
                    <Link href={home()} class="inline-flex items-center">
                        <AppLogoIcon class="h-10 w-auto" />
                        <span class="sr-only">PrintSecure home</span>
                    </Link>
                    <span class="text-xs font-bold uppercase tracking-[0.14em] text-[#718078]">Private printing</span>
                </div>
                <div class="mb-8 space-y-2">
                    <h1 class="text-3xl font-semibold tracking-[-0.04em] [font-family:'Space_Grotesk',sans-serif]">{title}</h1>
                    <p class="text-sm leading-6 text-[#718078]">{description}</p>
                </div>
                {@render children?.()}
            </div>
        </main>
    </div>
</div>
