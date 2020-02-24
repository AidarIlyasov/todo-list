<template>
    <div class="container">
      <!-- Перенести в копонент профиля -->
        <b-modal id="settings" title="Some user name">
            <div class="form-group">
                <label for="user_name">User name</label>
                <input type="text" id="user_name" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="user_email">Email address</label>
                <input type="email" id="user_email" class="form-control form-control-sm">
                <small class="form-text text-muted">
                    We'll never share your email with anyone else.</small>
            </div>
        </b-modal>
        <!-- Конец Перенести в копонент профиля -->
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="d-flex">
                    <div class="user-profile border border-primary rounded-circle mb-2" @click="profile()">
                        AI
                    </div>
                    <div class="profile-option ml-3">
                        <li
                          class="active"
                          @click="taskCalendar()">
                          Task calendar
                        </li>
                        <li v-b-modal.settings>Settings</li>
                        <hr class="mt-2 mb-1">
                        <li>Log out</li>
                    </div>
                </div>
                <hr class="mt-1 mb-3">
                <!-- boards component -->
                <board></board>
                <!-- today tasks list-->
                <aside-tasks></aside-tasks>
                <!-- task calendar -->
                <task-calendar></task-calendar>
            </div>
            <div class="col-md-9">
              <!-- main section - tasks board -->
              <task-board></task-board>
            </div>
        </div>
    </div>
</template>
<script>
  import {bus} from '../app.js';
  import Profile from './aside/Profile.vue';
  import asideTasks from './aside/AsideTasks.vue';
  import Board from './aside/Board.vue';
  import taskCalendar from './aside/TaskCalendar.vue';
  import taskBoard from './main/TaskBoard.vue';

  export default {
  components: {
    'asideTasks': asideTasks,
    'porfile': Profile,
    'board': Board,
    'taskCalendar': taskCalendar,
    'taskBoard': taskBoard
  },
  data() {
      return {

      }
  },
  mounted() {
      console.log('Component mounted.')
  },
  methods: {
    profile() {
        console.log("Profile");
    },
    taskCalendar(){
      bus.$emit('modal', true);
    }
  }
}

</script>
<style lang="scss">
body {
    background-color: #fff;
}

.add-task {
    color: #3d91cd;
    font-weight: bold;
    text-align: center;
}

.change-view {
    margin: 0 0 0 auto;
}

.card {
    border-radius: 0;
}

.task-title {
    padding: 0.5rem 1rem;
    cursor: pointer;
    position: relative;
    transition: .3s;

    &:hover>.task_title-option {
        display: flex;
    }
}

.task_title-option {
    position: absolute;
    top: 0;
    height: 100%;
    width: 100%;
    left: 0;
    padding: 0 10px;
    display: none;
    background-color: #f8fafc;
}

.task-list {
    padding-left: 10px;

    li {
        list-style: none;
    }
}

.task-body {
    padding: 10px;
}

.task-text {
    margin: 5px 0;
}

.task-footer {
    padding: 5px 10px 5px 20px;
    border-top: solid 1px #3d91cd;
}
#task-calendar{
  height: 60vh;
  overflow-y: scroll;
}
.day, .dt{
  position: relative;
}
.contributor-profile {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    font-size: 12px;
    line-height: 2.2;
    border: solid 2px tomato;
    text-align: center;
    margin-left: -8px;
    background-color: #fff;
    ;
}

.contributor-profile:first-child {
    border: solid 2px green;
}

.user-profile {
    display: flex;
    -ms-align-items: center;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: bold;
    width: 80px;
    height: 80px;
    cursor: pointer;
    /*background: url(./piblic/img/profile.png) no-repeat center / contain;*/
}

.left-menu {
    li {
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

            &>i {
                display: block;
            }
        }

        &>i {
            display: none;
            transition: .3s;
        }

        &.active {
            background-color: #2196F3;
            color: #fff;
        }

        &>i:hover {
            font-size: 20px;
        }
    }
}

.profile-option {
    line-height: 1.3;

    li {
        list-style: none;
        width: 100%;
        cursor: pointer;
        transition: .3s;
        padding: 0 5px;

        &:hover {
            background-color: #dfe0e2;
        }
    }
}

.board-contributors {
    font-size: 16px;
}

.element-outline-primary {
    border: solid 1px #3490dc;
    padding: 0 5px;
    border-radius: 5px;
    cursor: pointer;
    transition: .3s;

    &:hover {
        background: #3490dc;
        color: #fff;
    }
}

// calendar
a:link,
a:active,
a:visited {
    color: #777;
    text-decoration: none;
}

.dt,
.day,
.mo {
    text-align: right;
    width: 55px;
    height: 25px;
}

.day,
.mo {
    font-weight: bold;
    color: #555;
}

.day,
.dt {
    margin-bottom: 5px;
}

.mo {
    margin-bottom: 20px;
}

table,
td {
    border-spacing: 0;
    vertical-align: top;
}

h1 {
    display: inline-block;
    font-size: 4.5em;
    margin: 30px 0 0 40px;
}

h2 {
    margin: 0 0 30px 40px;
}

#cal {
    margin: 0 auto;
    width: 780px;
}

#time {
    float: right;
}

body.night {
    background-color: #111;
    color: #EEE;
}

body.night h1 {
    color: #EEE;
}

body.night .day,
body.night .mo {
    color: #aaa;
}

.task-count {
    background: #aea;
    padding: 0 5px;
    cursor: pointer;
    position: absolute;
    display: inline-block;
}

</style>
