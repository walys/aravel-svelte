<script lang="ts">
  import Section from "./Section.svelte";
  import { logout} from '$lib/auth.js';
  export let name; 
  function handleLogout() {
       logout();
  }

</script>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <!-- svelte-ignore a11y_invalid_attribute -->
      <a class="navbar-brand" href="#">Test Pratice </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
        </ul>
        <form class="d-flex">
          <button class="btn btn-success" on:click={handleLogout}>Sair</button>
        </form>
      </div>
    </div>
  </nav>
    <Section name={name}/>
<style>

</style>