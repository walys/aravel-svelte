<script lang="ts">
  import { user } from '$lib/user.js';
  import { onMount } from 'svelte';

  let isAuthenticated = false;

  onMount(() => {
      const unsubscribe = user.subscribe(value => {
          isAuthenticated = !!value;
          if (!isAuthenticated) {
              window.location.href = '/login';
          }
      });

      return () => unsubscribe();
  });
</script>

{#if isAuthenticated}
  <slot />
{/if}