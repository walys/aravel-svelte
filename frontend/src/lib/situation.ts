import { getUser } from '$lib/auth.js';

export async function fetchItemSitaution() {
    let users: any[] = getUser();
    let token: any[] = users.token;
    try {
        const response = await fetch(`http://localhost:8000/api/V1/situation`, {
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
    } catch (error) {
        console.error('Erro ao buscar itens:', error);
    }
}