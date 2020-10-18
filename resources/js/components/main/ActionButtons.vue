<template>
	<div>
		<div class="col-md-12">
			<button class="btn btn-outline-primary btn-sm"><i class="fa fa-star"></i> Favorite</button>
			<button class="btn btn-outline-primary btn-sm"><i class="fa fa-lock"></i> Private</button>
			<button class="btn btn-outline-primary btn-sm"><i class="fa fa-user-plus"></i> Invite</button>
			<button class="btn btn-outline-primary btn-sm" @click="changeWallpaper()"><i class="fa fa-picture-o"></i>
				Change wallpaper
			</button>
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
							@click="setWallpaper(image.big, boardId)"
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
	import {toJson} from 'unsplash-js'
	import {unsplash} from '../../app.js';
	import {bus} from '../../app.js';
	import Modal from '../Modal.vue';
	import axios from 'axios';

	export default {
		components: {
			'modal': Modal
		},
		data() {
			return {
				modalTitle: '',
				wallpaperModal: false,
				msg: 'Action buttons',
				bgImage: '',
				images: [],
                boardId: 0
			}
		},
		methods: {
			changeWallpaper() {
				this.wallpaperModal = true;
				this.modalTitle = 'Change wallpaper modal';
			},
			closeModal() {
				this.wallpaperModal = false;
			},
			setWallpaper(url, boardId) {
			    let data = {
			        'bg_image': url
			    };
				bus.$emit('background', url);
				axios.put('api/boards/' + boardId, data).then(res => {
					console.log(res);
				}).catch(e => {
					console.log(e);
				})
			}
		},
		created() {
			unsplash.photos.getRandomPhoto({count: 8, height: 1080, width: 1920, query: "nature"})
			.then(toJson)
			.then(result => {
				result.forEach((image) => {
					this.images.push({
						author: image.user.name,
						link: image.user.links.html,
						small: image.urls.small,
						big: image.urls.regular
					})
				});
			});

            bus.$on('board', data => {
                console.log('actionButtons', data.board.id);
                this.boardId = data.board.id;
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
