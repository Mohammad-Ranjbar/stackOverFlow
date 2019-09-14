@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row justify-content-center">

			@foreach($replies as $reply)

				@if ($reply->bestAnswer == 1)
					<div class="col-md-8 my-4">
						<div class="card">
							<div class="card-header bg-success">
								<p class="float-left">{{$reply->user->name}}</p>
								<p class="float-right">Best Answer</p>
							</div>
							<div class="card-body">
								{{$reply->body}}
							</div>
						</div>
					</div>
				@endif
			@endforeach

			@foreach($replies as $reply)

				<div class="col-md-8 my-4">
					<edit inline-template :attributes="{{$reply}}">
						<div class="card">
							<div class="card-header">
								<p class="float-left"> {{$reply->user->name}}</p>
								<a href="{{route('voted-reply',['reply' => $reply->id , 'vote' => 1])}}">
									<button type="button" class="btn btn-outline-info float-right ml-2">like</button>
								</a>
								<a href="{{route('voted-reply',['reply' => $reply->id , 'vote' => -1])}}">
									<button type="button" class="btn btn-outline-danger float-right ml-2">disslike</button>
								</a>
								@if ($post->user_id == auth()->user()->id && !( $reply->bestAnswer) )
									<a href="{{route('bestAnswer',['id' => $reply->id])}}" class="float-right">
										<button type="submit" class="btn btn-success">Best Answer</button>
									</a>
								@endif
							</div>

							<div class="card-body">

								<div v-if="editing">
									<div class="form-group">
										<textarea class="form-control" v-model="body">{{$reply->body}}</textarea>

									</div>

									<button class="btn btn-primary" @click="update">update</button>
									<button class="btn btn-warning" @click="editing=false">cancele</button>

								</div>
								<div v-else v-text="body"></div>

							</div>

							@if($reply->user->id == auth()->user()->id)
								<div class="card-footer">
									<button class="btn btn-primary" style="float: right" @click="editing = true">update</button>

								</div>
							@endif
						</div>
					</edit>
				</div>
			@endforeach

			<div class="col-md-8 border ">
				<form action="{{route('write-reply',['id' => $id , 'user' => auth()->user()->id])}}" method="post" role="form">
					@csrf
					<legend>write reply</legend>
					<div class="form-group">
						<label for="body"></label>
						<input type="text" class="form-control" name="body" id="body" required>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>

@endsection
