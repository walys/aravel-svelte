<script lang="ts">   
import jQuery from 'jquery';
import DataTable from 'datatables.net';
import { onMount } from 'svelte';
import { fetchItemsTasks, fetchItemsTasksDel} from '$lib/task.js';
import { languageSettings } from '$lib/util.js';
import Modal from './Modal.svelte';

let items: any[] = [];
let errorMessage: string | null = null; 
let loading: boolean = true;
let ValueIdTask:any = null;
    onMount(async () => {
        try {
            items = await fetchItemsTasks();

            jQuery('#myTableTask').DataTable({
                data: items,
                columns: [
                    {data: 'task_name',
                    render: function(data: { id: any; }, type: any, row: any) {
                            return `${data}`;
                        }
                    },
                    {data: 'situacao',
                        render: function(data: {color: any; description: any;  }, type: any, row: any) 
                        {
                        return `<span class="badge bg" style="background-color:${data.color}; font-size: 15px;">${data.description}</span>`; // Retorna a descrição da situação
                        }
                    },
                    { title: 'Data', data: 'data_task'},
                    { title: 'Exclir',
                        data: null, 
                        render: function(data: any, type: any, row: { id: any; }) {
                        return `
                            <button class="btn btn-danger delete-btn" data-id="${row["id"]}"><box-icon type='solid' name='trash'></box-icon></button>`;
                        }
                    }
                ],
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                ordering: false,
                language: languageSettings,
                searching: true
            });

            if (jQuery.fn.dataTable.isDataTable('#myTable')){
                jQuery('#myTableTask').DataTable().destroy(); // Destrói a instância existente
            }
            
            jQuery('#myTableTask tbody').on('click', 'tr', function(event: { target: any; }) {
                if (jQuery(event.target).closest('.edit-btn, .delete-btn').length === 0) {
                    var data = jQuery('#myTableTask').DataTable().row(this).data(); // Obtém os dados da linha clicada
                    // Execute a função desejada aqui
                    if (data) {
                        // Exemplo de função: exibir um alerta com o ID
                        // console.log(`Você clicou na linha com ID: ${data['id '] ? data['id '] : data.id}`);
                        const idEditTask = data['id '] ? data['id '] : data.id;
                        try {
                            sendIdForModalComp(idEditTask);    
                        } catch (error) {
                            errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
                        }
                    }
                }
            });

            // Prevenindo o redirecionamento ao clicar nos botões
            jQuery('#myTableTask').on('click', '.btn, delete-btn', async function(event: { stopPropagation: () => void; }) {
                event.stopPropagation(); // Impede que o clique na linha seja disparado
                var target = jQuery(event.target);
                if (target.index() === 3) { // 2 é o índice da coluna "Situação"
                    event.stopPropagation(); // Impede o evento de clique na linha
                    return; // Não faz nada se a coluna "Situação" for clicada
                }
                var btnDelete = jQuery(this).data('id'); // Obtém o ID do botão clicado
                // Aqui você pode adicionar a lógica para o botão, como editar ou excluir
                if (jQuery(this).hasClass('delete-btn')) {
                    alert(`Botão delete clicado para ID: ${btnDelete}`);
                    const respDel = await fetchItemsTasksDel(btnDelete);
                    if(respDel.status != 200){
                        alert(respDel.data.message	);
                    }else{
                        alert(respDel.data.message);
                        window.location.reload();
                    }
                }
            });
        } catch (error) {
            errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
        }finally{
            loading = false;
            
        }
    });

    

    let childComponent;
    function sendIdForModalComp(idEditTask) {
        childComponent.sendIdTask(idEditTask);
    }

</script>
<!-- <button class="btn btn-primary" on:click={handleOpenModal}>Abrir Modal</button> -->
<div class="container">
    <table id="myTableTask" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Tarefa</th>
                <th>Situação</th>
                <th>Situação</th>
                <th>Exclir</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<Modal bind:this={childComponent}></Modal>
 <style>

 </style>