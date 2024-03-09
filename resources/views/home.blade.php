@extends('layouts.default')

@section('head')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@endsection

@section('navbar')
    <div class="text-center">
        <div>
        <nav class="navbar navbar-expand-md navbar-homepage">
            <button class="navbar-toggler text-yellow border-yellow" type="button" data-toggle="collapse"
                    data-target="#menu"
                    aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="menu">
                <ul class="navbar-nav text-left">
                    <li class="nav-item p-0 mx-2">
                        <a class="nav-link" href="#onas">{{ __('homepage.nav.about') }}</a>
                    </li>
                    <li class="nav-item p-0 mx-2">
                        <a class="nav-link" href="#pole">{{ __('homepage.nav.campsite') }}</a>
                    </li>
                    <li class="nav-item p-0 mx-2">
                        <a class="nav-link" href="#domki">{{ __('homepage.nav.bungalows') }}</a>
                    </li>
                    <li class="nav-item p-0 mx-2">
                        <a class="nav-link" href="#faq">{{ __('homepage.nav.faq') }}</a>
                    </li>
                    <li class="nav-item p-0 mx-2">
                        <a class="nav-link" href="#cennik">{{ __('homepage.nav.prices') }}</a>
                    </li>
                    <li class="nav-item p-0 mx-2">
                        <a class="nav-link" href="#kontakt">{{ __('homepage.nav.contact') }}</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="px-4 py-5" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{mix('images/bgsc.jpg')}}) no-repeat center; background-size: cover">
            <img class="img-fluid" alt="Słoneczny Camping"
                 src="{{mix('images/sloneczny_camping.png')}}">
        </div>
    </div>
@endsection

@section('about')
    <div id="onas" class="section">
        <div class="container">
            <h1 class="text-yellow">{{ __('homepage.sections.about.title') }}</h1>
            <p>
                {{ __('homepage.sections.about.content') }}
            </p>
        </div>
    </div>
@endsection

@section('campsite')
    <div id="pole" class="section" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url({{mix('images/pole.jpg')}}) no-repeat center; background-size: cover">
        <div class="rooms_content container">
            <h1 class="text-white">{{ __('homepage.sections.campsite.title') }}</h1>
            <p>
                {{ __('homepage.sections.campsite.content') }}
            </p>
        </div>
    </div>
@endsection

@section('bungalows')
    <div id="domki" class="section">
        <div class="container">
            <h1 class="text-yellow">{{ __('homepage.sections.bungalows.title') }}</h1>
            <p>
                {{ __('homepage.sections.bungalows.content') }}
            </p>
        </div>
    </div>
@endsection

@section('faq')
    <div id="faq" class="section bg-dark-grey">
        <div class="container">
            <h1 class="text-white mb-4">{{ __('homepage.sections.faq.title') }}</h1>
            @foreach(Lang::get('homepage.sections.faq.content') as $faq)
                <p class="mb-4">
                    {{ $faq['q'] }}<br>
                    {{ $faq['a'] }}
                </p>
            @endforeach
        </div>
    </div>
@endsection

@section('pricing')
    <div id="cennik" class="section">
        <div class="container">
            <h1 class="text-yellow">Cennik</h1>
            <table class="table table-borderless text-uppercase">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Cena za dobę</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Osoba dorosła</td>
                        <td>20 zł</td>
                    </tr>
                    <tr>
                        <td>Dziecko do lat 12</td>
                        <td>18 zł</td>
                    </tr>
                    <tr>
                        <td>Prąd</td>
                        <td>15 zł</td>
                    </tr>
                    <tr>
                        <td>Przyczepa</td>
                        <td>5-10 zł¹</td>
                    </tr>
                    <tr>
                        <td>Przedsionek</td>
                        <td>5-10 zł¹</td>
                    </tr>
                    <tr>
                        <td>Namiot</td>
                        <td>5-10 zł¹</td>
                    </tr>
                    <tr>
                        <td>Samochód</td>
                        <td>5-10 zł¹</td>
                    </tr>
                    <tr>
                        <td>Domek</td>
                        <td>200-250 zł²</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center text-danger">
                OPŁATA KLIMATYCZNA WG UCHWAŁY RADY GMINY
            </div>
        </div>
    </div>
@endsection

@section('contact')
    <div id="kontakt" class="section">
        <div class="container">
            <h1 class="text-yellow">{{ __('homepage.sections.contact.title') }}</h1>
            <p>
                {{ __('homepage.sections.faq.contect') }}<br><br>
            </p>
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span class="pl-1">
                Słoneczny Camping<br>
                Wicie, ul. Słoneczna 11b<br>
            </span>
            <i class="fa fa-mobile" aria-hidden="true"></i>
            <a class="pl-1" href="tel:+48509321120">+48 509 321 120</a>
        </div>
    </div>
@endsection

@section('testimonials')

@endsection

@section('map')
    <div>
        <iframe id="google-map"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9265.562287219303!2d16.473439!3d54.508973!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x549f3ebc291d2d79!2sS%C5%82oneczny+Camping+WICIE!5e0!3m2!1spl!2spl!4v1489054569469"
                height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
@endsection

@section('main')
    @yield('about')
    @yield('campsite')
    @yield('bungalows')
    @yield('faq')
    @yield('pricing')
    @yield('contact')
    @yield('testimonials')
    @yield('map')
@endsection

@section('footer')
    <div class="container">
        <div class="pull-right">
            <span>Design by</span><a target="_blank" href="http://www.jacynodesign.pl"><img class="jd-img"
                                                                                            alt="Jacyno Design"
                                                                                            src="{{mix('images/jd.png')}}"></a>
        </div>
        <div class="pull-left">
            <span>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2021</span><a
                target="_blank"
                href="http://www.slonecznycamping.pl"><img alt="Słoneczny Camping"
                                                           class="sc-img"
                                                           src="{{mix('images/sloneczny_camping.png')}}"></a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{mix('js/app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/55e5114f06.js"></script>
@endpush
