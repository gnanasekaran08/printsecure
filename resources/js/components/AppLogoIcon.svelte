<script lang="ts">
    let {
        class: className = 'w-12',
        ...rest
    }: {
        class?: string;
        [key: string]: unknown;
    } = $props();
</script>

<img src="/favicon.svg" alt="PrintSecure" class={className} {...rest} />
