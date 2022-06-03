<template>
  <main class="container">
    <section class="container-left">
      <article class="logo-img">
        <img
          src="@/assets/logo_login.png"
          alt="Clube Full-Stack"
        >
      </article>

      <article class="logo-text">
        <h3>Seja bem vindo ao</h3>
        <h1>Clube Full-Stack</h1>
      </article>
    </section>

    <section class="container-right">
      <h1>Faça seu login</h1>

      <template v-if="loading">
        <span class="text-loading">Aguarde, estamos fazendo o login</span>
      </template>

      <template v-if="errorLogin">
        <span class="text-error-login">Ocorreu um erro ao fazer o login, tente novamente em alguns segundos.</span>
      </template>

      <form
        class="form-login"
        @submit.prevent="login"
      >
        <div>
          <label>Usuário:</label>
          <input
            v-model="email"
            type="text"
            name="email"
            placeholder="Ex.: usuarioteste"
            class="input input-dark"
          >
        </div>
        <div id="passwordContainer">
          <label>Senha:</label>
          <input
            id="password"
            v-model="password"
            name="password"
            type="password"
            placeholder="Ex.: senhateste"
            class="input input-dark"
          >
          <i
            data-feather="eye-off"
            class="iconFeather"
          />
        </div>
        <button class="btn btn-login">
          Entrar
        </button>
      </form>
    </section>
  </main>
</template>

<script setup>

import http from "@/services/http";
import {useRouter} from "vue-router";

import {ref} from "vue";

const router = useRouter();

// eslint-disable-next-line no-unused-vars
const email = ref("salazar.horacio@hotmail.com");
// eslint-disable-next-line no-unused-vars
const password = ref("123");
// eslint-disable-next-line no-unused-vars
const loading = ref(false);
// eslint-disable-next-line no-unused-vars
const errorLogin = ref(false);

// eslint-disable-next-line no-unused-vars
async function login(){
  try {
    loading.value = true;
    const {data} = await http.post("/login",{
      email: email.value,
      password:password.value
    });

    if(data === "loggedIn"){
      loading.value = false;
      router.push("/admin");
    }else{
      loading.value = false;
      errorLogin.value = true;
    }

    setTimeout(() => {
      errorLogin.value = false;
    },3000);

    console.log(data);
  } catch (error) {
    errorLogin.value = true;
    loading.value = false;

    setTimeout(() => {
      errorLogin.value = false;
    },3000);

    console.log(error);
  }
}

</script>

<style>
@import "@/assets/global.css";
</style>