<template>
    <div>
      <div class="col-md-12">
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-star"></i> Favorite</button>
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-lock"></i> Private</button>
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-user-plus"></i> Invite</button>
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-picture-o"></i> Change wallpaper</button>
          <button class="btn btn-outline-primary btn-sm change-view"><i class="fa fa-bars"></i> Change view</button>
      </div>
    </div>
</template>
<script>
  export default {
    data(){
      return {
        msg: 'Action buttons'
      }
    }
  }
</script>
<style>

</style>
