<template>
	<div class="">
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
	import Modal from './Modal.vue';
	export default {
		components: {
			'modal': Modal
		},
		props: ['taskModal'],
		data(){
		  return {
				modalTitle: 'Добавить задачу',
				taskTitle: '',
				taskEndDate: '',
				taskDescription: ''
		  }
		},
		methods: {
		   addTask() {
				 this.taskModal = true;
	       this.modalTitle = 'Task add modal title';
		   },
			 closeModal() {
				this.$emit('close', false);
			},
			createTask() {
				console.log({
					'title': this.taskTitle,
					'endDate': this.taskEndDate,
					'description': this.taskDescription
				})
			}
		}
	}
</script>
<style>

</style>
