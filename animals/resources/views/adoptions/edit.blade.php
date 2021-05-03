@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Update the request</div> 
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
					<form class="form-horizontal" method="POST" action="{{ route('adoptions.update', ['adoption' => $adoptionrequest['id']]) }}" enctype="multipart/form-data" > 
						@method('PATCH')
						@csrf
						<div class="col-md-8">
							<label>Status: </label>
							<select name="status" value="{{ $adoptionrequest->status }}">
								<option value="Approved">Approved</option>
								<option value="Denied">Denied</option>
							</select>
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