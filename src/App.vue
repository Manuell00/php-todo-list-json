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
        todo: "",
      }
    };
  },

  methods: {
    onSubmit() {
      // Inserisco l'URL da cui predo i dati php
      const url = 'http://localhost:8888/php-todo-list-json/php/newElement.php';

      // Definisco una variabile che mi indichi il commit che sto inserendo
      const data = this.commit;

      // Definisco il metodo per utilizzare la chiamata POST
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      // Inseriamo la chiamata axios qui per farla quando premiamo il bottone
      // Eseguo la chimata POST, perchè in questo caso scriviamo
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
    },

    removeItem(index) {
      // Inserisco l'URL da cui predo i dati php
      const url = 'http://localhost:8888/php-todo-list-json/php/removeElement.php';

      // Definisco una variabile che mi indichi il commit che sto inserendo
      const data = this.thingsTodo[index];

      // Definisco il metodo per utilizzare la chiamata POST
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      // Inseriamo la chiamata axios qui per farla quando premiamo il bottone
      // Eseguo la chimata POST, perchè in questo caso scriviamo
      axios.post(url, data, headers)
        .then(response => {
          // Callback di successo: la richiesta POST è stata completata con successo

          // Aggiorno la variabile thingsTodo con i dati ricevuti dalla risposta
          this.thingsTodo = response.data;
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



<template>
  <div class="container-fluid">
    <div class="container text-center">
      <!-- Inserisco il titolo -->
      <h1>Todo List</h1>

      <!-- Creo una lista -->
      <ul>
        <li v-for="(thing, index) in thingsTodo" :key="index">
          {{ thing.todo }} {{ index }}
          <button type="button" class="btn btn-danger" @click="removeItem(index)"><i
              class="fa-solid fa-trash"></i></button>
          <hr>
        </li>
      </ul>

      <!-- Creo una form -->
      <!-- Il prevent evita che si ricarichi la pagina -->
      <form @submit.prevent="onSubmit">
        <div class="insert">
          <div>
            <input type="text" name="thing" id="thing" placeholder="Inserisci elemento..." v-model="commit.todo">
            <button class="btn" type="submit">Inserisci</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>



<!-- STYLE -->
<style lang="scss">
@use './styles/general.scss' as *;

.container-fluid {
  background-color: #202355;
  height: 100vh;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;

  .container {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    width: 30%;
    text-align: center;

    h1 {
      text-transform: uppercase;
      font-size: 45px;
    }

    ul {
      list-style-type: none;
    }

    .insert {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;

      input {
        padding: 5px;
        border-radius: 10px;
      }

      button {
        background-color: #202355;
        border-color: orange;
        color: orange;
      }
    }
  }
}
</style>