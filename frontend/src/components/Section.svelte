<script lang="ts">   
  import Modal from './Modal.svelte';
  export let name;

    let childComponent;
    function sendIdForModalComp() {
      console.log('Oi');
        childComponent.sendIdCad(true);
    }
</script>
<main class="container">
    <div class="bg-light p-3 rounded">
      <h2>Seja bem vindo: {name}</h2>
      <p class="lead">Espero que tenha a melhor experiÊcia possível, toda aplicação foi feito exclusivamente para voce!</p>
      <button class="btn btn-lg btn-primary" on:click={sendIdForModalComp}>Nova Tarefa</button>
    </div>
</main>
<Modal bind:this={childComponent}></Modal>