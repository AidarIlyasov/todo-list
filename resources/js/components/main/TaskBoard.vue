<template>
    <div class="pt-4 pb-4 bg-gray">
        <div class="col-md-12">
            <h3>
                <div class="borad-header d-flex align-items-center">
                    <span v-show="!boardEdited" class="mb-1 board-name">{{ board.title }}</span>
                    <input
                        class="board-edit-text mb-1 form-control form-control-sm"
                        v-show="boardEdited"
                        type="text"
                        v-model="boardName">
                    <button
                        class="btn btn-sm btn-outline-primary"
                        v-show="!boardEdited"
                        @click="editBoard()">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button
                        class="btn btn-sm btn-outline-primary"
                        v-show="boardEdited"
                        @click="saveBoard()">
                        <i class="fa fa-floppy-o"></i>
                    </button>
                </div>
                <div class="board-contributors">
                    <small class="task-autor form-text text-muted mt-1 mb-2">Autor: <span
                        class="element-outline-primary">{{board.author}}</span>
                    </small>
                    <small class="task-assistant text-muted py-1">Invited:
                        <span
                            class="element-outline-primary mr-1"
                            v-for="(contributor, index) in board.contributors">
                            {{contributor.name}} <i class="fa fa-close" @click="removeContribut(contributor.id)"></i>
                        </span>
                    </small>
                </div>
            </h3>
        </div>
        <hr>
        <!-- action buttons: filter, invite and more -->
        <action-buttons></action-buttons>
        <!-- task list -->
        <div class="col-md-12">
            <task-list></task-list>
        </div>
    </div>
</template>
<script>
    import taskList from './TaskList.vue';
    import actionButtons from './ActionButtons.vue';
    import {bus} from "../../app";
    import axios from 'axios';

    export default {
        components: {
            'taskList': taskList,
            'actionButtons': actionButtons
        },
        data() {
            return {
                boardName: '',
                boardEdited: false,
                board: {}
            }
        },
        methods: {
            editBoard() {
                console.log();
                this.boardEdited = true;
            },
            saveBoard() {
                this.boardEdited = false;
                this.board.title = this.boardName;
            },
            removeContribut(userId) {
                console.log(userId, this.board.id);
                axios.delete(`api/boards/${this.board.id}/users/${userId}`).then(response => {
                   console.log(response);
                });
            }
        },
        created() {
            let data = [];
            bus.$on('board', data => {
                console.log('Task board component', data);
                const author = data.users.findIndex(user => user.id == data.board.author_id);
                this.board   = data.board;
                this.board.author = data.users[author]['name'];

                data.users.splice(author, 1);
                this.board.contributors = data.users;
            })
        }
    }
</script>
<style lang="scss">
    .board-name {
        display: inline-block;
        margin-right: 10px;
    }

    .board-edit-text {
        height: 30px;
        padding-left: 10px;
        margin-right: 10px;
        max-width: 350px;
        margin-top: 5px;

        &:hover, &:focus {
            outline: none;
            box-shadow: none;
        }
    }
</style>
