@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Display all adoptions</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Animal</th>
								<th>Requester</th>
								<th>Status</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($adoptionrequests as $adoptionrequest)
							<!-- if statement: if user then: -->
							@if ( (auth()->user()->staff == 0 && $adoptionrequest['requester'] == auth()->user()->id) || auth()->user()->staff == 1 )
							<tr>
								<td>{{$adoptionrequest['animal']}}</td>
								<td>{{$adoptionrequest['requester']}}</td>
								<td>{{$adoptionrequest['status']}}</td>
								
								<!-- buttons for approve/deny. maybe put an if statemetn here for displaying -->
								@if ( auth()->user()->staff == 1 )
								<td><a href="{{ route('adoptions.edit', ['adoption' => $adoptionrequest['id']]) }}" class="btn btn-warning">Edit</a></td>
								@endif
								
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