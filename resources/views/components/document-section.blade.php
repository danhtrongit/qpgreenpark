@php
    // Get ACF data from options page
    $document_title = get_field('tai_lieu_tieu_de', 'option') ?: 'Bản vẽ tổng thể';
    $document_subtitle = get_field('tai_lieu_phu_de', 'option') ?: 'Tài liệu dự án';
    $document_list = get_field('tai_lieu_danh_sach', 'option') ?: [];

    // Fallback data if no ACF data is available
    if (empty($document_list)) {
        $document_list = [
            [
                'ten' => 'Bản vẽ tổng thể',
                'mo_ta' => 'Bản vẽ tổng thể của dự án',
                'file' => ['url' => '/wp-content/uploads/2025/08/2025-05-12_KDC-QP3-THUYET-MINH-TKYT.pdf'],
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
            ],
            [
                'ten' => 'Bản vẽ tổng thể',
                'mo_ta' => 'Bản vẽ tổng thể của dự án',
                'file' => ['url' => '/wp-content/uploads/2025/08/2025-05-12_KDC-QP3-THUYET-MINH-TKYT.pdf'],
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
            ],
            [
                'ten' => 'Bản vẽ tổng thể',
                'mo_ta' => 'Bản vẽ tổng thể của dự án',
                'file' => ['url' => '/wp-content/uploads/2025/08/2025-05-12_KDC-QP3-THUYET-MINH-TKYT.pdf'],
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
            ],
            [
                'ten' => 'Bản vẽ tổng thể',
                'mo_ta' => 'Bản vẽ tổng thể của dự án',
                'file' => ['url' => '/wp-content/uploads/2025/08/2025-05-12_KDC-QP3-THUYET-MINH-TKYT.pdf'],
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
            ],
            [
                'ten' => 'Bản vẽ tổng thể',
                'mo_ta' => 'Bản vẽ tổng thể của dự án',
                'file' => ['url' => '/wp-content/uploads/2025/08/2025-05-12_KDC-QP3-THUYET-MINH-TKYT.pdf'],
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
            ],
        ];
    }
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center">

    <div class="container text-center p-4 py-16">

        <h2
            class="text-2xl font-base bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text uppercase mb-4">
            {{ $document_subtitle }}
        </h2>
        <h1 class="text-4xl font-bold uppercase mb-8 lg:mb-16">{{ $document_title }}</h1>


        {{-- document carousel with navigation --}}
        <div class="document-carousel-wrapper relative">
            <div class="owl-carousel owl-document">
                @foreach ($document_list as $index => $item)
                    @php
                        $image_url = $item['hinh_anh']['url'] ?? ($item['image']['url'] ?? '');
                        $file_url = $item['file']['url'] ?? '';
                        $document_name = $item['ten'] ?? ($item['title'] ?? 'Tài liệu ' . ($index + 1));
                        $document_alt = $document_name;
                    @endphp
                    <div class="item group relative document-item overflow-hidden rounded-2xl">
                        <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-110"
                            src="{{ $image_url }}" alt="{{ $document_alt }}">

                        {{-- File link with enhanced hover effect --}}
                        <a href="{{ $file_url }}" target="_blank" rel="noopener noreferrer"
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">

                            {{-- File icon with animation - perfectly centered --}}
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <div
                                    class="size-16 rounded-full bg-secondary-lighter/90 backdrop-blur-sm border-2 border-secondary-lighter shadow-lg flex items-center justify-center transform scale-75 group-hover:scale-100 transition-all duration-300">
                                    <i class="fa-light fa-file-pdf text-white text-2xl font-bold"></i>
                                </div>

                                {{-- Ripple effect --}}
                                <div
                                    class="absolute inset-0 rounded-full bg-secondary-lighter/30 animate-ping opacity-0 group-hover:opacity-100">
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Navigation overlay bottom right --}}
            <div class="absolute -bottom-16 right-1/2 translate-x-1/2 flex items-center gap-4 z-10">
                <button type="button" class="document-prev slide-prev">
                    <i class="fa-light fa-arrow-left text-lg"></i>
                </button>

                <div class="text-white font-bold text-xl">
                    <span class="document-current text-secondary-lighter">01</span>
                    <span class="text-white/60"> / </span>
                    <span
                        class="document-total text-white/60">{{ count($document_list) < 10 ? '0' . count($document_list) : count($document_list) }}</span>
                </div>

                <button type="button" class="document-next slide-next">
                    <i class="fa-light fa-arrow-right text-lg"></i>
                </button>
            </div>
        </div>

    </div>


</div>
