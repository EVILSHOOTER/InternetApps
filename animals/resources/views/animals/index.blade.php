@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Display all animals</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Date_of_birth</th>
								<th>Availability</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($animals as $animal)
							@if ( (auth()->user()->staff == 0 && $animal['availability'] == 'Available') || auth()->user()->staff == 1 )
							<tr>
								<td>{{$animal['name']}}</td>
								<td>{{$animal['type']}}</td>
								<td>{{$animal['date_of_birth']}}</td>
								<td>{{$animal['availability']}}</td>
								
								<td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btn-primary">Details</a></td>
								
								@if ( auth()->user()->staff == 1 )
								<td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btn-warning">Edit</a></td>
								<td>
									<form action="{{ action([App\Http\Controllers\AnimalController::class, 'destroy'],  ['animal' => $animal['id']]) }}" method="post"> 
									@csrf
									<input name="_method" type="hidden" value="DELETE">
									<button class="btn btn-danger" type="submit"> Delete</button>
								</form>
								</td>
								@endif
								
								<!-- store -->
								<td>
									<form action="{{ action([App\Http\Controllers\AdoptionController::class, 'store']) }}" method="post"> 
									@csrf
									<input type="hidden" name="animal" value="{{ $animal['id'] }}" /> <!-- for animal ID -->
									<input name="_method" type="hidden" value="POST">
									<button class="btn btn-success" type="submit"> Adopt</button>
								</form>
								</td>
								
							</tr> 
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div> 
@endsection