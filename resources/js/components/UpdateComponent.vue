<template>
	<div>
		<button type="button" class="btn btn-info float-right ml-2" v-if="like>0" disabled>liked
		</button>

		<button type="button" class="btn btn-outline-primary float-right ml-1" v-if="like<=0" @click="voted(1)">
			like
		</button>

		<button type="button" class="btn btn-danger float-right ml-1" v-if="like<=-1" disabled>diss
			liked
		</button>

		<button type="button" class="btn btn-outline-danger float-right ml-2" v-if="like>-1" @click="voted(-1)">
			diss Like
		</button>
	</div>

</template>

<script>
	export default {
		name: 'Update',
		props: ['attributes'],
		data() {
			return{
				like : 0,

			};
		},
		mounted() {
			this.islike();

		},

		methods: {
			voted(vote) {
				axios.get('/post/voted/' + this.attributes.id + '/' + vote);
				// alert(this.vote);
				if (vote == 1) {
					this.like = 1;
				}

				if(vote == -1){
					this.like = -1
				}
			},
			islike(){
				// axios.get('/post/isLike/' + this.attributes.id).then(
				// 	res => {
				// 		this.like = res.data;
				// 		console.log(res.data);
				// 	}
				// );
				this.like =this.attributes.active;
			}


		},
	};
</script>
