<template>
  <div id="wrapper">
    <h1 class="text-center mb-4">TODO APP</h1>
    <div class="row">
      <div class="col-6">
        <div class="row mt-3">
          <div class="col-12">
            <input v-model="title" type="text" class="form-control" placeholder="type your activity here...">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <textarea v-model="description" placeholder="type details of your activity..." cols="30" rows="10" class="form-control"></textarea>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <button class="btn btn-primary" @click="addNew()">Add new todo</button>
          </div>
        </div>
      </div>
      <div class="col-6">
        <ul class="mt-3">

          <template v-for="todo in todos">

            <li class="todo-item d-flex p-2 justify-content-between m-1 " :class="{'done': todo.is_done}">
              <div class="mt-1 ml-2 text-black">{{todo.title}}</div>
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-outline-dark" @click="viewTodo(todo)">VIEW</button>
                <button v-if="!todo.is_done" type="button" class="btn btn-outline-dark" @click="doneTodo(todo)">DONE</button>
                <button type="button" class="btn btn-outline-dark" @click="deleteTodo(todo)">DELETE</button>
              </div>
            </li>

          </template>

        </ul>
      </div>
    </div>

    <Modal v-if="showModal" @close-modal="showModal = false">
      <template v-slot:header> {{ selectedTodo.title }}</template>
      <template v-slot:body>{{ selectedTodo.description }}</template>
    </Modal>

  </div>

</template>
<script>

  import Modal from './components/ui/Modal.vue'
  import axios from 'axios'
  const baseURL = 'http://127.0.0.1:8000/api'

  export default {
    components: {
      Modal
    },
    data() {
      return {
        todos: [],
        title: '',
        description: '',
        showModal: false,
        selectedTodo: {title: '', description: ''}
      }
    },
    mounted() {
      this.getAll()
    },
    methods: {
      addNew() {
        axios.post(baseURL +'/todos', {title: this.title, description: this.description}).then(() => {
         this.getAll()

         this.title = ''
         this.description = ''

        }, err => {
          console.log(err)
        })
      },
      getAll() {
        axios.get(baseURL +'/todos').then(res => {
          this.todos = res.data
        }, err => {
          console.log(err)
        })
      },
      deleteTodo(id){
        axios.delete(baseURL +'/todo/' + id + '/delete').then(() => {
          this.getAll()
        }, err => {
          console.log(err)
        })
      },
      doneTodo(id){
        axios.put(baseURL +'/todo/' + id + '/done').then(() => {
          this.getAll()
        }, err => {
          console.log(err)
        })
      },
      viewTodo(todo) {
        this.selectedTodo.title = todo.title
        this.selectedTodo.description = todo.description

        this.showModal = true
      }
    }
  }

</script>
<style lang="scss" scoped>

#wrapper {
  width: 100%;
  margin: auto;
}

.todo-item {
  background: cadetblue;
  border-radius: 5px;
}
.done {
  background: white;
  color: #000;
}

</style>
