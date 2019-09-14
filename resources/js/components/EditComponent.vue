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
				axios.post('/Reply/update/' + this.attributes.id, {
					body: this.body,
				});
				this.editing = false;
			},
		},
	};
</script>
