<template>
    <div class="d-flex">
      <div
        class="card bg-light mt-3 p-0 col-md-4"
        v-for="(task, index) in tasks"  :key="index"
        ref="taskText"
      >
          <div class="card-header task-title">
              <h5 class="card-title mb-0 d-flex justify-content-between">
                {{ task.title }}
                <span class="task-status">
                  <span class="task_status-count">{{ task.comments.length }}</span>
                </span>
              </h5>
              <div class="task_title-option align-items-center justify-content-around">
                  <li><i class="fa fa-pencil-square-o" title="edit task"></i></li>
                  <li><i :class="task.favorite ? 'fa fa-star active' : 'fa fa-star-o'" title="set as favorite"></i></li>
                  <li><i class="fa fa-user-plus" title="appoint a person"></i></li>
                  <li><i class="fa fa-trash-o remove-color" title="remove task"></i></li>
                  <li>
                    <i :class="task.comments.length ? 'fa fa-commenting active' : 'fa fa-comment-o'"></i>
                    <span v-show="task.comments.length" class="action-icon"></span>
                  </li>
              </div>
          </div>
          <div class="card-body task-body">
              <p
                class="task-text"
                @click="editTaskText(index, true)"
                v-show="!task.editable"
              >
                  {{ task.body.text }}
              </p>
              <textarea
                rows="4"
                class="form-control"
                v-show="task.editable"
                v-model="task.body.text"
                ref="test"
                @focusout="saveTaskText(index, false)"
              >
              </textarea>
              <ul class="task-list">
                  <li
                    v-for="(element, number) in task.body.list"
                    :key="number"
                    class="d-flex align-items-center"
                  >
                    <i
                      @click="checkTaskElement(index, number, element.complete)"
                      :class="element.complete ? 'fa fa-check-square-o' : 'fa fa-square-o'"
                    ></i>
                    <span
                      ref="elementName"
                      class="element-name"
                      @click="editTaskElement(number, true)"
                    >{{ element.name }}</span>
                    <input
                      type="text"
                      ref="elementFeild"
                      class="form-control form-control-sm element-field"
                      v-model="task.body.list[number].name"
                      @focusout="editTaskElement(number, false)"
                    >
                  </li>
              </ul>
          </div>
          <div class="task-footer bg-transparent border-primary">
              <div class="d-flex justify-content-between align-items-center">
                  <div class="task-contributors d-flex">
                      <div
                        class="contributor-profile"
                        v-for="(contributor, key) in task.contributors"  :key="key"
                      >
                      {{ getFirstCharactet(contributor) }}
                      </div>
                  </div>
                  <strong>{{ task.completeDate }}</strong>
              </div>
          </div>
      </div>
      <div class="card bg-light mt-3 p-0 col-md-4">
          <button class="btn btn-outline-primary">Add task +</button>
      </div>
    </div>
</template>
<script>
  export default {
    data(){
      return {
        msg: 'Task list here',
        tasks: [
          {
            editable: false,
            title: 'Light card title',
            favorite: true,
            performer: 'Alexandra Ki',
            contributors: ['David Guetta', 'Andrey Balik'],
            completeDate: '15.12.19 23:09',
            taskComplete: false,
            comments: [
              {
                'autor': 'David Guetta',
                'text': 'You can do it'
              }
            ],
            body: {
              text: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
              list: [
                {
                  complete: false,
                  name: 'task one'
                },
                {
                  complete: true,
                  name: 'task two'
                },
                {
                  complete: false,
                  name: 'task three'
                }
              ]
            }
          },
        ]
      }
    },
    methods: {
      editTaskText(taskId, status){
        this.tasks[taskId]['editable'] = status;
        this.$nextTick(function() {
            this.$refs.test[0].focus();
        });
      },
      saveTaskText(taskId, status){
        this.tasks[taskId]['editable'] = status;
      },
      editTaskElement(elementNumber, status){
        this.$refs.elementName[elementNumber].style.display = status ? 'none' : 'block';
        this.$nextTick(function() {
            this.$refs.elementFeild[elementNumber].style.display = status ? 'block' : 'none';
            this.$refs.elementFeild[elementNumber].focus();
        });
      },
      getFirstCharactet(str){
        return str.split(' ').map(word => word[0]).join('').toUpperCase();
      },
      checkTaskElement(taskId, elementNumber, status){
        this.tasks[taskId].body.list[elementNumber]['complete'] = !status;
      }
    }
  }
</script>
<style lang="scss">
  li {
    list-style: none;
  }
  i.active{
    color: #2196F3;
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
      li {
        position: relative;
      }
  }
  .task-list {
      padding-left: 10px;
      li {
          list-style: none;
      }
  }
  .task-body {
      padding: 10px;
      overflow-y: scroll;
      max-height: 200px;
  }
  .task-body{
    scrollbar-width: thin;
    .element-name{
      margin-left: 10px;
    }
    .element-field {
      display: none;
      margin-left: 10px;
    }
  }
  .task-body::-webkit-scrollbar {
    width: 4px;
    height: 4px;
  }
  .task-body::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
  }
  .task-body::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.5);
  }
  .task-text {
      margin: 5px 0;
  }
  .task-footer {
      padding: 5px 10px 5px 20px;
      border-top: solid 1px #3d91cd;
  }
  .task-status{
    position: relative;
    span.task_status-count{
      position: absolute;
      font-size: 11px;
      font-weight: bold;
      border-radius: 50%;
      left: -10px;
      text-align: center;
      min-width: 20px;
      padding: 3px;
      background: tomato;
    }
  }
  .action-icon{
    background-color: tomato;
    border-radius: 50%;
    position: absolute;
    width: 7px;
    right: -5px;
    height: 7px;
  }
</style>
