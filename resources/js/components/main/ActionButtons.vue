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
              class="col-md-3 border border-warning pb-3 pt-3 img-item"
              v-for="(image, index) in images" :key="index"
            >
              <img
                :src="image.small"
                @click="setWallpaper(image.big)"
              >
              <a
                :href="image.link"
                :title="`visit ${image.author}`"
                target="_blank"
                class="img-autor"
              >{{ image.author }}</a>
            </div>
          </div>
        </template>
      </modal>
    </div>
</template>
<script>
  import {toJson } from 'unsplash-js'
  import {unsplash} from '../../app.js';
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
        images: [],
        // images: [
        //   {
        //     author: 'Aidar Ilyasov',
        //     link: 'https://unsplash.com/@aidarilyasov',
        //     src:   'https://images.pexels.com/photos/1616403/pexels-photo-1616403.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        //   {
        //     author: 'Another Author',
        //     src: 'https://images.pexels.com/photos/1293120/pexels-photo-1293120.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        //   {
        //     author: 'Another Author',
        //     src: 'https://images.pexels.com/photos/1103970/pexels-photo-1103970.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        //   {
        //     author: 'Another Author',
        //     src: 'https://images.pexels.com/photos/34090/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        //   {
        //     author: 'Another Author',
        //     src: 'https://images.pexels.com/photos/2130475/pexels-photo-2130475.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        //   {
        //     author: 'Another Author',
        //     src: 'https://images.pexels.com/photos/1145720/pexels-photo-1145720.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        //   {
        //     author: 'Another Author',
        //     src: 'https://images.pexels.com/photos/2471235/pexels-photo-2471235.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        //   {
        //     author: 'Another Author',
        //     src: 'https://images.pexels.com/photos/207153/pexels-photo-207153.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
        //   },
        // ]
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
    },
    created(){
      unsplash.photos.getRandomPhoto({ count: 8, height: 1080, width: 1920, query: "nature" })
        .then(toJson)
        .then(result => {
          result.forEach((image) => {
            this.images.push({
              author: image.user.name,
              link:   image.user.links.html,
              small:  image.urls.small,
              big:    image.urls.regular
            })
          });
        });
    }
  }
</script>
<style lang="scss">
  .img-item {
    position: relative;
    overflow: hidden;
    max-height: 200px;
  }
  .img-autor {
    position: absolute;
    right: 15px;
    background: #fff;
    padding: 0 10px;
    bottom: 15px;
    &:hover {
      text-decoration: underline;
    }
  }
</style>
