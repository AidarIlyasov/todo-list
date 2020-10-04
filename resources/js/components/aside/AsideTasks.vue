<template>
	<div class="">
		<div class="aside-tasks mt-3 mb-3 today-tasks">
				<h4 class="d-flex justify-content-between">Today tasks <span>+</span></h4>
				<ul class="list-group left-menu sm">
					<li v-for="(task, index) in tasks">
                        {{ task.title }}
                    </li>
				</ul>
				<li class="add-task" @click="addTask()">Add task +</li>
		</div>
		<div class="aside-tasks mt-3 mb-3 common-tasks">
				<h4 class="d-flex justify-content-between">Common tasks <span>+</span></h4>
				<ul class="list-group left-menu sm">
					<li>Some new task</li>
				</ul>
				<li class="add-task" @click="addTask()">Add task +</li>
		</div>
		<modal id="add-task"
					v-show="taskModal"
					@close="closeModal">
			<template v-slot:header>
				<h5> {{ modalTitle }} </h5>
			</template>
			<template v-slot:body>
				<div class="row">
					<div class="form-group col-sm-6">
						<label for="">Task name</label>
						<input type="text" class="form-control form-control-sm" v-model="taskTitle">
					</div>
					<div class="form-group col-sm-6">
						<label for="">Date of completion</label>
						<input type="date" class="form-control form-control-sm" v-model="taskEndDate">
					</div>
				</div>
				<div class="form-group">
					<label for="">Task description</label>
					<textarea type="text" class="form-control form-control-sm" v-model="taskDescription" rows="10"></textarea>
				</div>
				<button class="btn btn-sm btn-outline-success"  @click="createTask()">Save</button>
			</template>
		</modal>
	</div>
</template>
<script>
	import Modal from '../Modal.vue';
    import {bus} from "../../app";
	export default {
		components: {
			'modal': Modal
		},
		data(){
		  return {
				modalTitle: 'Добавить задачу',
				taskTitle: '',
				taskEndDate: '',
				taskDescription: '',
				taskModal: false,
                tasks: []
		  }
		},
		methods: {
		   addTask() {
				 this.taskModal = true;
	       this.modalTitle = 'Task add modal title';
		   },
			 closeModal() {
				 this.taskModal = false;
			},
			createTask() {
				console.log({
					'title': this.taskTitle,
					'endDate': this.taskEndDate,
					'description': this.taskDescription
				})
			}
		},
        created() {
            bus.$on('board', data => {
                console.log('aside tasks', data.tasks);
                this.tasks = data.tasks;
            });
        }
    }
</script>
<style>

</style>
