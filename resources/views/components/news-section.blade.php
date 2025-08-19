<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center">

    <div class="container p-4 py-12 lg:pt-16">

        <h2 class="text-2xl text-center lg:text-4xl uppercase font-medium mb-8">
            {{ $title ?? __('Tin tức', 'sage') }}
            <strong
                class="bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text">
                {{ __('mới nhất', 'sage') }}
            </strong>
        </h2>

        @if($posts && count($posts) > 0)
            <div class="owl-carousel owl-news">
                @foreach($posts as $item)
                    <div class="item">
                        <x-news-card :post="$item" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Chưa có bài viết nào được đăng.</p>
            </div>
        @endif

    </div>

</div>
