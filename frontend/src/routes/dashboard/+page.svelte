<script lang="ts">

    import { onMount } from 'svelte';
    import { logout} from '$lib/auth.js';
    import { goto } from '$app/navigation';
    import Navbar from '../../components/Navbar.svelte';
    import Table from '../../components/Table.svelte';

    let user_item;
    let name: string;
   
    function handleLogout() {
       logout();
    }
    onMount(() => {
        user_item = localStorage.getItem('token');
        if (!user_item) {
            goto('/login');
        }else{
            const userData = JSON.parse(user_item);
            name = userData.dataAccessUser[0].name;
        }
    })
    
</script>
<Navbar name={name}/>
<Table/>

