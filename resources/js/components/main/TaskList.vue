<template>
    <div>
      <div
        class="card bg-light mt-3 p-0 col-md-4"
        v-for="(task, index) in tasks"  :key="index"
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
              <p class="task-text">
                  {{ task.body.text }}
              </p>
              <ul class="task-list">
                  <li v-for="(element, number) in task.body.list"  :key="number">
                    <i :class="element.complete ? 'fa fa-check-square-o' : 'fa fa-square-o'"></i>
                    {{ element.name }}
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
                      {{ contributor }}
                      </div>
                  </div>
                  <strong>{{ task.completeDate }}</strong>
              </div>
          </div>
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
