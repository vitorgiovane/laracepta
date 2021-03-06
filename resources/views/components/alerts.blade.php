@if (session('success'))
  <div class="flash-container">
    <div class="flash-message js-msg" data-type="success" data-timeout="5000" data-theme="light" data-progress>
      {{ session('success') }}
    </div>
  </div>
@endif

@if (session('warning'))
  <div class="flash-container">
    <div class="flash-message js-msg" data-type="warning" data-timeout="5000" data-theme="light" data-progress>
      {{ session('warning') }}
    </div>
  </div>
@endif

@if (session('error'))
  <div class="flash-container">
    <div class="flash-message js-msg" data-type="error" data-timeout="5000" data-theme="light" data-progress>
      {{ session('error') }}
    </div>
  </div>
@endif

@if (!empty($errors))
  <div class="flash-container">
    @foreach ($errors->all() as $error)
      <div class="flash-message js-msg" data-type="warning" data-timeout="10000" data-theme="light" data-progress>
        {{ $error }}
      </div>
    @endforeach
  </div>
@endif
