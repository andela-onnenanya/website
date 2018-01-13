@extends('layouts.app')
@section('content')
<div class="content">
	@if (session('status'))
	    <div class="alert alert-success alert-dismissible fade show" role="alert">
		  <div class="container">
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		  {!! session('status') !!}
		  </div>
		</div>
	@endif
	<nav class="navbar navbar-light bg-light justify-content-between fixed-top">
		<a class="navbar-brand col-md-2"><img src="{{ asset('images/logo_gray.png') }}"></a>
		<div class="form-inline col-md-9 col-sm-12 header-form">
			<i class="fa fa-user-plus" aria-hidden="true"></i>
			<div class="col-md-5" id="find-loaction-div">
				<input type="text" class="form-control controls" id="find-location" placeholder="Find Developer, by location">
			</div>
			<div class="col-md-3">
				<a class="btn btn-register" href="register/github">
					<svg aria-hidden="true" class="octicon octicon-mark-github" height="23" version="1.1" viewBox="0 0 16 16" width="23">
						<path fill="#fff" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z">
						</path>
					</svg>
					<span>Register with Github</span>
				</a>
			</div>
		</div>
	</nav>
	<div id="map"> </div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"> <a class="nav-link" href="#">Philosophy</a> </li>
				<li class="nav-item"> <a class="nav-link" href="#">Events</a> </li>
				<li class="nav-item"> <a class="nav-link" href="#" id = "trigger-overlay-contact">Contact</a> </li>
				<li class="nav-item"> <a class="nav-link" href="#" id = "trigger-overlay-feedback">Feedback</a> </li>
			</ul>
		</div>
	</nav>
</div>

<div class="overlay overlay-content" id = "overlay-contact">
	<span class="overlay-close">Close</span>
	<div class="container">
		<div class="row no-padding">
		    <div class = "col-6 form">
		        <form action="{{route('contact')}}" method="POST">
		            {!! csrf_field() !!}
		            <div class="form-group">
		                <input type="email" class="form-control" placeholder="Type Your Email" name = "email">
		            </div>
		            <div class="form-group">
		                <textarea name="comment" class = "form-control" rows = "6" placeholder="Type your Comment!"></textarea>
		            </div>
		            <div class="form-group"> <button type="submit" class="btn btn-primary btn-block">Contact</button> </div>
		        </form>
		    </div>
		</div>
	</div>
</div>

<div class="overlay overlay-content" id = "overlay-feedback">
	<span class="overlay-close">Close</span>
	<div class="container">
		<div class="row no-padding">
		    <div class = "col-6 form">
		        <form action="{{route('feedback')}}" method="POST">
		            {!! csrf_field() !!}
		            <div class="form-group">
		                <input type="email" class="form-control" placeholder="Type Your Email" name = "email">
		            </div>
		            <div class="form-group">
		                <textarea name="message" class = "form-control" rows = "6" placeholder="Type your Feedback!"></textarea>
		            </div>
		            <div class="form-group"> <button type="submit" class="btn btn-primary btn-block">Submit</button> </div>
		        </form>
		    </div>
		</div>
	</div>
</div>

@endsection
@push('script')
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"> </script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDgIdV7w8h18k8E0TtZwjIlYjFi8cCBX2Y&am"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="{{ asset('js/home.js') }}"></script>
<link rel="stylesheet"href="//codeorigin.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script>
	$(function(){ initMap(); })
</script>
@endpush
@section('validator')
    {!! JsValidator::formRequest('App\Http\Requests\ContactFormRequest', '#overlay-contact form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\FeedbackFormRequest', '#overlay-feedback form') !!}
@endsection