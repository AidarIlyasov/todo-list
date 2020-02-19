<template>
  <div>
    <h4 class="d-flex justify-content-between">My boards <span>-</span></h4>
    <ul class="list-group left-menu sm">
        <li v-for="(board,index) in boards"  :key="index">
          <input v-show="board.editable" type="text" v-model="editableText">
          <span v-show="!board.editable">{{ board.name }}</span>
          <i class="fa fa-pencil" v-show="!board.editable" @click="editBoard(index)"></i>
          <i class="fa fa-floppy-o" v-show="board.editable" @click="saveBoard(index)"></i>
        </li>
        <li class="add-task" @click="addBoard()">Add board +</li>
    </ul>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        editableText: '',
        editedText: '',
        boards: [
          {
            'name': 'Cras justo odio',
            'created_at': '21.3.2019'
          },
          {
            'name': 'Dapibus ac facilisis in',
            'created_at': '21.3.2019'
          },
          {
            'name': 'Morbi leo risus',
            'created_at': '21.3.2019'
          },
          {
            'name': 'Porta ac consectetur ac',
            'created_at': '21.3.2019'
          },
          {
            'name': 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores iste perspiciatis iure, voluptate, id blanditiis.',
            'created_at': '21.3.2019'
          }
        ]
      }
    },
    methods: {
      editBoard(index){
        this.editableText = this.boards[index]['name'];
        this.boards.forEach(board => board.editable = false);
        this.$set(this.boards[index], 'editable', true);
        console.log(this.boards[index]['editable']);
      },
      saveBoard(index){
          this.boards[index]['name'] = this.editableText;
          this.boards[index]['editable'] = false;
      }
    }
  }
</script>
<style>

</style>
