@php
    // Get utilities data from ACF options
    $utilities_title = get_field('tien_ich_tieu_de', 'option') ?: 'resort cao cấp';
    $utilities_subtitle = get_field('tien_ich_phu_de', 'option') ?: 'Tiện ích phong cách';
    $utilities_count = get_field('tien_ich_so_luong', 'option') ?: 20;
    $utilities_description = get_field('tien_ich_mo_ta', 'option') ?: 'Dự án được quy hoạch để trở thành một "tuyến phố thương mại sầm uất" với các dãy shophouse hiện đại ở mặt tiền. Đây là nơi lý tưởng để phát triển các dịch vụ cao cấp, cửa hàng thời trang, và nhà hàng sang trọng. Bên cạnh đó, dự án chú trọng đến không gian sống xanh, thân thiện với môi trường thông qua các mảng xanh được tích hợp tại ban công và sân thượng của mỗi ngôi nhà, giúp tăng thêm sức sống cho khu ở.';
    $utilities_list = get_field('tien_ich_danh_sach', 'option') ?: [];

    // Default utilities if no ACF data
    if (empty($utilities_list)) {
        $utilities_list = [
            [
                'ten' => 'PICKLEBALL',
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
                'mo_ta_ngan' => ''
            ],
            [
                'ten' => 'SÂN TENNIS',
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
                'mo_ta_ngan' => ''
            ],
            [
                'ten' => 'HỒ BƠI',
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
                'mo_ta_ngan' => ''
            ]
        ];
    }
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center">

    <div class="container p-4 py-16">
        <div class="grid lg:grid-cols-2 gap-8 mb-12 lg:mb-16">
            <div class="col-span-1 flex gap-8 items-end">
                <div
                    class="text-9xl font-bold font-serif bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text">
                    {{ $utilities_count }}</div>
                <div class="text-left mb-4">
                    <h2
                        class="text-2xl font-base bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text uppercase">
                        {{ $utilities_subtitle }}</h2>
                    <h1 class="text-4xl font-bold uppercase">{{ $utilities_title }}</h1>
                </div>
            </div>
            <div class="col-span-1">
                <p>{{ $utilities_description }}</p>
            </div>
        </div>

        {{-- carousel tiện ích --}}
        <div class="utilities-carousel-wrapper relative">
            <div class="owl-carousel owl-utilities">
                @foreach($utilities_list as $utility)
                    <div class="item utilities-item relative overflow-hidden rounded-2xl pt-[56.25%]">
                        <img class="w-full h-full absolute top-0 left-0 object-cover"
                             src="{{ $utility['hinh_anh']['url'] ?? '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg' }}"
                             alt="{{ $utility['ten'] ?? 'Tiện ích' }}">

                        {{-- Text overlay bottom left --}}
                        <div class="absolute bottom-0 left-0">
                            <div class="bg-black/80 text-white px-6 py-3 utilities-label-corner">
                                <span class="text-lg font-bold uppercase tracking-wide">{{ $utility['ten'] ?? 'TIỆN ÍCH' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Navigation overlay bottom right --}}
            <div class="absolute bottom-6 right-6 flex items-center gap-4 z-10">
                <button type="button" class="utilities-prev size-12 rounded-full bg-black/50 text-white/80 hover:text-white hover:bg-black/70 flex items-center justify-center transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fa-light fa-arrow-left text-lg"></i>
                </button>

                <div class="text-white font-bold text-xl">
                    <span class="utilities-current text-secondary-lighter">01</span>
                    <span class="text-white/60"> / </span>
                    <span class="utilities-total text-white/60">{{ count($utilities_list) < 10 ? '0' . count($utilities_list) : count($utilities_list) }}</span>
                </div>

                <button type="button" class="utilities-next size-12 rounded-full bg-black/50 text-white/80 hover:text-white hover:bg-black/70 flex items-center justify-center transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fa-light fa-arrow-right text-lg"></i>
                </button>
            </div>
        </div>
    </div>

</div>
