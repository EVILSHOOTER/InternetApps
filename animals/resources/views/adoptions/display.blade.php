@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Dashboard</div>
				<div class="card-body">
					@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
					@endif
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th> id</th>
								<th> Animal</th>
								<th> Requester</th>
								<th> Status </th>
							</tr>
						</thead>
						<tbody>
							@foreach($adoptions as $adoption)
							<tr>
							<td> {{$adoption->id}} </td>
							<td> {{$adoption->animal}} </td>
							<td> {{$adoption->requester}} </td>
							<td> {{$adoption->status}} </td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection