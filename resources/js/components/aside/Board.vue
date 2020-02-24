<template>
  <div>
    <h4 class="d-flex justify-content-between">My boards <span>-</span></h4>
    <ul class="list-group left-menu sm">
        <li
          v-for="(board,index) in boards"
          :key="index"
          :data-test="board.editable"
          :class="index == 1 ? 'active' : ''"
          >
          <input v-show="board.editable" type="text" v-model="editableText">
          <span v-show="!board.editable">{{ board.name }}</span>
          <i class="fa fa-pencil" v-show="!board.editable" @click="editBoard(index)"></i>
          <i class="fa fa-floppy-o" v-show="board.editable" @click="saveBoard(index)"></i>
        </li>
        <li class="add-task">
          <input type="text" v-show="newBoard" v-model="boardName">
          <i class="fa fa-floppy-o" v-show="newBoard" @click="createBoard()"></i>
          <span  v-show="!newBoard" @click="addBoard()">Add board +</span>
        </li>
    </ul>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        editableText: '',
        editedText: '',
        boardName: '',
        newBoard: false,
        boards: [
          {
            'name': 'Cras justo odio',
            'created_at': '21.3.2019',
            'editable': false
          },
          {
            'name': 'Dapibus ac facilisis in',
            'created_at': '21.3.2019',
            'editable': false
          },
          {
            'name': 'Morbi leo risus',
            'created_at': '21.3.2019',
            'editable': false
          },
          {
            'name': 'Porta ac consectetur ac',
            'created_at': '21.3.2019',
            'editable': false
          },
          {
            'name': 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores iste perspiciatis iure, voluptate, id blanditiis.',
            'created_at': '21.3.2019',
            'editable' : false
          }
        ]
      }
    },
    methods: {
      editBoard(index){
        this.editableText = this.boards[index]['name'];
        this.boards.forEach(board => board.editable = false);
        this.$set(this.boards[index], 'editable', true);
      },
      saveBoard(index){
          this.boards[index]['name'] = this.editableText;
          this.$set(this.boards[index], 'editable', false);
      },
      addBoard(){
        this.newBoard = true;
      },
      createBoard(){
        this.newBoard = false;
        let day = new Date();
        this.boards.push({
          'name': this.boardName,
          'created_at': `${day.getDate()}.${day.getMonth() + 1}.${day.getFullYear()}`,
          'editable': false
        });
        this.boardName = '';
      }
    }
  }
</script>
<style>

</style>
