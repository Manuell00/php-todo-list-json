<!-- SCRIPT -->
<script>
// Importo axios
import axios from 'axios';

// Esporto
export default {

  data() {

    return {
      // Definisco una lista sulla quale ciclerò per l todoList
      thingsTodo: [],

      // Definisco il singolo commit da inserire
      commit: {
        todo: "Studiare php",
      }
    };
  },

  methods: {
    onSubmit() {

      // Inserisco l'URL da cui predo i dati php
      const url = 'http://localhost:8888/php-todo-list-json/php/postThings.php';

      // Definisco una variabile che mi indichi il commit che sto inserendo
      const data = this.commit;

      // Definisco il metodo per utilizzare la chiamata POST
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };


      // Eseguo la chimata POST
      axios.post(url, data, headers)
        .then(response => {
          // Callback di successo: la richiesta POST è stata completata con successo

          // Aggiorno la variabile thingsTodo con i dati ricevuti dalla risposta
          this.thingsTodo = response.data;

          // Azzero il commit una volta fatta la richiesta
          this.commit.todo = "";

        })
        // Utilizzo la chiamata per l'errore
        .catch(error => console.error("error", error));
    }
  },

  mounted() {
    // Questo metodo viene chiamato automaticamente dopo che l'istanza del componente è stata montata nel DOM.

    // Eseguo una chiamata GET al server per ottenere i dati iniziali della lista todo
    axios.get('http://localhost:8888/php-todo-list-json/php/index.php')
      .then(response => {
        // Callback di successo: la richiesta GET è stata completata con successo

        // Aggiorno la variabile thingsTodo con i dati ricevuti dalla risposta
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
          {{ thing.todo }}
        </li>
      </ul>

      <!-- Creo una form -->
      <form @submit.prevent="onSubmit">
        <label for="thing">Thing ToDo </label>
        <input type="text" name="thing" id="thing" v-model="commit.todo">
        <br />
        <input type="submit" value="INSERT TODO">
      </form>

    </div>
  </div>
</template>


<!-- STYLE -->
<style></style>