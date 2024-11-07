<script lang="ts">
  import { fetchItemsTasksId, fetchItemsTaskUpadte } from '$lib/task.js';
  import { fetchItemSitaution } from '$lib/situation.js';
  import { onMount } from 'svelte';
  
  // import { swalLoad } from '$lib/util.js';

  let showModal:boolean = false;
  let showModalCad:boolean = false;
  let idTask = '';
  let items_task: any[] = [];
  let items_situation: any[] = [];

  let id:number = '';
  let task_name: string= '';
  let data_task: string = '';
  let user_id:number = '';
  let situation_id:number|any = '';
  let description: string = '';
  let mySituation:any = '';

  let isLoading: boolean = false;
  let errorMessages: boolean = false;
  let errorSetMessages: string = '';
  let dateString;


  function formatDate(dateString: { split: (arg0: string) => [any, any, any]; }) {
    const [day, month, year] = dateString.split('/');
    return `${year}-${month}-${day}`; // Formato YYYY-MM-DD
  }

  export async function sendIdCad(valor: any){
      if(valor){
        try{
          items_situation = await fetchItemSitaution();
        }finally{
          openModalCad();
        }
      }
  }

  export async function sendIdTask(valor: any) {
    console.log(valor);
    idTask = valor;

    if(valor){
      try{
        items_situation = await fetchItemSitaution();
      }catch(error){
        alert(`${error.message}  Erro desconhecido ao buscar itens`);
      }

      try {
          items_task = await fetchItemsTasksId(idTask);
          id = items_task.id;
          task_name = items_task.task_name;
          data_task = formatDate(items_task.data_task);
          user_id = items_task.user_id;
          situation_id = items_task.situacao.id;
          description = items_task.description;
          mySituation = items_task.situacao.description;
      } catch (error) {
          errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
        }finally{
          openModal();
        }
    }else{
      idTask = '';
    }
  }
  
  function validateForm(){
    if(!task_name || task_name === "" || task_name === undefined || task_name === null){
      errorMessages = true;
      errorSetMessages = 'Atenção! Campo Tafera é obrigatorio!';
      return false;
    }else if(!situation_id || situation_id === "" || situation_id === undefined || situation_id === null){
      errorMessages = true;
      errorSetMessages = 'Atenção! Campo Situação é obrigatorio!';
      return false;
    }else if(!description || description === "" || description === undefined || description === null){
      errorMessages = true;
      errorSetMessages = 'Atenção! Campo Descrição é obrigatorio!';
      return false;
    }else{
      return true;
    }
  }

  function validateForCad(task_name, situation_id, description){
    console.log('Validate cART', task_name)
    if(!task_name || task_name === "" || task_name === undefined || task_name === null){
      errorMessages = true;
      errorSetMessages = 'Atenção! Campo Tafera é obrigatorio!';
      return false;
    }else if(!situation_id || situation_id === "" || situation_id === undefined || situation_id === null){
      errorMessages = true;
      errorSetMessages = 'Atenção! Campo Situação é obrigatorio!';
      return false;
    }else if(!description || description === "" || description === undefined || description === null){
      errorMessages = true;
      errorSetMessages = 'Atenção! Campo Descrição é obrigatorio!';
      return false;
    }else{
      return true;
    }
  }

  function insertTask() {
    console.log(id, task_name, situation_id, description, data_task, user_id)
    if(validateForCad(task_name, situation_id, description)){
      // try{
      //   isLoading = true;
      //   // console.log(id, task_name, situation_id, description, data_task, user_id);
      //   const responseUp = fetchItemsTaskUpadte(id, task_name, situation_id, description, data_task, user_id);
      //   if(responseUp){
      //     showModal = false;
      //     idTask = '';
      //     alert(responseUp)
      //   }else{
      //     alert('Erro ao atualizar')
      //   }
      // }catch(error){
      //   errorMessages = true;
      //   errorSetMessages = 'Ao deu errado!. Verifique suas credenciais.';
      // }finally{
      //   isLoading = false;
      // }
    }else{
      errorMessages = false;
    }
  }

  function updateTask() {
    console.log(id, task_name, situation_id, description, data_task, user_id)
    if(validateForm()){
      try{
        isLoading = true;
        // console.log(id, task_name, situation_id, description, data_task, user_id);
        const responseUp = fetchItemsTaskUpadte(id, task_name, situation_id, description, data_task, user_id);
        if(responseUp){
          showModal = false;
          idTask = '';
          alert(responseUp)
        }else{
          alert('Erro ao atualizar')
        }
      }catch(error){
        errorMessages = true;
        errorSetMessages = 'Algo deu errado!. Verifique suas credenciais.';
      }finally{
        isLoading = false;
      }
    }else{
      errorMessages = false;
    }
  }

  function closeModal() {
      showModal = false;
      idTask = '';
  }

  function closeModalCad() {
    showModalCad = false;
      idTask = '';
  }
  function openModal() {
      showModal = true;
  }

  function openModalCad() {
      showModalCad = true;
  }
</script>

<div class={`modal fade ${showModal ? 'show' : ''}`} id="myModal" tabindex="-1" aria-hidden="true" style={showModal ? 'display: block;' : 'display: none;'}>
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edição de Tarefa</h5>
              <button type="button" class="btn-close" on:click={closeModal} aria-label="Close"></button>
          </div>
          <from>
            <div class="modal-body">
              <div class="row g-3">
                {#if errorMessages}
                  <div class="alert alert-danger" role="alert">
                      {errorSetMessages}
                  </div>
                {/if}
                  <input type="hidden" id="id" bind:value={id}>
                  <input type="hidden" id="user_id" bind:value={user_id}>
                  <div class="col-md-12">
                    <label for="Tarefa" class="form-label">Titulo da Tarefa</label>
                    <input type="text" 
                        class="form-control" 
                        id="task_name" 
                        name="task_name" 
                        bind:value={task_name}
                    >
                  </div>
                  
                  <div class="col-md-6">
                    <label for="Data" class="form-label">Data</label>
                    <input type="date" class="form-control" id="data_task" name="data_task" bind:value={data_task}>
                  </div>

                  <div class="col-md-6">
                    <label for="Situação" class="form-label">Situação</label>
                    <select 
                        class="form-select" 
                        id="situation_id" 
                        bind:value={situation_id} 
                        aria-label="Selecione uma situação" 
                        >
                      <!-- <option value={situation_id}>{mySituation}</option> -->
                      {#each items_situation as { id, description }}
                          <option value={id}>{description}</option>
                      {/each}
                    </select>
                </div>

                  <div class="col-md-12">
                    <label for="Descrição" class="form-label">Descrição</label>
                    <textarea 
                      class="form-control" 
                      id="description" 
                      name="description"
                      bind:value={description}
                        rows="6"
                    >
                    </textarea>
                  </div>

              </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" on:click={closeModal} disabled={isLoading}>
                  {#if isLoading}
                      Carregando...
                  {:else}
                    Fechar
                  {/if}
                </button>
                <button type="submit" class="btn btn-primary" on:click={updateTask} disabled={isLoading}>
                  {#if isLoading}
                      Carregando...
                  {:else}
                    Alterar
                  {/if}
                </button>
            </div>
          </from>
      </div>
  </div>
</div>   


<div class={`modal fade ${showModalCad ? 'show' : ''}`} id="myModal" tabindex="-1" aria-hidden="true" style={showModalCad ? 'display: block;' : 'display: none;'}>
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Cadastro de Tarefa</h5>
              <button type="button" class="btn-close" on:click={closeModalCad} aria-label="Close"></button>
          </div>
          <from>
            <div class="modal-body">
              <div class="row g-3">
                {#if errorMessages}
                  <div class="alert alert-danger" role="alert">
                      {errorSetMessages}
                  </div>
                {/if}
                  <input type="hidden" id="id" name="id">
                  <input type="hidden" id="user_id" name="user_id" bind:value={user_id}>
                  <div class="col-md-12">
                    <label for="Tarefa" class="form-label">Titulo da Tarefa</label>
                    <input type="text" 
                        class="form-control" 
                        id="task_name" 
                        name="task_name"
                        bind:value={task_name}
                    >
                  </div>
                  
                  <div class="col-md-6">
                    <label for="Data" class="form-label">Data</label>
                    <input type="date" class="form-control" id="data_task" name="data_task" bind:value={data_task}>
                  </div>

                  <div class="col-md-6">
                    <label for="Situação" class="form-label">Situação</label>
                    <select 
                        class="form-select" 
                        id="situation_id" 
                        aria-label="Selecione uma situação" 
                        >
                      <!-- <option value={situation_id}>{mySituation}</option> -->
                      {#each items_situation as { id, description }}
                          <option value={id}>{description}</option>
                      {/each}
                    </select>
                </div>

                  <div class="col-md-12">
                    <label for="Descrição" class="form-label">Descrição</label>
                    <textarea 
                      class="form-control" 
                      id="description" 
                      name="description"
                        rows="6"
                    >
                    </textarea>
                  </div>

              </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" on:click={closeModalCad} disabled={isLoading}>
                  {#if isLoading}
                      Carregando...
                  {:else}
                    Fechar
                  {/if}
                </button>
                <button type="submit" class="btn btn-primary" on:click={insertTask} disabled={isLoading}>
                  {#if isLoading}
                      Carregando...
                  {:else}
                    Salvar
                  {/if}
                </button>
            </div>
          </from>
      </div>
  </div>
</div>   

<style>
  .modal {
      display: none; /* Oculta o modal por padrão */
  }
  .modal.show {
      display: block; /* Exibe o modal quando a classe 'show' é adicionada */
  }
</style>