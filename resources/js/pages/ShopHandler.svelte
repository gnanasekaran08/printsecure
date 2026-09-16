<script lang="ts">
    import Button from '@/components/ui/button/Button.svelte';
    import Input from '@/components/ui/input/Input.svelte';
    import Label from '@/components/ui/label/Label.svelte';

    let { shop } = $props();

    const createShop = (event: SubmitEvent): void => {
        event.preventDefault();
        console.log('Create shop action triggered.');
    };
</script>

<dialog class="modal modal-open">
    <div class="modal-box max-w-md">
        <h3 class="text-lg font-semibold">Create New Shop</h3>
        <p class="mt-1 text-sm text-base-content/70">
            Enter a name to add the shop.
        </p>

        <form class="mt-5 space-y-4" onsubmit={createShop}>
            <div class="grid gap-2">
                <Label for="shop-name">Shop Name</Label>
                <Input
                    id="shop-name"
                    name="name"
                    value={shop?.name}
                    oninput={(event) =>
                        (shop.name = (
                            event.currentTarget as HTMLInputElement
                        ).value)}
                    placeholder="Downtown Print Hub"
                    required
                />
                <InputError message={shopNameError} />
            </div>

            {#if createShopNote}
                <div class="alert alert-info text-sm">{createShopNote}</div>
            {/if}

            <div class="flex justify-end gap-2 pt-2">
                <button
                    type="button"
                    class="btn btn-ghost"
                    onclick={closeCreateShopModal}>Cancel</button
                >
                <Button type="submit">Create Shop</Button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button type="button" onclick={closeCreateShopModal}>close</button>
    </form>
</dialog>
