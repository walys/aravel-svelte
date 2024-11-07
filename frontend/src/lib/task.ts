import { getUser } from '$lib/auth.js';

export async function fetchItemsTasks() {
    let users: any[] = getUser();
    let token: any[] = users.token;
    try {
        const response = await fetch('http://localhost:8000/api/V1/task', {
            method: 'GET',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                Authorization: "Bearer "+token,
            },
        }); 

        if (!response.ok) {
            throw new Error('Erro ao buscar itens da API');
        }

        const data = await response.json();
        // console.log(data);
        return data.data;
        // items = data.data; // Ajuste conforme a estrutura da sua resposta
    } catch (error) {
        console.error('Erro ao buscar itens:', error);
        // errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
    }
}

export async function fetchItemsTasksId(id: any) {
    let users: any[] = getUser();
    let token: any[] = users.token;
    try {
        const response = await fetch(`http://localhost:8000/api/V1/task/${id}`, {
            method: 'GET',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                Authorization: "Bearer "+token,
            },
        }); 

        if (!response.ok) {
            throw new Error('Erro ao buscar itens da API');
        }

        const data = await response.json();
        return data.data;
        // items = data.data; // Ajuste conforme a estrutura da sua resposta
    } catch (error) {
        console.error('Erro ao buscar itens:', error);
        // errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
    }
}

export async function fetchItemsTaskInsert( task_name: string, situation_id: any, description: string, data_task: string, user_id: number){
    let users: any[] = getUser();
    let token: any[] = users.token;
    console.log(task_name, situation_id, description, data_task, user_id);
    console.log(data_task);
    try {
        const response = await fetch(`http://localhost:8000/api/V1/task`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                Authorization: "Bearer "+token,
            },
            body: JSON.stringify({
                user_id:user_id,
                situation_id:situation_id,
                task_name: task_name,
                description: description,
                data_tak: data_task,
              })
        }); 

        if (!response.ok) {
            throw new Error('Erro ao buscar itens da API');
        }
        const data = await response.json();
        return data;
        // items = data.data; // Ajuste conforme a estrutura da sua resposta
    } catch (error) {
        return error;
        // errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
    }
}

export async function fetchItemsTaskUpadte(id: any, task_name: string, situation_id: any, description: string, data_task: string, user_id: number){
    let users: any[] = getUser();
    let token: any[] = users.token;
    // console.log(id, task_name, situation_id, description, data_task, user_id);
    // console.log(data_task);
    try {
        const response = await fetch(`http://localhost:8000/api/V1/task/${id}`, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                Authorization: "Bearer "+token,
            },
            body: JSON.stringify({
                user_id:user_id,
                situation_id:situation_id,
                task_name: task_name,
                description: description,
                data_tak: data_task,
              })
        }); 

        if (!response.ok) {
            throw new Error('Erro ao buscar itens da API');
        }
        const data = await response.json();
        return data;
        // items = data.data; // Ajuste conforme a estrutura da sua resposta
    } catch (error) {
        return error;
        // errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
    }
}

export async function fetchItemsTasksDel(id: any) {
    let users: any[] = getUser();
    let token: any[] = users.token;
    try {
        const response = await fetch(`http://localhost:8000/api/V1/task/${id}`, {
            method: 'DELETE',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                Authorization: "Bearer "+token,
            },
        }); 

        if (!response.ok) {
            throw new Error('Erro ao tentar excluir');
        }
        const data = await response.json();
        console.log(data);
        console.log(data.data);
        return data;
        // items = data.data; // Ajuste conforme a estrutura da sua resposta
    } catch (error) {
        console.error('Erro ao buscar itens:', error);
        // errorMessage = error instanceof Error ? error.message : 'Erro desconhecido ao buscar itens';
    }
}