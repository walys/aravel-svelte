import { browser } from '$app/environment';
import { user } from '$lib/user.js';
import { writable } from 'svelte/store';
import { goto } from '$app/navigation';

export const userStore = writable(null);

export async function login(email: string, password: string): Promise<any> {
    try {
        const response = await fetch('http://localhost:8000/api/V1/login', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Access-Control-Allow-Origin": "*",
            },
            body: JSON.stringify({ email, password }),
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Erro ao fazer login');
        }

        const res = await response.json();

        if (res.token) {
            // user.set(data);
            userStore.set(res);
            localStorage.setItem('token', JSON.stringify(res));
            // window.location.href = '/dashboard';
            goto('/dashboard');
        } else {
            alert('Login falhou');
        }
    } catch (error) {
        console.error('Erro durante o login:', error);
        alert(error instanceof Error ? error.message : 'Erro desconhecido');
    }
}

function authorized(): any {
    return true;
}

function notAuthorized(): any {
    return false;
}

export function getUser () {
    if (browser) {
        const users = localStorage.getItem('token');
        return users ? JSON.parse(users) : null;
    }
    return null;
}

export function logout(): void {    
    // const token = localStorage.getItem('token');
    // if (token) {
    //     URL_LOGOUT
    // }
    localStorage.clear();
    localStorage.removeItem('token');
    window.location.href = '/login'; 
}

export const checkAuth = () => {
    const token = localStorage.getItem('token');
    console.log(token)
    if (token) {
        return true;
    }
    return false;
};