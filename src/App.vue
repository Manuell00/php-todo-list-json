<!-- SCRIPT -->
<script>
// Importo axios
import axios from 'axios';

// Esporto
export default {

  // Inserisco i dati
  data() {

    return {
      // Definisco una lista sulla quale ciclerò per l todoList
      thingsTodo: [],

      // Definisco il singolo commit da inserire
      commit: "",
    };
  },

  // Inserisco i metodi
  methods: {
    onSubmit() {

      // Inserisco l'URL da cui predo i dati php
      const url = 'http://localhost:8888//php-todo-list-json/php/postThings.php';

      // Definisco una variabile che mi indichi il commit che sto inserendo
      const data = this.commit;

      // Definisco il metodo per utilizzare la chiamata POST
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };


      // Eseguo la chimata POST
      axios.post(url, data, headers)
        .then(response => {


          this.thingsTodo = response.data;

          // Azzero il commit una volta fatta la richiesta
          this.commit = "";

        })
        // Utilizzo la cgiamata per l'errore
        .catch(error => console.error("error", error));
    }
  },

  mounted() {
    axios.get('http://localhost:8888//php-todo-list-json/php/index.php')
      .then(response => {
        this.thingsTodo = response.data;
      });
  }
}
</script>


<!-- TEMPLATE -->
<template>
  <div class="container-fluid">
    <div class="container text-center">

      <!-- Inserisco il titolo -->
      <h1>Todo List</h1>

      <!-- Creo una lista -->
      <ul>
        <li v-for="(thing, index) in thingsTodo" :key="index">
          {{ thing }}
        </li>
      </ul>

      <!-- Creo una form -->
      <form @submit.prevent="onSubmit">
        <label for="name">Thing ToDo </label>
        <input type="text" name="thing" id="thing" v-model="commit">
        <br />
        <input type="submit" value="INSERT TODO">
      </form>

    </div>
  </div>
</template>


<!-- STYLE -->
<style></style>