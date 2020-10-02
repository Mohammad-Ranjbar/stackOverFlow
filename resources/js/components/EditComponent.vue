<template>

</template>

<script>
	export default {
		name: 'Edit',
		props: ['attributes'],

		data() {
			return {
				editing: false,
				body: this.attributes.body,
			};
		},
		methods: {
			update() {
				axios.patch('/Reply/update/' + this.attributes.id, {
					body: this.body,
				});
				this.editing = false;
				Swal.fire({
					type: 'success',
					title: 'Your Reply has been Update',
					showConfirmButton: false,
					timer: 2000
				})
			},
		},
	};
</script>
