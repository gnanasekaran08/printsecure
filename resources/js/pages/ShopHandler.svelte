<script lang="ts">
    import { useForm } from '@inertiajs/svelte';
    import Button from '@/components/ui/button/Button.svelte';
    import Input from '@/components/ui/input/Input.svelte';
    import Label from '@/components/ui/label/Label.svelte';

    let { shop: _shop, onClose } = $props();

    const createShop = (event: SubmitEvent): void => {
        event.preventDefault();
        console.log('Create shop action triggered.');
    };

    let form = useForm({
        name: null,
        normal_print_price: 1,
        color_print_price: 2,
        double_sided_print_price: 3,
    });
</script>

<dialog class="modal modal-open">
    <div class="modal-box max-w-md bg-white text-slate-800">
        <h3 class="text-lg font-semibold">Create New Shop</h3>
        <p class="mt-1 text-sm text-base-content/70">
            Enter a name to add the shop.
        </p>

        <form class="mt-5 space-y-4" onsubmit={createShop}>
            <div class="grid gap-2">
                <Label for="shop-name"
                    >Shop Name <span class="text-red-500">*</span></Label
                >
                <input
                    type="text"
                    class="input input-sm w-full"
                    bind:value={form.name}
                    placeholder="Downtown Print Hub"
                    required
                />
            </div>

            <div class="grid gap-2">
                <Label for="normal-print-price"
                    >Normal Print Price <span class="text-red-500">*</span
                    ></Label
                >
                <input
                    id="normal-print-price"
                    name="normal_print_price"
                    type="number"
                    min="0"
                    class="input input-sm w-full"
                    bind:value={form.normal_print_price}
                    placeholder="1"
                    required
                />
            </div>

            <div class="grid gap-2">
                <Label for="color-print-price">Color Print Price</Label>
                <input
                    id="color-print-price"
                    name="color_print_price"
                    type="number"
                    min="0"
                    class="input input-sm w-full"
                    bind:value={form.color_print_price}
                    placeholder="2"
                    required
                />
            </div>

            <div class="grid gap-2">
                <Label for="double-sided-print-price"
                    >Double Sided Print Price</Label
                >
                <input
                    id="double-sided-print-price"
                    name="double_sided_print_price"
                    type="number"
                    min="0"
                    class="input input-sm w-full"
                    bind:value={form.double_sided_print_price}
                    placeholder="3"
                    required
                />
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" class="btn" onclick={onClose}
                    >Cancel</button
                >
                <button
                    type="submit"
                    class="btn btn-primary"
                    onclick={onClose}
                    disabled={$form.processing}
                    >{$form.processing ? 'Creating...' : 'Create Shop'}</button
                >
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button type="button" onclick={onClose}>close</button>
    </form>
</dialog>
