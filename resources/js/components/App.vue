<template>
	<div class="container">
	  <!-- Перенести в копонент профиля -->
		<b-modal id="settings" title="Some user name" @ok="saveSettings()">
			<div class="form-group">
				<label for="user_name">User name</label>
				<input type="text" id="user_name" class="form-control form-control-sm" v-model="userName">
			</div>
			<div class="form-group">
				<label for="user_email">Email address</label>
				<input type="email" id="user_email" class="form-control form-control-sm" v-model="userEmail">
				<small class="form-text text-muted">
					We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
				<img :src="previewImage" class="uploaded-image">
				<label for="uploadImage" class="btn btn-outline-primary btn-sm">
					{{ previewImage ? 'uppload another image' : 'Uppload image'}}
				</label>
				<input type="file" class="d-none" @change="previewFiles" id="uploadImage" accept=".jpg, .jpeg, .png">
			</div>
		</b-modal>
		<!-- Конец Перенести в копонент профиля -->
		<div class="row mt-4">
			<div class="col-md-3 pt-4 bg-gray">
				<div class="d-flex">
					<div class="user-profile border border-primary rounded-circle mb-2" @click="profile()">
					  <!-- {{ userFirstLetter }} -->
					</div>
					<div class="profile-option ml-3">
						<li
						  class="active"
						  @click="taskCalendar()">
						  Task calendar
						</li>
						<li v-b-modal.settings>Settings</li>
						<hr class="mt-2 mb-1">
						<li><a href="/logout">Log out</a></li>
					</div>
				</div>
				<hr class="mt-1 mb-3">
				<!-- boards component -->
				<board></board>
				<!-- today tasks list-->
				<aside-tasks></aside-tasks>
				<!-- task calendar -->
				<task-calendar></task-calendar>
			</div>
			<div class="col-md-9">
			  <!-- main section - tasks board -->
			  <task-board></task-board>
			</div>
		</div>
	</div>
</template>
<script>
  import {bus} from '../app.js';
  import Profile from './aside/Profile.vue';
  import asideTasks from './aside/AsideTasks.vue';
  import Board from './aside/Board.vue';
  import taskCalendar from './aside/TaskCalendar.vue';
  import taskBoard from './main/TaskBoard.vue';
  import axios from 'axios';

  export default {
  components: {
	'asideTasks': asideTasks,
	'porfile': Profile,
	'board': Board,
	'taskCalendar': taskCalendar,
	'taskBoard': taskBoard
  },
  data() {
	  return {
		// bgImage: '#fff'
		userName:     'Aidar Ilyasov',
		userEmail:    'name@example.com',
		userImage:    '',
		previewImage: '',
	  }
  },
  mounted() {
	  console.log('Component mounted.');
	  axios.get('api/user').then(res=> {
	  	console.log(res.data);
	  })
  },
  methods: {
	profile() {
		console.log("Profile");
	},
	taskCalendar() {
	  bus.$emit('modal', true);
	},
	previewFiles(event) {
		let file = event.target.files[0];
		if (file.size > 70000) {
			alert("Max image size 70KB");
			return;
		}
    	this.previewImage = URL.createObjectURL(file);
    	this.userImage = file;
	},
	saveSettings() {
		const formData   = new FormData();
        formData.append('name', this.userName);
        formData.append('email', this.userEmail);
        formData.append('image', this.userImage);

		axios.post('api/users', formData, {
		    'headers': {'Content-Type': 'multipart/form-data'}
        }).then(res => {
			console.log(res.data);
		});
	}
  },
  created() {
	bus.$on('background', url => {
	  let body = document.querySelector('body');
	  body.style.background = url ? `url(${url}) no-repeat center / cover` : '#fff';
	});
  },
  mounted() {
      console.log('возвращает всех клиентов для аутентифицированного пользователя');
      axios.get('/oauth/clients')
          .then(response => {
              console.log(response.data);
          });
  },
  computed: {
	// userFirstLetter() {
	//   let name = this.userName.split(' ');
	//   return `${name[0][0]} ${name[1][0]}`;
	// }
  }
}

</script>
<style lang="scss">
  .remove-color{
	color: tomato;
  }
  body {
	  background-color: #fff;
  }
  textarea{
	scrollbar-width: thin;
  }
  textarea::-webkit-scrollbar {
	width: 4px;
	height: 4px;
  }

  textarea::-webkit-scrollbar-track {
	background: rgba(0, 0, 0, 0.1);
  }

  textarea::-webkit-scrollbar-thumb {
	background: rgba(0, 0, 0, 0.5);
  }

  .add-task {
	  color: #3d91cd;
	  font-weight: bold;
	  text-align: center;
  }

  .change-view {
	  margin: 0 0 0 auto;
  }

  .card {
	  border-radius: 0;
  }

  .bg-gray{
	background: #fff;
  }

  #task-calendar{
	height: 60vh;
	overflow-y: scroll;
  }
  .day, .dt{
	position: relative;
  }
  .contributor-profile {
	  width: 30px;
	  height: 30px;
	  border-radius: 50%;
	  font-size: 12px;
	  line-height: 2.2;
	  border: solid 2px tomato;
	  text-align: center;
	  margin-left: -8px;
	  background-color: #fff;
	  ;
  }

  .contributor-profile:first-child {
	  border: solid 2px green;
  }

  .user-profile {
	  display: flex;
	  -ms-align-items: center;
	  align-items: center;
	  justify-content: center;
	  font-size: 26px;
	  font-weight: bold;
	  width: 80px;
	  height: 80px;
	  cursor: pointer;
	  /*background: url(./public/img/profile.png) no-repeat center / contain;*/
  }

  .left-menu {
	  li {
		  list-style: none;
		  border-bottom: solid 1px #3d91cd;
		  line-height: 2;
		  cursor: pointer;
		  text-overflow: ellipsis;
		  white-space: nowrap;
		  overflow: hidden;
		  display: flex;
		  justify-content: space-between;
		  padding-right: 5px;
		  align-items: center;

		  &:hover {
			  background-color: #dfe0e2;

			  &>i {
				  display: block;
			  }
		  }

		  &>i {
			  display: none;
			  transition: .3s;
		  }

		  &.active {
			  background-color: #2196F3;
			  color: #fff;
		  }

		  &>i:hover {
			  font-size: 20px;
		  }
	  }
  }

  .profile-option {
	  line-height: 1.3;

	  li {
		  list-style: none;
		  width: 100%;
		  cursor: pointer;
		  transition: .3s;
		  padding: 0 5px;

		  &:hover {
			  background-color: #dfe0e2;
		  }
	  }
  }

  .board-contributors {
	  font-size: 16px;
  }

  .element-primary, .element-outline-primary {
	padding: 0 5px;
	border-radius: 5px;
	cursor: pointer;
	transition: .3s;
  }
  .element-primary{
	background-color: #3490dc;
	border: solid 1px transparent;
	color: #fff;
	&:hover {
		background: #fff;
		color: #3490dc;
		border: solid 1px #3490dc;
	}
  }
  .element-outline-primary {
	  border: solid 1px #3490dc;
	  &:hover {
		  background: #3490dc;
		  color: #fff;
	  }
  }

  // calendar
  a:link,
  a:active,
  a:visited {
	  color: #777;
	  text-decoration: none;
  }

  .dt,
  .day,
  .mo {
	  text-align: right;
	  width: 55px;
	  height: 25px;
  }

  .day,
  .mo {
	  font-weight: bold;
	  color: #555;
  }

  .day,
  .dt {
	  margin-bottom: 5px;
  }

  .mo {
	  margin-bottom: 20px;
  }

  table,
  td {
	  border-spacing: 0;
	  vertical-align: top;
  }

  h1 {
	  display: inline-block;
	  font-size: 4.5em;
	  margin: 30px 0 0 40px;
  }

  h2 {
	  margin: 0 0 30px 40px;
  }

  #cal {
	  margin: 0 auto;
	  width: 780px;
  }

  #time {
	  float: right;
  }

  body.night {
	  background-color: #111;
	  color: #EEE;
  }

  body.night h1 {
	  color: #EEE;
  }

  body.night .day,
  body.night .mo {
	  color: #aaa;
  }

  .task-count {
	  background: #aea;
	  padding: 0 5px;
	  cursor: pointer;
	  position: absolute;
	  display: inline-block;
  }

  .uploaded-image {
  	margin-bottom: 15px;
  }
</style>
