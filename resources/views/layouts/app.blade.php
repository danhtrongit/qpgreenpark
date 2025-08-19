<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())

    {{-- Fallback for AOS animations if JavaScript fails --}}
    <script>
      // Add class to html element to indicate JS is working
      document.documentElement.classList.add('js-enabled');

      // Fallback timeout to show content if animations don't start
      setTimeout(function() {
        if (!document.querySelector('.aos-animate')) {
          document.documentElement.classList.add('no-aos');
        }
      }, 3000);
    </script>

    <noscript>
      <style>
        [data-aos] {
          opacity: 1 !important;
          transform: none !important;
        }
      </style>
    </noscript>
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <div id="app" class="content bg-primary-950 text-white relative">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content') }}
      </a>

      @include('sections.header')

      <main id="main" class="main">
        @yield('content')
      </main>

      @hasSection('sidebar')
        <aside class="sidebar">
          @yield('sidebar')
        </aside>
      @endif

      @include('sections.footer')
    </div>

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
