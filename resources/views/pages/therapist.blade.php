@extends('layouts.app')

@section('content')

  <div class="jumbotron jumbotron--color-2 s-container">

    <div class="row f-row small-collapse">
      <div class="large-12 columns">
        <div class="jumbotron__content">
          <h1><span class='highlight highlight--color-2'>Logopedisten,</span><br>wij zijn er om te</h1>

        </div>
      </div>
    </div>

    <span class='jumbotron__big'>helpen</span>
  </div>

  <div class="s-container s-container--no-p">
    <div class="section__header section__header--color-1 m-t-100">
      <div class="row f-row">
        <div class="large-12 columns">
          <h1 class='section__headertitle'>Wat kan dit platform<br>voor uw praktijk doen?</h1>
        </div>
      </div>
    </div>
    <div class="section section--type-3 p-t-100 p-b-100">

      <div class="row">
        <div class="large-6 columns">
          <h2 class='t--semi-bold'>Jouw passe, gemakkelijker.</h2>
          <h3 class='t--regular t--lightest'>Blijf verbonden met cliëntjes</h3>
          <p class='m-b-40'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend, neque a malesuada condimentum, tellus dui ultricies augue, in ornare nisi arcu commodo eros. Vestibulum</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend, neque a malesuada condimentum, tellus dui ultricies augue, in ornare nisi arcu commodo eros. Vestibulum</p>
        </div>
        <div class="large-6 columns">
          {{-- <h2>qdqzdqdd</h2> --}}
          {{-- <img src="img/icon-world.svg" alt=""> --}}
        </div>
      </div>
    </div>
    <div class="section__header section__header--color-1 m-t-100">
      <div class="row f-row">
        <div class="large-12 columns">
          <h1 class='section__headertitle'>Oke, teken mijn voordelen even uit <br>voor de duidelijkheid.</h1>
        </div>
      </div>
    </div>
    <div class="section section--type-4 p-t-100 p-b-100">
      <div class="row">
        <div class="large-12 columns">
          <h2 class='t--semi-bold text-center'>Drie <span class='highlight highlight--color-1'>voordelen</span></h2>
          <h3 class='t--regular t--lightest text-center'>Voor jou en je praktijk</h3>
        </div>
      </div>
      <div class="row" data-equalizer data-equalize-on="medium">
        <div class="medium-6 large-4 columns m-t-40" data-equalizer-watch>
          <div class="icon-card icon-card--bounce-up">
          <div class="icon-card__image">
              <img src="img/icon-world.svg" alt="">
          </div>
          <h3 class="icon-card__title">
            Zet je praktijk op de kaart
          </h3>
          <span class="icon-card__text">
            Beperk je niet tot <br> pen en papier.
          </span>
        </div>
      </div>
        <div class="medium-6 large-4 columns m-t-40" data-equalizer-watch>
          <div class="icon-card icon-card--bounce-up">
          <div class="icon-card__image">
              <img src="img/icon-reusework.svg" alt="">
          </div>
          <h3 class="icon-card__title">
            Deel werk onder logopedisten
          </h3>
          <span class="icon-card__text">
            Net zoals bij de logopediste, <br> maar dan online.
          </span>
        </div>

        </div>

        <div class="medium-12 large-4 columns m-t-40" data-equalizer-watch>

            <div class="icon-card icon-card--bounce-up">
            <div class="icon-card__image">
                <img src="img/icon-progress.svg" alt="">
            </div>
            <h3 class="icon-card__title">
              Volg de progressie op
            </h3>
            <span class="icon-card__text">
              Terwijl cliëntjes oefeningen maken, bekijk jij hun progressie.
            </span>
          </div>

          </div>
      </div>
    </div>
    <div class="section section--color-1 m-t-120">
      <div class="section__header section__header--color-1">
        <div class="row f-row">
          <div class="large-12 columns">
            <h1 class='section__headertitle'>Oke, teken het uit<br>voor de duidelijkheid.</h1>
          </div>
        </div>
      </div>
      <div class="masonry" >
      <div class="row f-row medium-collapse" data-equalizer data-equalize-on="medium" >
        <div class="masonry__small-c large-6 columns" data-equalizer-watch>
          <div class="row f-row masonry__top-row medium-collapse" >
            <div class="large-6 columns p-rel">
              <img src="img/kid-running.jpg" alt="">
            </div>
            <div class="large-6 columns p-rel">
              <div class="masonry__colored">
                <i class='icon-rocket'></i>
              </div>
            </div>
          </div>
          <div class="row f-row masonry__bot-row">
            <div class="masonry__text large-12 columns">
              <h2 class='t--semi-bold'>Jouw passe, gemakkelijker.</h2>
              <h3 class='t--regular t--lightest'>Blijf verbonden met cliëntjes</h3>
              <p class='m-t-50'>Sed ut perspiciatis unde omnis iste natus error sit <span class='t--semi-bold'>voluptatem</span> accusantium doloremque laudantium, <span class='t--semi-bold'>voluptatem</span> aperiam, eaque ipsa quae ab illo <span class='t--semi-bold'>voluptatem</span>.</p>
              <a class='btn btn--ghst btn--ghst--inv m-t-40' href="{{ route('practitioner.register.show')}}" target="_self">vraag account aan</a>
            </div>
          </div>

        </div>
        <div class="masonry__big-c large-6 columns" data-equalizer-watch>
          <div class="masonry__big-inner">
            <h3 class='masonry__brand'>solvr</h3>
            {{-- <span class='masonry__subtitle'>Platform voor logopedisten</span> --}}
          </div>
        </div>

      </div>
      </div>
    </div>

  </div>
  {{-- <div class="c-container ">
    <div class="mixed-jumbo mixed-jumbo--shaped-circle m-t-60">
      <div class="mixed-jumbo__content">
        <div class="row">
          <div class="large-12 columns">
            <h1>Logopedisten, <br>deze is voor jullie.</h1>
          </div>
        </div>
      </div>
      <div class="mixed-jumbo__background mixed-jumbo__background--color-2">
      </div>
    </div>
    <div class="img-jumbo img-jumbo--cometboi m-t-60">
    </div>
  </div> --}}
@endsection

@section('footer')
  @include('includes.footer')
@endsection
