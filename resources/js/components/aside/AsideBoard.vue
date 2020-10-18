<template>
    <div>
        <h4 class="d-flex justify-content-between">My boards <span>-</span></h4>
        <ul class="list-group left-menu sm">
            <li
                v-for="(board, index) in boards"
                :key="index"
                :class="index  === activeBoard ? 'active' : ''"
            >
                <input v-show="board.editable" type="text" v-model="editableText">
                <span v-show="!board.editable" @click="selectBoard(board.id, index)">{{ board.title }}</span>
                <i class="fa fa-pencil" v-show="!board.editable" @click="editBoard(index)"></i>
                <i class="fa fa-floppy-o" v-show="board.editable" @click="saveBoard(index)"></i>
            </li>
            <li class="add-task">
                <input type="text" placeholder="new board title" v-show="newBoard" v-model="boardName">
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
                boardName: '',
                newBoard: false,
                boards: [],
                activeBoard: 0
            }
        },
        methods: {
            // при редактирование
            editBoard(index) {
                this.editableText = this.boards[index]['title'];
                this.boards.forEach(board => board.editable = false);
                this.$set(this.boards[index], 'editable', true);
            },
            saveBoard(index) {
                let data = {
                    title: this.editableText
                };
                axios.put('api/boards/' + this.boards[index]['id'], data).then(response => {
                    this.$set(this.boards[index], 'editable', false);
                });
            },
            addBoard() {
                this.newBoard = true;
            },
            createBoard() {
                this.newBoard = false;
                let data = {
                    title: this.boardName
                };
                axios.post('api/boards/', data).then(response => {
                    this.$notify({
                        group: 'foo',
                        title: 'Important message',
                        text: 'You successfully create board ' + data.title
                    });
                    this.boards.push(data);
                });
                this.boardName = '';
            },
            selectBoard(id, index = 0) {
                axios.get('api/boards/' + id).then(response => {
                    bus.$emit('board', response.data);
                    bus.$emit('background', response.data.board.bg_image);
                    this.activeBoard = index;
                })
            },
        },
        created() {
            axios.get('api/boards').then(response => {
                this.boards = response.data;
                console.log('boards ', response.data);
                this.selectBoard(response.data[0]['id']); // load default first board
            })
        }
    }
</script>
<style lang="scss">
    .left-menu li {
        list-style: none;
        border-bottom: solid 1px #3d91cd;
        line-height: 2;
        cursor: pointer;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        padding-right: 5px;
        align-items: center;
        &:hover {
            background-color: #dfe0e2;
            & > i {
                display: flex;
            }
        }
        &.active {
            background-color: #2196F3;
            color: #fff;
        }
        & > i {
            display: none;
            transition: 0.3s;
            width: 35px;
            height: 25px;
            justify-content: center;
            align-items: center;
        }
        & > i:hover {
            font-size: 20px;
        }
        & > span {
            flex-grow: 1;
        }
        & > input {
            width: 85%;
            padding-left: 5px;
        }
        .add-task {
            color: #3d91cd;
            font-weight: bold;
            text-align: center;
        }
    }
</style>
