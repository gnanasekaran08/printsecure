<script lang="ts">
    import { Link, page } from '@inertiajs/svelte';
    import {
        ArrowUpRight,
        Check,
        Clock3,
        EyeOff,
        FileText,
        LockKeyhole,
        QrCode,
        ScanLine,
        ShieldCheck,
        Store,
        Upload,
    } from 'lucide-svelte';
    import { onMount } from 'svelte';
    import AppHead from '@/components/AppHead.svelte';
    import { toUrl } from '@/lib/utils';
    import { dashboard } from '@/routes';

    let { data } = $props();
    const auth = $derived($page.props.auth);

    const flowSteps = [
        {
            icon: QrCode,
            title: 'Scan QR',
            subtitle: 'Corner Copy',
        },
        {
            icon: Upload,
            title: 'Upload',
            subtitle: 'brief.pdf · 2.4 MB',
        },
        {
            icon: FileText,
            title: 'Printing',
            subtitle: '2 mins left',
        },
    ];

    let activeStep = $state(0);

    onMount(() => {
        const interval = setInterval(() => {
            activeStep = (activeStep + 1) % flowSteps.length;
        }, 2200);
        return () => clearInterval(interval);
    });

    const benefits = [
        {
            icon: EyeOff,
            title: 'Private by default',
            description: 'No account, no profile, and no personal data trail.',
        },
        {
            icon: Clock3,
            title: 'Ready in minutes',
            description:
                'Send a file to a nearby shop and collect when it is ready.',
        },
        {
            icon: ShieldCheck,
            title: 'Secure handling',
            description:
                'Files are protected in transit and removed after printing.',
        },
    ];

    const steps = [
        {
            number: '01',
            icon: QrCode,
            title: 'Scan the shop',
            text: 'Connect to a trusted print shop with one quick scan.',
        },
        {
            number: '02',
            icon: Upload,
            title: 'Send your file',
            text: 'Upload a PDF or document and choose your print settings.',
        },
        {
            number: '03',
            icon: Store,
            title: 'Collect securely',
            text: 'Pay at checkout, then pick up your pages when ready.',
        },
    ];
</script>

<AppHead title="Print privately. Collect simply.">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin="anonymous"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet"
    />
</AppHead>

<div
    data-theme="printsecure"
    class="min-h-screen overflow-hidden bg-[#f7f8f5] text-[#17221d] [font-family:'DM_Sans',sans-serif]"
>
    <nav
        class="relative z-10 mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10"
    >
        <a
            href="/"
            class="flex items-center gap-3"
            aria-label="PrintSecure home"
        >
            <img
                src={$page.props.app_logo}
                alt="PrintSecure"
                class="h-10 w-auto"
            />
        </a>
        <div
            class="hidden items-center gap-8 text-sm font-semibold text-[#617069] md:flex"
        >
            <a href="#why" class="transition-colors hover:text-[#17221d]"
                >Why PrintSecure</a
            >
            <a href="#how" class="transition-colors hover:text-[#17221d]"
                >How it works</a
            >
        </div>
        <div class="flex items-center gap-2 sm:gap-4">
            {#if auth.user}
                <Link
                    href={toUrl(dashboard())}
                    class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-white"
                    >Dashboard</Link
                >
            {:else}
                <Link
                    href="/login"
                    class="hidden rounded-full px-4 py-2 text-sm font-semibold text-[#617069] hover:text-[#17221d] sm:block"
                    >Log in</Link
                >
                <Link
                    href="/register"
                    class="rounded-full bg-[#17221d] px-4 py-2.5 text-sm font-semibold text-white transition-transform hover:-translate-y-0.5"
                    >For shop owners <ArrowUpRight
                        class="inline h-4 w-4"
                    /></Link
                >
            {/if}
        </div>
    </nav>

    <main>
        <section
            class="relative mx-auto grid max-w-7xl items-center gap-14 px-6 pb-20 pt-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-10 lg:pb-28 lg:pt-20"
        >
            <div class="relative z-10 max-w-2xl">
                <div
                    class="mb-7 inline-flex items-center gap-2 rounded-full border border-[#b8d6c3] bg-[#e8f4eb] px-3.5 py-2 text-xs font-bold uppercase tracking-[0.14em] text-[#297048]"
                >
                    <span class="h-2 w-2 rounded-full bg-[#38a169]"></span>Print
                    with secure.
                </div>
                <h1
                    class="max-w-xl text-5xl font-semibold leading-[0.98] tracking-[-0.05em] text-[#17221d] sm:text-6xl lg:text-8xl [font-family:'Space_Grotesk',sans-serif]"
                >
                    Your files.<br /><span class="text-[#2f8f5b]"
                        >Your privacy.</span
                    >
                </h1>
                <p
                    class="mt-7 max-w-lg text-lg leading-8 text-[#617069] sm:text-xl"
                >
                    Upload, pay, and collect your prints from a local shop.
                    PrintSecure keeps the whole handoff quick, private, and
                    refreshingly simple.
                </p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <Link
                        href="/scan"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-[#2f8f5b] px-6 py-4 text-sm font-bold text-white shadow-[0_10px_30px_rgba(47,143,91,0.24)] transition-all hover:-translate-y-1 hover:bg-[#26794b]"
                        ><ScanLine class="h-5 w-5" />Find a print shop</Link
                    >
                    <a
                        href="#how"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-[#cad4ce] bg-white/60 px-6 py-4 text-sm font-bold text-[#17221d] transition-colors hover:bg-white"
                        >See how it works <ArrowUpRight class="h-5 w-5" /></a
                    >
                </div>
                <div
                    class="mt-10 flex flex-wrap gap-x-6 gap-y-3 text-sm font-semibold text-[#617069]"
                >
                    <span class="inline-flex items-center gap-2"
                        ><Check class="h-4 w-4 text-[#2f8f5b]" />No sign-up</span
                    ><span class="inline-flex items-center gap-2"
                        ><Check
                            class="h-4 w-4 text-[#2f8f5b]"
                        />Auto-delete</span
                    ><span class="inline-flex items-center gap-2"
                        ><Check class="h-4 w-4 text-[#2f8f5b]" />Secure upload</span
                    >
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-xl lg:justify-self-end">
                <div
                    class="absolute -right-10 -top-10 h-28 w-28 rounded-full border border-[#d5e7da] bg-[#e6f3e9] sm:h-40 sm:w-40"
                ></div>
                <div
                    class="relative overflow-hidden rounded-[2rem] border border-[#d7e0d9] bg-white p-4 shadow-[0_24px_80px_rgba(38,67,50,0.12)] sm:p-6"
                >
                    <div
                        class="flex items-center justify-between border-b border-[#edf0ed] pb-5"
                    >
                        <div class="flex items-center gap-2 text-sm font-bold">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#3fb56b]"
                            ></span>Scan · Upload · Print
                        </div>
                        <span
                            class="rounded-full bg-[#edf8ef] px-3 py-1 text-xs font-bold text-[#2f8f5b]"
                            >Live</span
                        >
                    </div>
                    <div class="relative py-8">
                        <div class="relative grid grid-cols-3 gap-2 text-center sm:gap-4">
                            {#each flowSteps as step, i (step.title)}
                                <div class="flex flex-col items-center gap-3">
                                    <div class="relative flex h-12 w-12 items-center justify-center">
                                        {#if i === activeStep}
                                            <span
                                                class="absolute inset-0 animate-ping rounded-2xl bg-[#2f8f5b]/40"
                                            ></span>
                                        {/if}
                                        <div
                                            class={`relative flex h-12 w-12 items-center justify-center rounded-2xl transition-all duration-500 ${
                                                i <= activeStep
                                                    ? 'bg-[#2f8f5b] text-white shadow-[0_10px_20px_rgba(47,143,91,0.28)]'
                                                    : 'bg-[#eef2ef] text-[#a7b3ac]'
                                            } ${i === activeStep ? 'scale-110' : 'scale-100'}`}
                                        >
                                            <step.icon class="h-6 w-6" />
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class={`text-sm font-bold transition-colors duration-500 ${i <= activeStep ? 'text-[#17221d]' : 'text-[#a7b3ac]'}`}
                                        >
                                            {step.title}
                                        </div>
                                        <div class="mt-0.5 text-xs text-[#8a9890]">
                                            {step.subtitle}
                                        </div>
                                    </div>
                                </div>
                            {/each}
                        </div>
                    </div>
                </div>
                <div
                    class="absolute -bottom-6 -left-7 hidden items-center gap-3 rounded-2xl border border-[#d7e0d9] bg-white px-4 py-3 text-sm font-bold shadow-lg sm:flex"
                >
                    <div class="rounded-xl bg-[#fff2d8] p-2 text-[#c17c16]">
                        <EyeOff class="h-5 w-5" />
                    </div>
                    <span
                        >Nothing stored<br /><small
                            class="font-medium text-[#8a9890]"
                            >after collection</small
                        ></span
                    >
                </div>
            </div>
        </section>
        <section id="why" class="border-y border-[#e1e8e2] bg-white/60">
            <div class="mx-auto max-w-7xl px-6 py-20 lg:px-10 lg:py-24">
                <div class="mb-12 max-w-2xl">
                    <p class="mb-4 text-xs font-bold uppercase tracking-[0.18em] text-[#2f8f5b]">Why PrintSecure</p>
                    <h2 class="text-4xl font-semibold leading-tight tracking-[-0.04em] sm:text-5xl [font-family:'Space_Grotesk',sans-serif]">The easier way to print in public.</h2>
                    <p class="mt-5 max-w-xl text-lg leading-8 text-[#718078]">Your document should only need to make one trip: from your phone to the printer. PrintSecure keeps the rest quiet, quick, and under your control.</p>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    {#each benefits as benefit (benefit.title)}
                        <article class="rounded-2xl border border-[#dce6df] bg-white p-6 transition-transform hover:-translate-y-1">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#e8f4eb] text-[#2f8f5b]"><benefit.icon class="h-6 w-6" /></div>
                            <h3 class="mt-7 text-xl font-bold">{benefit.title}</h3>
                            <p class="mt-3 leading-7 text-[#718078]">{benefit.description}</p>
                        </article>
                    {/each}
                </div>
            </div>
        </section>
        <section
            id="how"
            class="mx-auto max-w-7xl px-6 py-24 lg:px-10 lg:py-32"
        >
            <div class="grid gap-12 lg:grid-cols-[0.7fr_1.3fr] lg:gap-24">
                <div>
                    <p
                        class="mb-4 text-xs font-bold uppercase tracking-[0.18em] text-[#2f8f5b]"
                    >
                        A better handoff
                    </p>
                    <h2
                        class="text-4xl font-semibold leading-tight tracking-[-0.04em] sm:text-5xl [font-family:'Space_Grotesk',sans-serif]"
                    >
                        Three steps.<br />Zero friction.
                    </h2>
                    <p class="mt-5 max-w-sm leading-7 text-[#718078]">
                        No accounts to remember and no confusing queues. Just a
                        clear path from file to finished page.
                    </p>
                </div>
                <div
                    class="divide-y divide-[#dfe7e1] border-y border-[#dfe7e1]"
                >
                    {#each steps as step (step.number)}
                        <div class="group flex gap-5 py-7 sm:gap-8">
                            <span class="pt-1 text-sm font-bold text-[#a5b2aa]"
                                >{step.number}</span
                            >
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-[#cce0d1] text-[#2f8f5b] transition-colors group-hover:bg-[#2f8f5b] group-hover:text-white"
                            >
                                <step.icon class="h-5 w-5" />
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">{step.title}</h3>
                                <p
                                    class="mt-1 text-sm leading-6 text-[#718078]"
                                >
                                    {step.text}
                                </p>
                            </div>
                        </div>
                    {/each}
                </div>
            </div>
        </section>

        <section class="mx-6 mb-20 overflow-hidden rounded-[2rem] bg-[#17221d]">
            <div
                class="grid items-center gap-8 px-7 py-12 sm:px-12 lg:grid-cols-[1fr_auto] lg:px-16 lg:py-14"
            >
                <div>
                    <p
                        class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-[#80d49d]"
                    >
                        For local print shops
                    </p>
                    <h2
                        class="max-w-xl text-3xl font-semibold tracking-[-0.03em] text-white sm:text-4xl [font-family:'Space_Grotesk',sans-serif]"
                    >
                        Turn nearby footfall into repeat customers.
                    </h2>
                    <p class="mt-4 max-w-xl leading-7 text-[#a8bbb0]">
                        Give customers a faster, more private way to print,
                        while your shop handles the final handoff.
                    </p>
                </div>
                <Link
                    href="/register"
                    class="inline-flex items-center justify-center gap-2 rounded-full bg-[#a5e5b8] px-6 py-4 text-sm font-bold text-[#17221d] transition-transform hover:-translate-y-1"
                    >Register your shop <ArrowUpRight class="h-5 w-5" /></Link
                >
            </div>
        </section>
    </main>

    <footer
        class="mx-auto flex max-w-7xl flex-col gap-4 border-t border-[#e1e8e2] px-6 py-8 text-sm text-[#718078] sm:flex-row sm:items-center sm:justify-between lg:px-10"
    >
        <div class="font-bold text-[#17221d]">PrintSecure</div>
        <div>Print simply. Keep it private.</div>
        <div>© {new Date().getFullYear()} PrintSecure</div>
    </footer>
</div>
