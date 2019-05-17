<!-- Header -->
<div class="app-header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      <h1 class="header__title">{{ $slot }}</h1>
      @if (!empty($nav))
      <div class="header__nav">{{ $nav }}</div>
      @endif
    </div>
  </div>
</div>
