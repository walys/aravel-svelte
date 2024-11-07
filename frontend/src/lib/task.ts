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