<script lang="ts">
    import type { Snippet } from 'svelte';
    import AppContent from '@/components/AppContent.svelte';
    import AppShell from '@/components/AppShell.svelte';
    import AppSidebar from '@/components/AppSidebar.svelte';
    import AppSidebarHeader from '@/components/AppSidebarHeader.svelte';
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

<AppShell variant="sidebar">
    <AppSidebar />
    <AppContent variant="sidebar" class="overflow-x-hidden">
        <AppSidebarHeader {breadcrumbs} {headerActions} {headerLinks} />
        {@render children?.()}
    </AppContent>
</AppShell>
