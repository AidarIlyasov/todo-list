<template>
  <div>
    <modal v-show="modal">
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
  </div>
</template>
<script>
import Modal from '../Modal.vue';
import {bus} from '../../app.js';
export default {
  components: {
    'modal': Modal,
  },
  data() {
      return {
        modal: false,
        taskModal: false,
        dayOfWeek: [],
        monthDays: [],
        modalTitle: ''
      }
  },
  methods: {
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
    todayDate() {
      let date = new Date();
      return `${date.getDate()} ${date.getMonth()} ${date.getFullYear()}`;
    }
  },
  computed: {

  },
  created(){
    bus.$on('modal', status => {
      this.modal = status;
      this.taskCalendar();
    })
  }
}
</script>
<style>

</style>
