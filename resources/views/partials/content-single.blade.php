<div class="container p-4">
    <article @php(post_class('h-entry  mt-20 bg-white max-w-3xl mx-auto p-8 rounded-lg shadow'))>
        <header>
            <h1 class="p-name text-xl lg:text-3xl font-bold mb-4 text-primary-950 uppercase">
                {!! $title !!}
            </h1>

            @include('partials.entry-meta')
        </header>

        <div class="e-content prose">
            @php(the_content())
        </div>

        @if ($pagination)
            <footer>
                <nav class="page-nav" aria-label="Page">
                    {!! $pagination !!}
                </nav>
            </footer>
        @endif

    </article>


    <div class="mt-20">

      <h2 class="uppercase text-2xl lg:text-4xl text-white text-center">
        Tin <strong class="bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text">liên quan</strong>
      </h2>

    </div>

</div>
<x-contact-section />
