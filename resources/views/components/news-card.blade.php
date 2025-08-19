{{-- News Card Component --}}
<article
    class="bg-white rounded shadow overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
    {{-- Image Section --}}
    @if ($imageUrl)
        <div class="overflow-hidden relative pt-[56.25%]">
            <a href="{{ $permalink }}" class="block h-full">
                <img src="{{ $imageUrl }}" alt="{{ $title }}"
                    class="w-full h-full absolute top-0 left-0 object-cover group-hover:scale-105 transition-transform duration-500">
            </a>
        </div>
    @endif

    {{-- Content Section --}}
    <div class="p-6 relative">
        {{-- Title --}}
        <h3 class="text-base font-bold text-gray-900 mb-4 line-clamp-2 leading-6 uppercase">
            <a href="{{ $permalink }}" class="hover:text-secondary-mid transition-colors duration-300">
                {{ $title }}
            </a>
        </h3>

        {{-- Excerpt --}}
        @if ($excerpt)
            <div class="text-gray-600 text-sm mb-6 line-clamp-2 leading-relaxed">
                {{ $excerpt }}
            </div>
        @endif

        {{-- Date Section with Special Design --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                {{-- Large Day Number --}}
                <div class="text-4xl font-bold text-secondary-mid">
                    {{ $day }}
                </div>

                {{-- Month.Year --}}
                <div class="text-sm text-gray-500 font-medium">
                    {{ $monthYear }}
                </div>
            </div>

            {{-- Read More Arrow Button --}}
            <a href="{{ $permalink }}"
                class="inline-flex items-center justify-center w-12 h-12 bg-transparent border hover:border-none text-primary-950 border-primary-950/10 hover:bg-gradient-to-r hover:from-secondary-darker hover:to-secondary-lighter  hover:text-white rounded-full transition-all duration-300 transform hover:scale-110 group-hover:translate-x-1">
                <i class="fa-light fa-arrow-right"></i>
            </a>
        </div>

        {{-- Decorative Element --}}
        <div
            class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-secondary-light/20 to-secondary-lighter/10 rounded-bl-full">
        </div>
    </div>
</article>
