@extends('layouts.index')

@section('css')
    <style>
        #img3 {
            width: 100%;
            height: 100%;
        }

        #content1 {
            display: flex;
            align-items: flex-start;
            justify: flex-start;
            padding-left: 5rem;
            padding-right: 5rem;
        }

    </style>
@endsection

@section('content')
    <div class="fh5co-parallax" style="background-image: url({{ url('upload/slide/444.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div
                    class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
                    <div class="fh5co-intro fh5co-table-cell">
                        <h1 class="text-center">{{__('generate.booking_with_us')}}</h1>
                        <p>{{__('generate.welcome')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-contact-section">
        <div class="row" id="content1">
            <div class="col-md-6">

                <div id="map" class="fh5co-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3710.0226236249296!2d105.80419231494214!3d21.585039985699584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31352738b1bf08a3%3A0x515f4860ede9e108!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5n!5e0!3m2!1sen!2s!4v1621655468340!5m2!1sen!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <h3>{{__('generate.come_with_us')}}</h3>
                    <p>{{__('generate.text_come')}}</p>
                    <ul class="contact-info">
                        <li><i class="ti-map"></i>54, Phố Triều Khúc, Thanh Xuân, Hà Nội, Việt Nam</li>
                        <li><i class="ti-mobile"></i>0833260400</li>
                        <li><i class="ti-envelope"></i><a href="#">tovantiep2604@gmail.com</a></li>
                        <li><i class="ti-home"></i><a href="{{ route('website') }}">www.utthotel.com</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
