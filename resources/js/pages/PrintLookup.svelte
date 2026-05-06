<script lang="ts">
    import { router } from '@inertiajs/svelte';
    import { FileSearch, Printer, Search, Shield } from 'lucide-svelte';
    import AppHead from '@/components/AppHead.svelte';

    type Attachment = {
        filename: string;
        filetype: string;
        filesize: number;
        url: string;
    };

    type PrintJob = {
        job_uuid: string;
        doc_no: number;
        status: string;
        submitted_at: string | null;
        shop: { name: string } | null;
        attachments: Attachment[];
    };

    let {
        filters,
        printJob,
    }: {
        filters: { doc_no?: string };
        printJob: PrintJob | null;
    } = $props();

    let docNo = $state(filters?.doc_no ?? '');

    const hasSearch = $derived((filters?.doc_no ?? '').trim().length > 0);

    const submitSearch = (event: Event) => {
        event.preventDefault();

        if (!/^\d{6}$/.test(docNo)) {
            return;
        }

        router.get(
            '/print',
            { doc_no: docNo },
            {
                preserveState: true,
                replace: true,
            },
        );
    };

    const clearSearch = () => {
        docNo = '';
        router.get('/print', {}, { replace: true });
    };

    const handleDocNoInput = (event: Event) => {
        const input = event.target as HTMLInputElement;
        docNo = input.value.replace(/\D/g, '').slice(0, 6);
    };

    const formatFileSize = (bytes: number): string => {
        if (bytes < 1024) {
            return `${bytes} B`;
        }

        if (bytes < 1024 * 1024) {
            return `${(bytes / 1024).toFixed(1)} KB`;
        }

        return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
    };
</script>

<AppHead title="Find Your Documents" />

<div data-theme="printsecure" class="min-h-screen bg-gradient-to-b from-slate-50 to-white">
    <header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/80 px-4 py-3 backdrop-blur-xl">
        <div class="mx-auto flex max-w-2xl items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#2ecc71] to-[#27ae60] shadow-md">
                <Printer class="h-5 w-5 text-white" />
            </div>
            <div>
                <p class="text-sm text-slate-500">Public Document Finder</p>
                <h1 class="text-lg font-bold text-slate-800">PrintSecure</h1>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-2xl px-4 py-8">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#2ecc71]/10">
                    <FileSearch class="h-5 w-5 text-[#2ecc71]" />
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Find Documents By Number</h2>
                    <p class="text-sm text-slate-600">Enter your document number to find uploaded files.</p>
                </div>
            </div>

            <form onsubmit={submitSearch} class="flex flex-col gap-3 sm:flex-row">
                <label class="sr-only" for="doc_no">Document Number</label>
                <input
                    id="doc_no"
                    type="text"
                    bind:value={docNo}
                    inputmode="numeric"
                    pattern="[0-9]{6}"
                    minlength="6"
                    maxlength="6"
                    oninput={handleDocNoInput}
                    placeholder="Enter document number"
                    class="input input-bordered w-full border-slate-300 focus:border-[#2ecc71] focus:outline-none"
                    required
                />
                <button type="submit" class="btn gap-2 border-none bg-[#2ecc71] text-white hover:bg-[#27ae60]">
                    <Search class="h-4 w-4" />
                    Search
                </button>
            </form>

            <div class="mt-3 flex items-center gap-2 text-xs text-slate-500">
                <Shield class="h-4 w-4 text-[#2ecc71]" />
                Search only returns active, non-removed documents.
            </div>
        </section>

        {#if hasSearch && printJob}
            <section class="mt-6 rounded-2xl border border-[#2ecc71]/30 bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm text-slate-500">Document Number</p>
                        <p class="text-2xl font-bold text-slate-900">{printJob.doc_no}</p>
                    </div>
                    <span class="rounded-full bg-[#2ecc71]/10 px-3 py-1 text-xs font-semibold uppercase text-[#27ae60]">
                        {printJob.status}
                    </span>
                </div>

                <div class="grid gap-3 text-sm text-slate-700 sm:grid-cols-2">
                    <div>
                        <p class="text-slate-500">Shop</p>
                        <p class="font-medium">{printJob.shop?.name ?? 'N/A'}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Uploaded At</p>
                        <p class="font-medium">{printJob.submitted_at ?? 'N/A'}</p>
                    </div>
                </div>

                <div class="mt-5">
                    <h3 class="mb-2 text-sm font-semibold text-slate-800">Files</h3>
                    <ul class="space-y-2">
                        {#each printJob.attachments as file}
                            <li class="flex items-center justify-between gap-3 rounded-lg border border-slate-200 px-3 py-2">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-medium text-slate-800">{file.filename}</p>
                                    <p class="text-xs text-slate-500">{file.filetype} · {formatFileSize(file.filesize)}</p>
                                </div>
                                <a href={file.url} target="_blank" rel="noreferrer" class="btn btn-sm border-none bg-[#2ecc71]/10 text-[#27ae60] hover:bg-[#2ecc71]/20">
                                    View
                                </a>
                            </li>
                        {/each}
                    </ul>
                </div>
            </section>
        {:else if hasSearch && !printJob}
            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-5 text-center shadow-sm sm:p-6">
                <p class="text-lg font-semibold text-slate-800">No documents found</p>
                <p class="mt-1 text-sm text-slate-600">No active print job exists for this document number.</p>
                <button onclick={clearSearch} class="btn btn-sm mt-4 border-none bg-[#2ecc71]/10 text-[#27ae60] hover:bg-[#2ecc71]/20">
                    Clear Search
                </button>
            </section>
        {/if}
    </main>
</div>
