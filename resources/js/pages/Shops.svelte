<script lang="ts">
    import { QrCode } from '@lucide/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import Pagination from '@/components/Pagination.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { dashboard } from '@/routes';
    import type { BreadcrumbItem } from '@/types';
    import ShowQRModal from './Modals/ShowQRModal.svelte';
    import ShopHandler from './ShopHandler.svelte';
    import { Edit } from 'lucide-svelte';

    let { shops } = $props();
    let selectedShop = $state(null);
    let showCreateShopModal = $state(false);
    let targetView = $state('');

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: dashboard().url,
        },
        {
            title: 'Shops',
            href: '/shops',
        },
    ];

    const showQRCode = (shop: any) => {
        selectedShop = shop;
        targetView = 'showQRCode';
        console.log('Show QR code for shop:', shop);
    };

    const openCreateShopModal = (): void => {
        showCreateShopModal = true;
        targetView = 'shop-handler';
    };

    const closeCreateShopModal = (): void => {
        showCreateShopModal = false;
        selectedShop = null;
        targetView = '';
    };

    const editShop = (shop: any) => {
        selectedShop = shop;
        showCreateShopModal = true;
        targetView = 'shop-handler';
    };
</script>

{#snippet headerActions()}
    <button
        type="button"
        class="btn btn-sm btn-primary gap-2"
        onclick={openCreateShopModal}
    >
        <span class="hidden sm:inline">Add New Shop</span>
        <span class="sm:hidden">Add</span>
    </button>
{/snippet}

<AppHead title="Shops List" />

<AppLayout {breadcrumbs} {headerActions}>
    <div class="h-full overflow-x-auto rounded-xl p-4">
        <div class="overflow-x-auto">
            <table class="table table-zebra table-compact w-full table-sm">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Shop Name</th>
                        <th>Shop Owner</th>
                        <th>Today Stat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {#if shops?.data?.length === 0}
                        <tr>
                            <td colspan="5" class="text-center">
                                No shops found.
                            </td>
                        </tr>
                    {/if}
                    {#each shops?.data || [] as shop, index (shop.id)}
                        <tr>
                            <th>{index + 1}</th>
                            <td>{shop.name}</td>
                            <td class="text-center">
                                <div class="text-lg font-semibold">
                                    {shop.today_print_jobs_count}
                                </div>
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="tooltip btn btn-sm btn-ghost tooltip-left p-2"
                                    data-tip="View Print QR Code"
                                    onclick={() => showQRCode(shop)}
                                >
                                    <QrCode size={18} />
                                </button>
                            </td>
                            <td>
                                <a
                                    href={'#'}
                                    class="tooltip tooltip-left p-2"
                                    data-tip="Edit Shop"
                                    onclick={() => editShop(shop)}
                                >
                                    <Edit size={18} />
                                </a>
                            </td>
                        </tr>
                    {/each}
                    {#if shops?.last_page > 1}
                        <tr>
                            <td colspan={7} class="text-end">
                                <Pagination
                                    links={shops?.links || []}
                                    total={shops?.total || 0}
                                />
                            </td>
                        </tr>
                    {/if}
                </tbody>
            </table>
        </div>
    </div>
</AppLayout>

{#if selectedShop && 'showQRCode' === targetView}
    <ShowQRModal shop={selectedShop} onClose={() => (selectedShop = null)} />
{/if}

{#if showCreateShopModal && 'shop-handler' === targetView}
    <ShopHandler shop={selectedShop} onClose={closeCreateShopModal} />
{/if}
