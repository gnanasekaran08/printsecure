<script lang="ts">
    import { Form } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import InputError from '@/components/InputError.svelte';
    import TextLink from '@/components/TextLink.svelte';
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import { Spinner } from '@/components/ui/spinner';
    import AuthBase from '@/layouts/AuthLayout.svelte';
    import { login } from '@/routes';
    import { store } from '@/routes/register';
</script>

<AppHead title="Register" />

<AuthBase title="Create your shop account" description="Set up your PrintSecure workspace in a few steps">
    <div class="mb-6 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.14em] text-[#2f8f5b]">
        <span class="h-2 w-2 rounded-full bg-[#3fb56b]"></span>
        Built for local print shops
    </div>
    <Form
        {...store.form()}
        resetOnSuccess={['password', 'password_confirmation']}
        class="flex flex-col gap-6"
    >
        {#snippet children({ errors, processing })}
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Name</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autocomplete="name"
                        name="name"
                        placeholder="Full name"
                        class="h-12 rounded-xl border-[#d7e0d9] bg-[#fbfcfa] focus-visible:ring-[#2f8f5b]"
                    />
                    <InputError message={errors.name} />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        autocomplete="email"
                        name="email"
                        placeholder="email@example.com"
                        class="h-12 rounded-xl border-[#d7e0d9] bg-[#fbfcfa] focus-visible:ring-[#2f8f5b]"
                    />
                    <InputError message={errors.email} />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        name="password"
                        placeholder="Password"
                        class="h-12 rounded-xl border-[#d7e0d9] bg-[#fbfcfa] focus-visible:ring-[#2f8f5b]"
                    />
                    <InputError message={errors.password} />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        name="password_confirmation"
                        placeholder="Confirm password"
                        class="h-12 rounded-xl border-[#d7e0d9] bg-[#fbfcfa] focus-visible:ring-[#2f8f5b]"
                    />
                    <InputError message={errors.password_confirmation} />
                </div>

                <Button
                    type="submit"
                        class="mt-2 h-12 w-full rounded-xl bg-[#2f8f5b] font-bold text-white shadow-[0_8px_20px_rgba(47,143,91,0.2)] hover:bg-[#26794b]"
                    disabled={processing}
                    data-test="register-user-button"
                >
                    {#if processing}<Spinner />{/if}
                    Create account
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <TextLink href={login()} class="underline underline-offset-4">
                    Log in
                </TextLink>
            </div>
        {/snippet}
    </Form>
</AuthBase>
