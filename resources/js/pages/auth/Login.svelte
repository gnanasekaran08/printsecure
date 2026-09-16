<script lang="ts">
    import { Form } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import InputError from '@/components/InputError.svelte';
    import TextLink from '@/components/TextLink.svelte';
    import { Button } from '@/components/ui/button';
    import { Checkbox } from '@/components/ui/checkbox';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import { Spinner } from '@/components/ui/spinner';
    import AuthBase from '@/layouts/AuthLayout.svelte';
    import { register } from '@/routes';
    import { store } from '@/routes/login';
    import { request } from '@/routes/password';

    let {
        status = '',
        canResetPassword,
        canRegister,
    }: {
        status?: string;
        canResetPassword: boolean;
        canRegister: boolean;
    } = $props();
</script>

<AppHead title="Log in" />

<AuthBase title="Welcome back" description="Sign in to manage your PrintSecure shop">
    <div class="mb-6 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.14em] text-[#2f8f5b]">
        <span class="h-2 w-2 rounded-full bg-[#3fb56b]"></span>
        Secure shop access
    </div>
    {#if status}
        <div class="mb-4 text-center text-sm font-medium text-green-600">
            {status}
        </div>
    {/if}

    <Form
        {...store.form()}
        resetOnSuccess={['password']}
        class="flex flex-col gap-6"
    >
        {#snippet children({ errors, processing })}
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="h-12 rounded-xl border-[#d7e0d9] bg-[#fbfcfa] focus-visible:ring-[#2f8f5b]"
                    />
                    <InputError message={errors.email} />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        {#if canResetPassword}
                            <TextLink href={request()} class="text-sm">
                                Forgot password?
                            </TextLink>
                        {/if}
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                        class="h-12 rounded-xl border-[#d7e0d9] bg-[#fbfcfa] focus-visible:ring-[#2f8f5b]"
                    />
                    <InputError message={errors.password} />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                        class="mt-4 h-12 w-full rounded-xl bg-[#2f8f5b] font-bold text-white shadow-[0_8px_20px_rgba(47,143,91,0.2)] hover:bg-[#26794b]"
                    disabled={processing}
                    data-test="login-button"
                >
                    {#if processing}<Spinner />{/if}
                    Log in
                </Button>
            </div>

            {#if canRegister}
                <div class="text-center text-sm text-muted-foreground">
                    Don't have an account?
                    <TextLink href={register()}>Sign up</TextLink>
                </div>
            {/if}
        {/snippet}
    </Form>
</AuthBase>
