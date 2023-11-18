@extends('front/layouts/mainLayout')

@section('layoutContent')

    @foreach($sections as $section)
        <section class="section pb0">
            <div class="container">
                <div class="section__head">
                    <h2 class="section__title"><span class="sh-separate">{{$section->h1}}</span></h2>
                </div>
            </div>
            <div class="section-bg">
                <div class="section-bg__img img3"><img src="img/il-3.svg" alt=""></div>
                <div class="section-bg__img img4"><img src="img/il-4.svg" alt=""></div>
                <div class="container">
                    <div class="cards-sm-slider ">
                        <div class="flex-recipes">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

@yield('content')
@endsection
