@extends('layouts.app')

@section('content')

	<div class="row justify-content-center">

		@forelse($posts as $post)
			<div class="col-md-8 my-4">
				<div class="card">

					<div class="card-header">
						{{$post->title}}

					</div>

					<div class="card-body">
						{{$post->body}}

				</div>
			</div>
	</div>
			@empty
			<h1> No Favorite Post !   :)</h1>

		@endforelse
	</div>


@endsection
