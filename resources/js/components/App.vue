<template>
    <div class="container">
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
        <!-- add-task -->
        <add-task :taskModal="taskModal" @close="close"></add-task>
        <!-- Начало. Перенести в компонент -->
        <modal v-show="isModalVisible" @close="close">
        <template v-slot:header>
          <h5> {{ modalTitle }} </h5>
        </template>
        <template v-slot:body>
        <div id="task-calendar">
          <table>
            <tbody>
              <tr>
                <td>
                    <div class="day mo"></div>
                    <div class="day" v-for="(day, key) in dayOfWeek">{{ day }}</div>
                </td>
                <td>
                  <table id="months">
                    <tbody>
                      <tr id="mtoprow">
                        <td class="mc" valign="top" v-for="(month, key) in monthDays">
                          <span :id="'p' + key">
                            <div class="months">
                                <div class="mo"> {{ month.name }} </div>
                                <div class="dt" v-for="offset in month.offset"></div>
                                <div class="dt" v-for="(day, index) in month.days" :data-month="key" :data-day="index">{{ day }}
                                  <small v-for="item in month.tasks.day" class="task-count">
                                    <i v-if="item.date == day">{{ item.count}}</i>
                                  </small>
                                </div>
                            </div>
                          </span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </template>
        </modal>
        <!-- Конец. Перенести в компонент -->
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="d-flex">
                    <div class="user-profile border border-primary rounded-circle mb-2" @click="profile()">
                        AI
                    </div>
                    <div class="profile-option ml-3">
                        <!-- <li>View profile</li> -->
                        <!-- router link -->
                        <li class="active" @click="taskCalendar()
                        ">Task calendar</li>
                        <li v-b-modal.settings>Settings</li>
                        <hr class="mt-2 mb-1">
                        <li>Log out</li>
                    </div>
                </div>
                <hr class="mt-1 mb-3">
                <!-- boards component -->
                <board></board>
                <!-- today tasks list -->
                <div class="asode-tasks mt-3 mb-3">
                    <h4 class="d-flex justify-content-between">Today tasks <span>+</span></h4>
                    <li class="add-task" @click="addTask()">Add task +</li>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-12">
                    <h3>Dapibus ac facilisis in
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <div class="board-contributors">
                            <small class="task-autor form-text text-muted mt-1 mb-1">Autor: <span class="element-outline-primary">Aidar Ilyasov</span></small>
                            <small class="task-assistant text-muted">Invited:
                                <span class="element-outline-primary">David Guetta <i class="fa fa-close"></i></span>
                                <span class="element-outline-primary">Andrey Balik <i class="fa fa-close"></i></span>
                            </small>
                        </div>
                    </h3>
                </div>
                <hr>
                <div class="col-md-12">
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-star"></i> Favorite</button>
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-lock"></i> Private</button>
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-user-plus"></i> Invite</button>
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-picture-o"></i> Change wallpaper</button>
                    <button class="btn btn-outline-primary btn-sm change-view"><i class="fa fa-bars"></i></button>
                </div>
                <div class="col-md-12">
                    <div class="card bg-light mt-3 p-0 col-md-4">
                        <div class="card-header task-title">
                            <h5 class="card-title mb-0 d-flex justify-content-between">Light card title <span class="contributor-message"><span class="fa fa-comment-o"></span></span></h5>
                            <div class="task_title-option align-items-center justify-content-around">
                                <i class="fa fa-pencil-square-o" title="edit task"></i>
                                <i class="fa fa-star-o" title="set as favorite"></i>
                                <i class="fa fa-user-plus" title="appoint a person"></i>
                                <i class="fa fa-trash-o" title="remove task"></i>
                            </div>
                        </div>
                        <div class="card-body task-body">
                            <p class="task-text">
                                Some quick example text to build on the
                                card title and make up the bulk of the card's content.
                            </p>
                            <ul class="task-list">
                                <li><i class="fa fa-square-o"></i> task one</li>
                                <li><i class="fa fa-check-square-o"></i> task two</li>
                                <li><i class="fa fa-square-o"></i> task three</li>
                            </ul>
                        </div>
                        <div class="task-footer bg-transparent border-primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="task-contributors d-flex">
                                    <div class="contributor-profile">DG</div>
                                    <div class="contributor-profile">AB</div>
                                </div>
                                <strong>15.12.19 23:09</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import Modal from './Modal.vue';
  import Profile from './Profile.vue';
  import AddTask from './AddTask.vue';
  import Board from './Board.vue';
  export default {
  components: {
    'modal': Modal,
    'addTask': AddTask,
    'porfile': Profile,
    'board': Board
  },
  data() {
      return {
        isModalVisible: false,
        taskModal: false,
        dayOfWeek: [],
        monthDays: [],
        modalTitle: ''
      }
  },
  mounted() {
      console.log('Component mounted.')
  },
  methods: {
    profile() {
        console.log("Profile");
    },
    taskCalendar(year = '2019') {
      let dyasName = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
      let monthName = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      let firstDayName = 6;
      let lastDayName = 0;

      for (var i = 0; i < 12; i++) {
          let day = new Date(year, i).getDay();
          let tasks = {
              'month': i,
              'day': [{
                      'date': Math.floor(Math.random() * (31 - 1) + 1),
                      'count': Math.floor(Math.random() * (10 - 1) + 1)
                  },
                  {
                      'date': Math.floor(Math.random() * (31 - 1) + 1),
                      'count': Math.floor(Math.random() * (10 - 1) + 1)
                  },
                  {
                      'date': Math.floor(Math.random() * (31 - 1) + 1),
                      'count': Math.floor(Math.random() * (10 - 1) + 1)
                  }
              ],
          };
          lastDayName = lastDayName < day ? day : lastDayName;
          firstDayName = firstDayName > day ? day : firstDayName;

          this.monthDays.push({
              'name': monthName[i],
              'offset': day,
              'days': new Date(year, i, 0).getDate(),
              'tasks': tasks
          });

          this.monthDays[0] = {

          }
      }

      let index = firstDayName;
      let k = 0;

      while (index < +lastDayName + 31) {
          if (dyasName[k] == undefined) {
              k = 1;
          }
          this.dayOfWeek.push(dyasName[k]);
          k++;
          index++;
      }
      this.isModalVisible = true;
      this.modalTitle = `Today is ${this.todayDate()}`;
    },
    showModal() {
      this.isModalVisible = true;
    },
    close(status) {
      console.log(status);
      this.isModalVisible = status;
      this.taskModal = status;
    },
    addTask() {
      this.taskModal = true;
    },
    todayDate() {
      let date = new Date();
      return `${date.getDate()} ${date.getMonth()} ${date.getFullYear()}`;
    }
  },
  computed: {
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
