@extends('layouts.app')

@section('content')

  <div class="jumbotron jumbotron--color-1 s-container">

    <div class="row f-row small-collapse">
      <div class="large-12 columns">
        <div class="jumbotron__content">
          <h1>Jij wil <span class='highlight highlight--color-1'>plezier</span> maken,<br>maar ook</h1>

        </div>
      </div>
    </div>

    <span class='jumbotron__big'>bijleren</span>
  </div>







    <div class="s-container s-container--no-p">
      <div class="section__header section__header--color-1 m-t-100">
        <div class="row f-row">
          <div class="large-12 columns">
            <h1 class='section__headertitle'>Wat als je je oefeningen thuis <br> kon maken?</h1>
          </div>
        </div>
      </div>
    </div>
      <div class="full-width-container full-width-container--w-shapes-1">
        <div class="s-container s-container--no-p">
      <div class="section section--type-1 p-t-100 p-b-100">
        <div class="row">
          <div class="section__half large-6 columns">
            <div class="section__half--shapes">

            </div>
            <h2 class='t--semi-bold'>Verken mee met ons</h2>
            <h3 class='t--regular t--lightest m-b-60'>Geraak niet verloren zoals <br> astronaut.</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,</p>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,</p>

            <span class='line-highlight m-t-40'>rekenen, spelling en taal</span>
          </div>
          <div class="large-6 columns">
            <img src="img/astronaut.svg" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="s-container s-container--no-p">
    <div class="section  section--color-1 m-t-120">
      <div class="section__header section__header--color-1">
        <div class="row f-row">
          <div class="large-12 columns">
            <h1 class='section__headertitle'>Oke, maar wat bieden nog <br> jullie meer?</h1>
          </div>
        </div>
      </div>
      <div class="section section--type-2 p-t-100 p-b-100">
        <div class="row">
          <div class="large-12 columns">
            <h2 class='t--semi-bold text-center'>Doe je ook <span class='highlight highlight--color-1'>mee?</span></h2>
            <h3 class='t--regular t--lightest text-center'>Dit platform is voor jullie</h3>
          </div>
        </div>
        <div class="row" data-equalizer data-equalize-on="medium">
          <div class="medium-6 large-4 columns m-t-40" data-equalizer-watch>
            <div class="icon-card icon-card--bounce-up">
              <div class="icon-card__image">
                <img src="img/icon-laptop.svg" alt="">
              </div>
              <h3 class="icon-card__title">
                Overal, elke moment
              </h3>
              <span class="icon-card__text">
                Beperk je niet tot <br> pen en papier.
              </span>
            </div>
          </div>
          <div class="medium-6 large-4 columns m-t-40" data-equalizer-watch>
            <div class="icon-card icon-card--bounce-up">
              <div class="icon-card__image">
                <img src="img/icon-achievement.svg" alt="">
              </div>
              <h3 class="icon-card__title">
                Verdien beloningen
              </h3>
              <span class="icon-card__text">
                Net zoals bij de logopediste, <br> maar dan online.
              </span>
            </div>

          </div>

          <div class="medium-12 large-4 columns m-t-40" data-equalizer-watch>

            <div class="icon-card icon-card--bounce-up">
              <div class="icon-card__image">
                <img src="img/icon-kid.svg" alt="">
              </div>
              <h3 class="icon-card__title">
                Wees trots
              </h3>
              <span class="icon-card__text">
                Je leer enorm veel bij, <br> dat ziet je logopediste.
              </span>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="section m-t-120">
      <div class="section__header section__header--color-1">
        <div class="row f-row">
          <div class="large-12 columns">
            <h1 class='section__headertitle'>Oke, maar wat bieden nog <br> jullie meer?</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="row medium-collapse" data-equalizer data-equalize-on="medium">
      <div class="cta-block clearfix">
        <div class="large-6 columns cta-block__content" data-equalizer-watch>
          <h3 class='cta-block__title'>At vero eos et accusamus</h3>
          <p class='cta-block__text'>laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit</p>
          <a class='btn btn--ghst btn--ghst--inv cta-block__button' href="{{ route('about') }}">registreer mij</a>
          <span class='cta-block__footer'>Bent u een logopediste?</span>
        </div>
        <div class="large-6 columns cta-block__illustration" data-equalizer-watch>

        </div>
      </div>
    </div>
  </div>


  {{-- <div class="section-bimg section-bimg--about row f-row">
  <div class="section-bimg__card large-7 columns">
  <h2 class='section-bimg__title'><span class='highlight highlight--color-1'>Technologie blijft.</span></h2>
  <p class='section-bimg__subtitle'>En dit weten wij, logopedisten, maar al te goed.</p>
  <p class='section-bimg__text'><span>Lorem Ipsum</span> is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak.</p>
  <p class='section-bimg__text'><span>Lorem Ipsum</span> is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst <span>Lorem Ipsum</span> bedrijfstak.</p>
  <p class='section-bimg__text'> is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de <span>Lorem Ipsum</span> proeftekst in deze bedrijfstak.</p>
</div>
</div> --}}
{{-- <div class="section__inner up">
<div class="section__expand section__expand--shape-left">

</div>
<div class="section__inner-inner">


<div class="row" data-equalizer data-equalize-on="medium">
<div class="large-8 columns" data-equalizer-watch>
<div class="card--icon card--shdw">
<div class="row">
<div class="large-7 columns">
<h3 class='card__title'>Weg met websites die dateren van de oertijd.</h3>
<p class='card__text'>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
</div>
<div class="large-5 columns">
<div class="card__image">
<img src="img/dinosaur-new.svg" alt="">
</div>
</div>
</div>
</div>
<div class="card--icon card--shdw m-t-40">
<div class="row">
<div class="large-7 columns">
<h3 class='card__title'>Verdien beloningen!</h3>
<p class='card__text'>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
</div>
<div class="large-5 columns">
<div class="card__image">
<img src="img/achievement-new.svg" alt="">
</div>
</div>
</div>
</div>
</div>
<div class="large-4 columns" data-equalizer-watch>
<div class="card--icon card--shdw card--full-height">
<div class="row">
<div class="large-12 columns">
<div class="card__image">
<img src="img/proud.svg" alt="">
</div>
</div>
<div class="large-12 columns">
<h3 class='card__title'>Wees trots op jezelf.</h3>
<p class='card__text'>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
</div>

</div>
</div>
</div>
</div>
</div>

</div> --}}



{{-- <div class="s-container s-container--no-p">
<div class="row medium-collapse" data-equalizer data-equalize-on="medium">
<div class="cta-block clearfix m-t-120">
<div class="large-6 columns cta-block__content" data-equalizer-watch>
<h3 class='cta-block__title'>At vero eos et accusamus</h3>
<p class='cta-block__text'>laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit</p>
<a class='btn btn--ghst btn--ghst--inv cta-block__button' href="{{ route('about') }}">registreer mij</a>
<span class='cta-block__footer'>Bent u een logopediste?</span>
</div>
<div class="large-6 columns cta-block__illustration" data-equalizer-watch>

</div>
</div>
</div>
</div> --}}
{{-- <div class="row f-row illustration-block m-t-80">
<div class="large-5 columns">
<div class="illustration-block__text">
<span class='illustration-block__b-number'>01.</span>
<h2 class='illustration-block__title'>Goed nieuws!</h2>
<p class='illustration-block__a-text'>
Genoeg met websites die nog dateren van voor de dinosaurussen.
Wij willen er voor zorgen dat elk kindje thuis beter kan worden aan de hand van op maat
gemaakte oefeningendoor zijn/haar logopediste.
</p>
</div>

</div>
<div class="large-7 columns">
<div class="illustration-block__illustration">
<img src="img/dinosaur-alt.svg" alt="">
</div>
</div>
</div>
<div class="row illustration-block m-t-80">
<div class="large-7 large-push-5 columns">
<div class="illustration-block__text">
<span class='illustration-block__b-number'>02.</span>
<h2 class='illustration-block__title'>Beloningen</h2>
<p class='illustration-block__a-text'>
Net zoals bij de logopedisten kan je stickers verdienen.
Alleen deze keer in digitale vorm! Zo kan je met trots je
nieuwste stickers laten zien aan je ouders.
</p>
</div>

</div>
<div class="large-5 large-pull-7 columns">
<div class="illustration-block__illustration">
<img src="img/achievement-4.svg" alt="">
</div>
</div>
</div>
<div class="row illustration-block m-t-80">
<div class="large-5 columns">
<div class="illustration-block__text">
<span class='illustration-block__b-number'>03.</span>
<h2 class='illustration-block__title'>Wees trots!</h2>
<p class='illustration-block__a-text'>
Na al dat oefenen is het tijd dat je trots bent. Je hebt misschien spelling en rekenen bijgeschaafd voor vandaag. Wees blij dat je er werk ingestoken hebt en wees klaar voor de volgende uitdaging!
</p>
</div>

</div>
<div class="large-7 columns">
<div class="illustration-block__illustration">
<img src="img/proud.svg" alt="">
</div>
</div>
</div> --}}

@endsection
