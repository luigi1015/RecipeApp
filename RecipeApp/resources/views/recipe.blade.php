@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					@if( !(empty($recipe)) )
						Here is your recipe:
						<br>
						Name: {{ $recipe->name }}
						<br>
						User Friendly ID: {{ $recipe->userfriendlyid }}
						<br>
						Public: {{ $recipe->public == true ? 'True' : 'False' }}
						<br>
						Description:
						<br>
						{{ $recipe->description }}
					@else
						Recipe not found.
					@endif
					<br>
					<a href="/home">Back home</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
