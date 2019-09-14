<template>

	<div>
		<button class="btn btn-outline-success float-right" v-if="!fav" @click="favorite">
			favorite
		</button>

		<button class="btn btn-success float-right " v-else @click="unfavorite">
			favorited
		</button>
	</div>

</template>

<script>
	export default {
		name: 'Favorite',
		props: ['attributes'],
		data() {
			return {
				fav: 0,
			};
		},
		mounted() {
			this.isfavorite();

		},
		methods: {
			favorite() {
				axios.get('/post/favorite/' + this.attributes.id);
				// location.reload();
				this.fav = 1;
			},
			unfavorite() {
				axios.get('/post/unfavorite/' + this.attributes.id);
				// location.reload();
				this.fav = 0;
			},
			isfavorite() {
				axios.get('/post/isFavorited/' + this.attributes.id).then(
					res => {
						this.fav = res.data;
						console.log(res.data);
					},
				);

			},

		},
	};
</script>


