<template>
    <div>
      <div class="col-md-12">
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-star"></i> Favorite</button>
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-lock"></i> Private</button>
          <button class="btn btn-outline-primary btn-sm"><i class="fa fa-user-plus"></i> Invite</button>
          <button class="btn btn-outline-primary btn-sm" @click="changeWallpaper()"><i class="fa fa-picture-o"></i> Change wallpaper</button>
          <button class="btn btn-outline-primary btn-sm change-view"><i class="fa fa-bars"></i> Change view</button>
      </div>
      <!-- modals -->
      <modal
        v-show="wallpaperModal"
        @close="closeModal()"
      >
        <template v-slot:header>
          <h5> {{ modalTitle }} </h5>
        </template>
        <template v-slot:body>
          <div class="row">
            <div
              class="col-md-3 border border-warning pb-3 pt-3"
              v-for="(image, index) in images" :key="index"
            >
              <img :src="image.src" @click="setWallpaper(image.src)">
            </div>
          </div>
        </template>
      </modal>
    </div>
</template>
<script>
  import {bus} from '../../app.js';
  import Modal from '../Modal.vue';
  export default {
    components: {
      'modal': Modal
    },
    data(){
      return {
        modalTitle: '',
        wallpaperModal: false,
        msg: 'Action buttons',
        bgImage: 'https://images.unsplash.com/photo-1582996091947-7c50ca745bc9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1949&q=80',
        images: [
          {
            src: 'https://images.pexels.com/photos/1616403/pexels-photo-1616403.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
          {
            src: 'https://images.pexels.com/photos/1293120/pexels-photo-1293120.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
          {
            src: 'https://images.pexels.com/photos/1103970/pexels-photo-1103970.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
          {
            src: 'https://images.pexels.com/photos/34090/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
          {
            src: 'https://images.pexels.com/photos/2130475/pexels-photo-2130475.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
          {
            src: 'https://images.pexels.com/photos/1145720/pexels-photo-1145720.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
          {
            src: 'https://images.pexels.com/photos/2471235/pexels-photo-2471235.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
          {
            src: 'https://images.pexels.com/photos/207153/pexels-photo-207153.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
          },
        ]
      }
    },
    methods: {
      changeWallpaper(){
        this.wallpaperModal = true;
        this.modalTitle = 'Change wallpaper modal';
      },
      closeModal(){
        this.wallpaperModal = false;
      },
      setWallpaper(url){
        bus.$emit('background', url);
      }
    }
  }
</script>
<style>

</style>
