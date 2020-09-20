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
                    <small class="task-autor form-text text-muted mt-1 mb-1">Autor: <span
                        class="element-outline-primary">{{board.author_id}}</span></small>
                    <small class="task-assistant text-muted">Invited:
                        <span class="element-outline-primary">David Guetta <i class="fa fa-close"></i></span>
                        <span class="element-outline-primary">Andrey Balik <i class="fa fa-close"></i></span>
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
            }
        },
        created() {
            let data = [];
            bus.$on('borad', data => {
                this.board = data.board;
                console.log(data.users);
                console.log(data.users[this.board.auhor_id]);
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
