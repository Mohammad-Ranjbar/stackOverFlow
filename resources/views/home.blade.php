@extends('layouts.app')

@section('content')

	<div class="container">
		@if (session('status'))
			<script>
				Swal.fire({
					text: 'new post is created !',
					type: 'success',

				});
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

							@can('update',$post)
								<button type="button" class="btn btn-warning float-right ml-1" data-toggle="modal"
								        data-target="#myModal-{{$post->id}}">edit
								</button>
								<a href="{{route('delete-post',['id' => $post->id])}}">
									<button type="button" class="btn btn-danger float-right">delete</button>
								</a>
							@endcan

						</div>

						<div class="card-body">
							{{$post->body}}
						</div>

						<div class="card-footer">
							count vote : {{$post->likes()->sum('like')}}

							<favorite :attributes="{{$post}}"></favorite>

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

