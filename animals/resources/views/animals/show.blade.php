@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Display all animals</div>
				<div class="card-body">
					<table class="table table-striped" border="1" >
						<tr> <td> <b>Name </th> <td> {{$animal['name']}}</td></tr>
						<tr> <th>Type </th> <td>{{$animal->type}}</td></tr>
						<tr> <th>Date of birth </th> <td>{{$animal->date_of_birth}}</td></tr>
						<tr> <td>Availability </th> <td>{{$animal->availability}}</td></tr>
						<tr> <th>Description </th> <td style="max-width:150px;" >{{$animal->description}}</td></tr>
						<tr> <td colspan='2' ><img style="width:100%;height:100%" 
						src="{{ asset('storage/images/'.$animal->image)}}"></td></tr>
					</table>
					<table><tr>
						<td><a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the list</a></td>
						@if ( auth()->user()->staff == 1 )
						<td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btn-warning">Edit</a></td>
						<td><form action="{{ route('animals.destroy', ['animal' => $animal['id']]) }}" 
						method="post"> @csrf
						<input name="_method" type="hidden" value="DELETE">
						<button class="btn btn-danger" type="submit">Delete</button>
						</form></td>
						@endif
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div> 
@endsection