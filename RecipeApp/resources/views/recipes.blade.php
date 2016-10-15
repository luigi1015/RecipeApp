@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					Here are your recipes
					<br>
					<div class="list-group">
					@foreach( $recipes as $recipe )
						<a href="#" class="list-group-item list-group-item-action">
							<h4 class="list-group-item-heading">{{ $recipe->name }}</h4>
							<span class="list-group-item-text">{{ $recipe->description }}</span>
						</a>
					@endforeach
					</div>
					<a href="/home">Back home</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
