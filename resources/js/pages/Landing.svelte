<script lang="ts">
    import { Link, page } from '@inertiajs/svelte';
    import {
        ArrowUpRight,
        ChevronRight,
        QrCode,
        ScanLine,
        ShieldCheck,
        Store,
    } from 'lucide-svelte';
    import AppHead from '@/components/AppHead.svelte';
    import { dashboard } from '@/routes';
    import { toUrl } from '@/lib/utils';

    let { data } = $props();
    const auth = $derived($page.props.auth);

    const benefits = [
        {
            code: '01',
            title: 'Private by default',
            description: 'No profile, no inbox, no document trail left behind.',
            icon: ShieldCheck,
        },
        {
            code: '02',
            title: 'A clear handoff',
            description: 'Your file moves from phone to local printer with no detours.',
            icon: QrCode,
        },
        {
            code: '03',
            title: 'Built for real shops',
            description: 'Simple tools for owners who want fewer queues and happier customers.',
            icon: Store,
        },
    ];

    const steps = [
        { number: 'I', title: 'Find a shop', text: 'Scan the code at a participating print shop.' },
        { number: 'II', title: 'Send the file', text: 'Upload a PDF, select your settings, and confirm.' },
        { number: 'III', title: 'Collect the pages', text: 'Get notified when your private print job is ready.' },
    ];
</script>

<AppHead title="Print without leaving a trace.">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</AppHead>

<div data-theme="printsecure" class="min-h-screen overflow-hidden bg-[#f3f0e9] text-[#17231d] [font-family:'Manrope',sans-serif]">
    <header class="border-b border-[#17231d]/15 px-6 lg:px-12">
        <nav class="mx-auto flex max-w-[1440px] items-center justify-between py-5">
            <a href="/" class="flex items-center gap-3" aria-label="PrintSecure home">
                <img src={$page.props.app_logo} alt="PrintSecure" class="h-9 w-auto" />
                <span class="hidden border-l border-[#17231d]/25 pl-3 text-[10px] font-bold uppercase tracking-[0.22em] text-[#6a756c] sm:block">Private print infrastructure</span>
            </a>
            <div class="hidden items-center gap-9 font-mono text-[11px] uppercase tracking-[0.13em] text-[#59665d] md:flex">
                <a href="#system" class="transition-colors hover:text-[#1d704b]">System</a>
                <a href="#process" class="transition-colors hover:text-[#1d704b]">Process</a>
                <a href="#shops" class="transition-colors hover:text-[#1d704b]">For shops</a>
            </div>
            <div class="flex items-center gap-2 sm:gap-5">
                {#if auth.user}
                    <Link href={toUrl(dashboard())} class="font-mono text-[11px] uppercase tracking-[0.13em]">Dashboard <ArrowUpRight class="inline h-3.5 w-3.5" /></Link>
                {:else}
                    <Link href="/login" class="hidden font-mono text-[11px] uppercase tracking-[0.13em] text-[#59665d] hover:text-[#17231d] sm:block">Log in</Link>
                    <Link href="/register" class="bg-[#17231d] px-4 py-3 font-mono text-[10px] font-medium uppercase tracking-[0.12em] text-[#f3f0e9] transition-colors hover:bg-[#1d704b]">For shop owners <ArrowUpRight class="ml-1 inline h-3.5 w-3.5" /></Link>
                {/if}
            </div>
        </nav>
    </header>

    <main>
        <section class="mx-auto grid max-w-[1440px] items-end gap-12 px-6 pb-20 pt-16 lg:grid-cols-[1.05fr_0.95fr] lg:px-12 lg:pb-28 lg:pt-24">
            <div>
                <p class="mb-8 font-mono text-[11px] uppercase tracking-[0.22em] text-[#1d704b]">PrintSecure / 001 / public access</p>
                <h1 class="max-w-4xl text-[clamp(3.6rem,8.2vw,8.6rem)] font-extrabold leading-[0.88] tracking-[-0.075em]">Print without<br /><span class="text-[#1d704b]">leaving a trace.</span></h1>
                <p class="mt-10 max-w-xl text-lg leading-8 text-[#59665d] lg:text-xl">A private route from your phone to a local printer. Upload, pay, and collect without turning your document into someone else’s data.</p>
                <div class="mt-10 flex flex-wrap items-center gap-5">
                    <Link href="/scan" class="inline-flex items-center gap-3 bg-[#1d704b] px-6 py-4 font-mono text-[11px] uppercase tracking-[0.11em] text-white transition-transform hover:-translate-y-1">Find a print shop <ScanLine class="h-4 w-4" /></Link>
                    <a href="#system" class="inline-flex items-center gap-2 font-mono text-[11px] uppercase tracking-[0.11em] text-[#59665d] hover:text-[#1d704b]">Read the system <ChevronRight class="h-4 w-4" /></a>
                </div>
            </div>
            <div class="relative min-h-[420px] border border-[#17231d]/20 bg-[#e6e5d9] p-5 lg:min-h-[500px]">
                <div class="absolute inset-5 border border-[#17231d]/15"></div>
                <div class="absolute left-9 top-9 font-mono text-[10px] uppercase tracking-[0.16em] text-[#68756c]">Fig. 01 / Secure handoff</div>
                <div class="absolute bottom-9 left-9 right-9 top-20 flex flex-col justify-between">
                    <div class="flex items-start justify-between"><div class="h-3 w-3 bg-[#1d704b] shadow-[0_0_0_6px_rgba(29,112,75,0.14)]"></div><span class="font-mono text-[10px] uppercase tracking-[0.12em] text-[#1d704b]">Signal active</span></div>
                    <div class="relative flex items-center justify-center py-5"><div class="absolute h-52 w-52 rounded-full border border-[#1d704b]/25"></div><div class="absolute h-36 w-36 rounded-full border border-[#1d704b]/35"></div><div class="flex h-24 w-24 items-center justify-center border-2 border-[#1d704b] bg-[#e6e5d9] text-[#1d704b]"><QrCode class="h-12 w-12" /></div></div>
                    <div class="grid grid-cols-3 border-t border-[#17231d]/20 pt-4 font-mono text-[10px] uppercase tracking-[0.08em] text-[#68756c]"><span><b class="block text-xl font-normal text-[#17231d]">01</b>upload</span><span><b class="block text-xl font-normal text-[#17231d]">02</b>encrypt</span><span><b class="block text-xl font-normal text-[#17231d]">03</b>collect</span></div>
                </div>
            </div>
        </section>

        <section id="system" class="border-y border-[#17231d]/15 bg-[#e8e6dc]">
            <div class="mx-auto max-w-[1440px] px-6 py-16 lg:px-12 lg:py-24">
                <div class="flex flex-col justify-between gap-8 border-b border-[#17231d]/20 pb-8 lg:flex-row lg:items-end"><div><p class="mb-4 font-mono text-[10px] uppercase tracking-[0.2em] text-[#1d704b]">System architecture</p><h2 class="max-w-2xl text-4xl font-extrabold leading-[0.95] tracking-[-0.06em] sm:text-6xl">A quieter way to move a file.</h2></div><p class="max-w-sm text-sm leading-7 text-[#68756c]">Every handoff has a clear boundary. Your file is useful for the print job, then it is gone.</p></div>
                <div class="mt-12 grid border-l border-t border-[#17231d]/20 sm:grid-cols-3">
                    {#each benefits as benefit (benefit.code)}
                        <article class="group min-h-64 border-b border-r border-[#17231d]/20 p-6 transition-colors hover:bg-[#f3f0e9] lg:p-8"><div class="flex items-start justify-between"><span class="font-mono text-xs text-[#1d704b]">{benefit.code}</span><benefit.icon class="h-5 w-5 text-[#1d704b]" /></div><h3 class="mt-16 text-xl font-bold tracking-[-0.03em]">{benefit.title}</h3><p class="mt-3 max-w-xs text-sm leading-6 text-[#68756c]">{benefit.description}</p></article>
                    {/each}
                </div>
            </div>
        </section>

        <section id="process" class="mx-auto max-w-[1440px] px-6 py-20 lg:px-12 lg:py-28">
            <div class="grid gap-14 lg:grid-cols-[0.7fr_1.3fr] lg:gap-24"><div><p class="mb-4 font-mono text-[10px] uppercase tracking-[0.2em] text-[#1d704b]">The handoff / 002</p><h2 class="text-5xl font-extrabold leading-[0.9] tracking-[-0.065em] sm:text-7xl">Three steps.<br />No noise.</h2><p class="mt-7 max-w-sm text-base leading-7 text-[#68756c]">No accounts to remember. No queue to decode. Just a clear path from file to finished page.</p></div><div class="border-t border-[#17231d]/20">{#each steps as step (step.number)}<div class="grid grid-cols-[48px_1fr] gap-5 border-b border-[#17231d]/20 py-7 sm:grid-cols-[70px_1fr_1fr] sm:gap-8"><span class="font-mono text-sm text-[#1d704b]">{step.number}</span><h3 class="text-xl font-bold tracking-[-0.03em]">{step.title}</h3><p class="col-start-2 text-sm leading-6 text-[#68756c] sm:col-start-auto">{step.text}</p></div>{/each}</div></div>
        </section>

        <section id="shops" class="mx-6 mb-20 bg-[#17231d] text-[#f3f0e9] lg:mx-12"><div class="mx-auto grid max-w-[1440px] items-end gap-10 px-7 py-12 sm:px-12 lg:grid-cols-[1fr_auto] lg:px-16 lg:py-16"><div><p class="mb-4 font-mono text-[10px] uppercase tracking-[0.2em] text-[#9dd5ae]">For local print shops</p><h2 class="max-w-2xl text-4xl font-extrabold leading-[0.95] tracking-[-0.06em] sm:text-6xl">Make privacy part of your service.</h2><p class="mt-6 max-w-xl leading-7 text-[#aab8ad]">Give people a modern way to print while your team keeps the final handoff simple, visible, and local.</p></div><Link href="/register" class="inline-flex items-center gap-3 border border-[#9dd5ae]/60 px-5 py-4 font-mono text-[10px] uppercase tracking-[0.12em] text-[#d7f0dc] hover:bg-[#1d704b]">Register your shop <ArrowUpRight class="h-4 w-4" /></Link></div></section>
+    </main>
+
+    <footer class="mx-auto flex max-w-[1440px] flex-col gap-4 border-t border-[#17231d]/20 px-6 py-8 font-mono text-[10px] uppercase tracking-[0.12em] text-[#68756c] sm:flex-row sm:items-center sm:justify-between lg:px-12"><span class="font-bold text-[#17231d]">PrintSecure / 2026</span><span>Private print infrastructure</span><span><a href="/login" class="hover:text-[#1d704b]">Client access</a> <span class="mx-2">/</span> Local by design</span></footer>
+</div>
