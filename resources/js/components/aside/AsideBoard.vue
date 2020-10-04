<template>
    <div>
        <h4 class="d-flex justify-content-between">My boards <span>-</span></h4>
        <ul class="list-group left-menu sm">
            <li
                v-for="(board, index) in boards"
                :key="index"
                :data-test="board.editable"
                :class="index  === activeBoard ? 'active' : ''"
                @click="selectBoard(board.id, index)"
            >
                <input v-show="board.editable" type="text" v-model="editableText">
                <span v-show="!board.editable">{{ board.title }}</span>
                <i class="fa fa-pencil" v-show="!board.editable" @click="editBoard(index)"></i>
                <i class="fa fa-floppy-o" v-show="board.editable" @click="saveBoard(index)"></i>
            </li>
            <li class="add-task">
                <input type="text" v-show="newBoard" v-model="boardName">
                <i class="fa fa-floppy-o" v-show="newBoard" @click="createBoard()"></i>
                <span v-show="!newBoard" @click="addBoard()">Add board +</span>
            </li>
        </ul>
    </div>
</template>
<script>
    import axios from 'axios'
    import {bus} from "../../app";

    export default {
        data() {
            return {
                editableText: '',
                editedText: '',
                boardName: '',
                newBoard: false,
                boards: [],
                activeBoard: 0
            }
        },
        methods: {
            editBoard(index) {
                this.editableText = this.boards[index]['name'];
                this.boards.forEach(board => board.editable = false);
                this.$set(this.boards[index], 'editable', true);
            },
            saveBoard(index) {
                this.boards[index]['name'] = this.editableText;
                this.$set(this.boards[index], 'editable', false);
            },
            addBoard() {
                this.newBoard = true;
            },
            createBoard() {
                this.newBoard = false;
                let day = new Date();
                this.boards.push({
                    'name': this.boardName,
                    'created_at': `${day.getDate()}.${day.getMonth() + 1}.${day.getFullYear()}`,
                    'editable': false
                });
                this.boardName = '';
            },
            selectBoard(id, index = 0) {
                axios.get('api/boards/' + id).then(response => {
                    bus.$emit('board', response.data);
                    bus.$emit('background', response.data.board.bg_image);
                    this.activeBoard = index;
                    // this.$notify({
                    //     group: 'foo',
                    //     text: 'Board background updated'
                    // });
                })
            }
        },
        created() {
            axios.get('api/boards').then(response => {
                this.boards = response.data.boards;
                this.selectBoard(response.data.boards[0]['id']); // load default first board
            })
        }
    }
</script>
<style>

</style>
