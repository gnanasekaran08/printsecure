<script lang="ts">
    import AppLogoIcon from '@/components/AppLogoIcon.svelte';

    let { class: className = '' }: { class?: string } = $props();
</script>

<AppLogoIcon class={className} />
