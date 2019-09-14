@extends('layouts.app')

@section('content')

	<div class="container">
		@if (session('status'))

			{{--<div class="alert alert-success">--}}
				{{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
				{{--{{ session('status') }}--}}
			{{--</div>--}}
				<script >
					Swal.fire({
						text: 'new post is created !',
						type: 'success',
						

					})
				</script>
		@endif
		<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">add new post</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">

						<h4 class="modal-title">Register Post</h4>
					</div>
					<div class="modal-body">
						<form action="{{route('create-post',['id' => auth()->user()->id])}}" method="post" role="form">
							@csrf

							<div class="form-group">
								<label for="title">title</label>
								<input type="text" class="form-control" name="title" id="title">
							</div>
							<div class="form-group">
								<label for="body">body</label>
								<textarea type="text" class="form-control" name="body" id="body"></textarea>
							</div>

							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

		<div class="row justify-content-center">

			@foreach($posts as $post)
				<div class="col-md-8 my-4 border-bottom border-dark ">
					<div class="card ">

						<div class="card-header">

							<a href="{{route('show-reply' ,['id' => $post->id])}}">{{$post->title}}  </a>write by
							: {{$post->user->name}}
							<update :attributes="{{$post}}"></update>
							{{--<update inline-template :attributes="{{$post}}">--}}
								{{--@if ($post->likes()->where([['user_id',auth()->user()->id],['like',1]])->first())--}}
								{{--<button type="button" class="btn btn-info float-right ml-2" v-if="like===1" disabled>liked--}}
								{{--</button>--}}
								{{--<button type="button" class="btn btn-outline-primary float-right ml-1" v-else @click="voted(1)">--}}
									{{--like--}}
								{{--</button>--}}
								{{--@else--}}
								{{--<a href="{{route('voted-post',['post' => $post->id , 'vote' => 1 ])}}">--}}
								{{--</a>--}}
							{{--</update>--}}
							{{--@endif--}}
							{{--@if ($post->likes()->where([['user_id',auth()->user()->id],['like',-1]])->first())--}}
							{{--@else--}}
							{{--<update inline-template :attributes="{{$post}}">--}}
								{{--<a href="{{route('voted-post',['post' => $post->id , 'vote' => -1] )}}">--}}
								{{--</a>--}}
								{{--<button type="button" class="btn btn-danger float-right ml-1" v-if="like==-1" disabled>diss--}}
									{{--liked--}}
								{{--</button>--}}

								{{--<button type="button" class="btn btn-outline-danger float-right ml-2" v-else @click="voted(-1)">--}}
									{{--diss Like--}}
								{{--</button>--}}

							{{--</update>--}}
							{{--@endif--}}


							{{--@if ($post->user->id == auth()->user()->id)--}}
							@can('update',$post)
								<button type="button" class="btn btn-warning float-right ml-1" data-toggle="modal"
								        data-target="#myModal-{{$post->id}}">edit
								</button>
								<a href="{{route('delete-post',['id' => $post->id])}}">
									<button type="button" class="btn btn-danger float-right">delete</button>
								</a>
							@endcan
							{{--@endif--}}

						</div>

						<div class="card-body">
							{{$post->body}}
						</div>

						<div class="card-footer">
							count vote : {{$post->likes()->sum('like')}}

							{{--@if (!auth()->user()->favorites->where('post_id',$post->id)->first())--}}
							<favorite :attributes="{{$post}}"></favorite>
							{{--<favorite inline-template :attributes="{{$post}}">--}}
								{{--<a href="{{route('favorite',['id' => $post->id])}}">--}}

								{{--<button class="btn btn-outline-success float-right" v-if="!fav" @click="favorite">--}}
									{{--favorite--}}
								{{--</button>--}}

								{{--</a>--}}

								{{--@else--}}
								{{--<a href="{{route('unfavorite',['id' => $post->id ])}}">--}}

								{{--<div v-if="fav" >--}}
								{{--<button class="btn btn-success float-right " v-else @click="unfavorite">--}}
									{{--favorited--}}
								{{--</button>--}}
								{{--</div>--}}
							{{--</favorite>--}}
							{{--</a>--}}
							{{--@endif--}}

						</div>

					</div>
				</div>

				{{--Modal--}}
				<div class="modal fade" id="myModal-{{$post->id}}" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">route

								<h4 class="modal-title">Edit Post {{$post->title}}</h4>
							</div>
							<div class="modal-body">
								<form action="{{route('update-post',['id' => $post->id])}}" method="post" role="form">
									@csrf

									<div class="form-group">
										<label for="title">title</label>
										<input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
									</div>
									<div class="form-group">
										<label for="body">body</label>
										<input type="text" class="form-control" name="body" id="body" value="{{$post->body}}">
									</div>

									<button type="submit" class="btn btn-primary">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>

			@endforeach

		</div>
	</div>
@endsection
<script>
	import Update from '../js/components/UpdateComponent';

	export default {
		components: { Update },
	};
</script>

