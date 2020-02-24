<template>
    <div>
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
</template>
<script>
  export default {
    data(){
      return {
        msg: 'Task list here'
      }
    }
  }
</script>
<style>

</style>
