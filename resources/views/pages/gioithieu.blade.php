@extends('layouts.index')
@section('content')
    <div class="fh5co-parallax" style="background-image: url({{ url('upload/slide/444.jpg') }});" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
					<div class="fh5co-intro fh5co-table-cell">
						<h1 class="text-center">{{__('generate.booking_with_us')}}</h1>
						<p>{{__('generate.welcome')}}</p>
					</div>
				</div>
			</div>
		</div>
    </div>

	<div id="fh5co-services-section">
		<div class="container">
			<h1> <p>* {{__('generate.about_us')}}</p></h1>
            <p> {{__('generate.text_about_us')}} </p>
		</div>
	</div>
@endsection
