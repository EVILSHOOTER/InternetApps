@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Edit and update the animal</div> 
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li> 
						@endforeach
					</ul>
				</div><br /> 
				@endif
				@if (\Session::has('success'))
				<div class="alert alert-success">
					<p>{{ \Session::get('success') }}</p>
				</div><br /> 
				@endif
				<div class="card-body">
					<form class="form-horizontal" method="POST" action="{{ route('animals.update', ['animal' => $animal['id']]) }}" enctype="multipart/form-data" > 
					@method('PATCH')
					@csrf
					<div class="col-md-8">
						<label >Name of animal: </label>
						<input type="text" name="name" value="{{$animal->name}}"/>
					</div>
					<div class="col-md-8">
						<label>Type of animal: </label>
						<select name="type" value="{{ $animal->type }}">
							<option value="dog">Dog</option>
							<option value="cat">Cat</option>
							<option value="fish">Fish</option>
							<option value="snake">Snake</option>
						</select>
					</div>
					<div class="col-md-8">
						<label >Date of birth: </label>
						<input type="date" name="date_of_birth" value="{{$animal->date_of_birth}}" />
					</div>
					<div class="col-md-8">
						<label >Description of animal: </label>
						<textarea rows="4" cols="50" name="description" > {{$animal->description}}
						</textarea>
					</div>
					<div class="col-md-8">
						<label>Image</label>
						<input type="file" name="image" />
					</div>
					<div class="col-md-6 col-md-offset-4">
						<input type="submit" class="btn btn-primary" />
						<input type="reset" class="btn btn-primary" />
						</a>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div> 
@endsection