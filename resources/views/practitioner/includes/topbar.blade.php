<div class="top-bar d-top-bar">
  <div class='top-bar-inner'>
    <div class="top-bar-left">
      <ul class='menu'>
        <li>
          <div class="top-bar__item">
            <a id='side-menu-trigger' class="top-bar__i-item d-button">
              <i class='icon-grid'></i><span>Navigatie</span>
            </a>
          </div>
        </li>
      </ul>

    </div>
    <div class="top-bar-right">
      <ul class='menu'>
        <li>
          <div class="top-bar__item-b">
            <div class="top-bar__img-item">
              <div class="img-wrap">
                <img data-name="{{ Auth::guard('practitioner')->user()->firstname }}" class="da-profile">
              </div>
              <span>Hallo, {{ Auth::guard('practitioner')->user()->firstname }}!</span>
            </div>
          </div>
        </li>
        <li>
          <div class="top-bar__item top-bar__item--border-left">

              <i class='icon-bell 2x'></i>


          </div>
        </li>

      </ul>


    </div>
  </div>
</div>