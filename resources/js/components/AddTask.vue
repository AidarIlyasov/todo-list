<template>
	<p>add task</p>
</template>
<script>
	import Modal from './Modal.vue'
	export default {
		data(){
		  return {
		    isModalVisible: false,
		  }
		},
		methods: {
		   addTask() {
		   	isModalVisible = true,
		    console.log('test');
		   }
		}
	}
</script>
<style>
	
</style>