<script lang="ts">
  // import { user } from '$lib/user.js';
  import { login, userStore  } from '$lib/auth.js';
  import { onMount } from 'svelte';
  import { goto } from '$app/navigation';
 
    let email: string = '';
    let password: string = '';
    let error: string = '';
    let emailError: string = '';
    let passwordError: string = '';
    let isLoading: boolean = false;
    let tokenExists: boolean = false;
   
    onMount(() => {
          tokenExists = localStorage.length > 0;
          if(tokenExists){
            const token = localStorage.getItem('token');
            console.log('Token encontrado no localStorage.');
            if(token){
              goto('/dashboard');
            }
          }else{
            console.log('Token não encontrado no localStorage.');
          }
    });

    async function handleLogin() {
      if (!email) {
          emailError = 'O campo email é obrigatório.';
      }

      if (!password) {
          passwordError = 'O campo senha é obrigatório.';
      }

      if (emailError || passwordError) {
          return;
      }

      isLoading = true;

      try {
        await login(email, password);
      }catch(error){
        error = 'Login falhou. Verifique suas credenciais.';
      }finally{
        isLoading = false;
      }
    }

</script>

<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <!-- svelte-ignore a11y_img_redundant_alt -->
        <img src="https://preview.colorlib.com/theme/bootstrap/login-form-07/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid"/>
      </div>
      <div class="col-md-6 contents">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="mb-4">
            <h3>Login</h3>
            {#if error}
              <div class="alert alert-danger" role="alert">
                  {error}
              </div>
             {/if}
            <p class="mb-4">Seja bem vindo, espero proporcinar uma boa experiência!</p>
          </div>
          <form on:submit|preventDefault={handleLogin}>
            <div class="form-group first">
              <input type="text" class="form-control" id="email" bind:value={email} placeholder="E-mail">
            </div>
            <br/>
            {#if emailError}
              <div class="alert alert-danger" role="alert">
                  {emailError}
              </div>
             {/if}
            <div class="form-group last mb-4">
              <input type="password" class="form-control" id="password" bind:value={password} placeholder="Senha">
            </div>
            <br/>
            {#if passwordError}
              <div class="alert alert-danger" role="alert">
                  {passwordError}
              </div>
             {/if}
            <button type="submit" class="btn btn-block btn-primary" disabled={isLoading}>
              {#if isLoading}
                  Carregando...
              {:else}
                  Logar
              {/if}
            </button>
            <!-- <input type="submit" value="Logar" class="btn btn-block btn-primary"> -->
          </form>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</div>
<style>
p {
  color: #b3b3b3;
  font-weight: 300; 
}

.content { 
  padding: 7rem 0; 
}

.content .contents {
  width: 50%; 
}
@media (max-width: 1199.98px) {
.content .contents {
width: 100%; } }
.content .contents .form-group{
  overflow: hidden;
  margin-bottom: 0;
  padding: 15px 15px;
  border-bottom: none;
  position: relative;
  background: #edf2f5;
  border-bottom: 1px solid #e6edf1; 
}
.content .contents .form-group input {
  background: transparent; 
}
.content .contents .form-group.first{
  border-top-left-radius: 7px;
  border-top-right-radius: 7px; 
}
.content .contents .form-group.last {
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px; 
}

.content .contents .form-control {
  border: none;
  padding: 0;
  font-size: 20px;
  border-radius: 0; 

}
.content .contents .form-control:active, .content .contents .form-control:focus {
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none; 
}

.content .btn {
  height: 54px;
  padding-left: 30px;
  padding-right: 30px; 
}

</style>
<!-- <form on:submit|preventDefault={login}>
  <input type="email" bind:value={email} placeholder="Email" required />
  <input type="password" bind:value={password} placeholder="Senha" required />
  <button type="submit">Login</button>
</form> -->