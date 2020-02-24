<template>
  <div>
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
  export default {
    components: {
      'taskList': taskList,
      'actionButtons': actionButtons
    },
    data(){
      return {

      }
    }
  }
</script>
