<script lang="ts">
    import type { Snippet } from 'svelte';
    import AppLayout from '@/layouts/app/AppSidebarLayout.svelte';
    import type { BreadcrumbItem } from '@/types';

    let {
        breadcrumbs = [],
        headerActions,
        headerLinks,
        children,
    }: {
        breadcrumbs?: BreadcrumbItem[];
        headerActions?: Snippet;
        headerLinks?: Snippet;
        children?: Snippet;
    } = $props();
</script>

<AppLayout {breadcrumbs} {headerActions} {headerLinks}>
    {@render children?.()}
</AppLayout>
