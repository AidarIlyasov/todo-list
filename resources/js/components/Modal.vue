<template>
  <transition name="modal-fade">
    <div class="modal-backdrop">
      <div class="modal container">
        <header class="modal-header">
          <slot name="header">
            This is the default tile!
          </slot>
          <button type="button" @click="close" class="close">×</button>
        </header>
        <section class="modal-body">
          <slot name="body">
            I'm the default body!
          </slot>
         </section>
         <footer class="modal-footer">
            <slot name="footer">
          </slot>
        </footer>
      </div>
    </div>
  </transition>  
</template>
<script>
  export default {
    methods: {
      close() {
        this.$emit('close');
      },
    },
  };
</script>
<style scoped>
  .modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,.5);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 1;
  }

  .modal {
    background-color: #fff;
    border: solid 1px #333;
    display: block;
    margin: 15px auto;
    right: 0;
    height: initial;
    border-radius: 5px;
  }

  .modal-header,
  .modal-footer {
    padding: 15px;
    display: flex;
  }

  .modal-header {
    justify-content: space-between;
  }

  .modal-footer {
    border-top: 1px solid #eeeeee;
    justify-content: flex-end;
  }

  .modal-body {
    position: relative;
    padding: 20px 10px;
  }
  button.close{
    outline: none;
  }
  .modal-fade-enter,
  .modal-fade-leave-active {
    opacity: 0;
  }

  .modal-fade-enter-active,
  .modal-fade-leave-active {
    transition: opacity .5s ease
  }
</style>