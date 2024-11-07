<script lang="ts">
  import { fetchItemsTasksId,  } from '$lib/task.js';
  import { fetchItemSitaution } from '$lib/situation.js';
  
  import { swalLoad } from '$lib/util.js';

  let showModal:boolean = false;
  let idTask = '';
  let items_task: any[] = [];
  let items_situation: any[] = [];
  let errorMessage: string | null = null;

  let options:any = [];
  let id: any = null;
  let task_name: string= '';
  let data_task: string = '';
  let user_id:any = '';
  let situation_id:any = '';
  let description: string = '';

  export async function sendIdTask(valor: string) {
    idTask = valor;

    if(valor){
      try{
        items_situation = await fetchItemSitaution();
        console.log('minha situações', items_situation);
      }catch(error){
        console.log('minha situações', options);
        // alert(`${error.message}  Erro desconhecido ao buscar itens`);
      }finally{
        swalLoad();
      }

      try {
          items_task = await fetchItemsTasksId(idTask);
          id = items_task.id;
          task_name = items_task.task_name;
          data_task = items_task.data_task;
          user_id = items_task.user_id;
          situation_id = items_task.situation_id;
          console.log(situation_id);
          description = items_task.description;
        } catch (error) {
          errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
        }finally{
          swalLoad();
          openModal();
        }
    }else{
      idTask = '';
    }
  }
  
  function closeModal() {
      showModal = false;
      idTask = '';
  }

  function openModal() {
      showModal = true;
  }
</script>

<div class={`modal fade ${showModal ? 'show' : ''}`} id="myModal" tabindex="-1" aria-hidden="true" style={showModal ? 'display: block;' : 'display: none;'}>
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edição de Tarefa</h5>
              <button type="button" class="btn-close" on:click={closeModal} aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <from class="row g-3">
                <input type="hidden" id="user_id" name="user_id " bind:value={user_id}>
                <div class="col-md-12">
                  <label for="inputEmail4" class="form-label">Titulo da Tarefa</label>
                  <input type="email" class="form-control" id="task_name" name="task_name" bind:value={task_name}>
                </div>

                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">Data</label>
                  <input type="date" class="form-control" id="data_task" name="data_task" bind:value={data_task}>
                </div>

                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">Situação</label>
                  <select class="form-select" id="situation_id" bind:value={situation_id} aria-label="Selecione uma situação">
                    {#each items_situation as { id, description }}
                        <option value={id}>{description}</option>
                    {/each}
                  </select>
              </div>

                <div class="col-md-12">
                  <label for="inputEmail4" class="form-label">Descrição</label>
                  <textarea class="form-control" id="description" name="description" bind:value={description} rows="6"></textarea>
                </div>

              </from>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" on:click={closeModal}>Fechar</button>
              <button type="button" class="btn btn-primary">Salvar mudanças</button>
          </div>
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