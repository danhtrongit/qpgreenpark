@php
    // ACF fields from options
    $title = get_field('mat_bang_tieu_de', 'option') ?: 'Mặt bằng tổng thể';
    $subtitle = get_field('mat_bang_phu_de', 'option') ?: 'Sơ đồ dự án';
    $items = get_field('mat_bang_danh_sach', 'option') ?: [];

    // Helpers
    $format_area = function($value) {
        if ($value === null || $value === '') return '';
        if (is_numeric($value)) {
            return number_format((float)$value, 2, '.', ',') . ' m²';
        }
        // If already contains m² or text, just return as-is
        return $value;
    };

    $map_loai = function($loai) {
        switch ($loai) {
            case 'townhouse':
                return 'Nhà ở Liên kế (Townhouse)';
            case 'shophouse':
                return 'Nhà ở Thương mại (Shophouse)';
            default:
                return '';
        }
    };

    $map_vi_tri = function($v) {
        switch ($v) {
            case 'can-giua': return 'Căn giữa';
            case 'can-goc': return 'Căn góc';
            default: return '';
        }
    };

    // Fallback demo data while waiting for PDF and ACF setup
    if (empty($items)) {
        $items = [
            [
                'ten' => 'Mặt bằng tổng thể',
                'mo_ta' => 'Bố cục tổng thể dự án',
                'hinh_anh' => ['url' => '/wp-content/uploads/placeholder-floor-1.jpg'],
                'file' => ['url' => '#'],
            ],
            [
                'ten' => 'Mặt bằng phân khu',
                'mo_ta' => 'Phân khu chức năng',
                'hinh_anh' => ['url' => '/wp-content/uploads/placeholder-floor-2.jpg'],
                'file' => ['url' => '#'],
            ],
        ];
    }
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center">
    <div class="container text-center p-4 py-16">
        <h2 class="text-2xl font-base bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text uppercase mb-4">
            {{ $subtitle }}
        </h2>
        <h1 class="text-4xl font-bold uppercase mb-8 lg:mb-16">{{ $title }}</h1>

        <div class="floorplan-carousel-wrapper relative">
            <div class="owl-carousel owl-floorplan">
                @foreach ($items as $index => $item)
                    @php
                        $image_url = $item['hinh_anh']['url'] ?? ($item['image']['url'] ?? '');
                        $file_url = $item['file']['url'] ?? ($item['url'] ?? '');
                        $name = $item['ten'] ?? ($item['title'] ?? 'Mặt bằng ' . ($index + 1));
                        $alt = $name;
                        $desc = $item['mo_ta'] ?? ($item['description'] ?? '');
                        $ma_mau = $item['ma_mau'] ?? '';
                        $kich_thuoc_dat = $item['kich_thuoc_dat'] ?? '';
                        $tong_xd = $item['tong_dien_tich_xay_dung'] ?? '';
                    @endphp
                    <div class="item group relative overflow-hidden rounded-2xl bg-gray-900/30">
                        @if ($image_url)
                            <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $image_url }}" alt="{{ $alt }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-100 group-hover:opacity-100 transition-opacity"></div>
                        @endif

                        <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-7 flex flex-col text-left space-y-2">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-xl font-semibold text-white">{{ $name }}</h3>
                                @php $loai = $map_loai($item['loai'] ?? null); $vi_tri = $map_vi_tri($item['vi_tri'] ?? null); @endphp
                                @if($loai)
                                    <span class="text-[11px] uppercase tracking-wide px-2 py-1 rounded bg-secondary-lighter/20 text-secondary-lighter">{{ $loai }}</span>
                                @endif
                                @if($vi_tri)
                                    <span class="text-[11px] uppercase tracking-wide px-2 py-1 rounded bg-white/10 text-white/80">{{ $vi_tri }}</span>
                                @endif
                            </div>

                            @if ($ma_mau || $kich_thuoc_dat || ($item['dien_tich_dat'] ?? null) || $tong_xd)
                                <div class="text-white/90 text-xs lg:text-sm leading-relaxed">
                                    <div class="flex flex-wrap gap-x-4 gap-y-1">
                                        @if ($ma_mau)
                                            <span>Mã: <strong>{{ $ma_mau }}</strong></span>
                                        @endif
                                        @if ($kich_thuoc_dat)
                                            <span>KT đất: <strong>{{ $kich_thuoc_dat }}</strong></span>
                                        @endif
                                        @if (!empty($item['dien_tich_dat']))
                                            <span>DT đất: <strong>{{ $format_area($item['dien_tich_dat']) }}</strong></span>
                                        @endif
                                        @if ($tong_xd)
                                            <span>Tổng XD: <strong>{{ $format_area($tong_xd) }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @php $quy_cach = $item['quy_cach'] ?? ''; @endphp
                            @if ($quy_cach)
                                <p class="text-white/80 text-xs lg:text-sm">Quy cách: {{ $quy_cach }}</p>
                            @endif

                            @php $ds_tang = $item['dien_tich_tang'] ?? []; @endphp
                            @if (is_array($ds_tang) && count($ds_tang))
                                <div class="mt-2 text-white/90 text-xs lg:text-sm">
                                    <div class="font-semibold">Diện tích theo tầng:</div>
                                    <ul class="mt-1 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-0.5">
                                        @foreach ($ds_tang as $t)
                                            @php
                                                $ten_tang = $t['ten_tang'] ?? '';
                                                $dt_tang = $t['dien_tich'] ?? '';
                                            @endphp
                                            <li class="flex items-center justify-between">
                                                <span class="text-white/80">{{ $ten_tang }}</span>
                                                <span class="text-white">{{ $format_area($dt_tang) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if ($desc)
                                <p class="text-white/80 text-xs lg:text-sm">{{ $desc }}</p>
                            @endif
                        </div>

                        @if ($file_url)
                            <a href="{{ $file_url }}" target="_blank" rel="noopener" class="absolute inset-0" aria-label="{{ $name }}"></a>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="absolute -bottom-16 right-1/2 translate-x-1/2 flex items-center gap-4 z-10">
                <button type="button" class="floorplan-prev slide-prev">
                    <i class="fa-light fa-arrow-left text-lg"></i>
                </button>
                <div class="text-white font-bold text-xl">
                    <span class="floorplan-current text-secondary-lighter">01</span>
                    <span class="text-white/60"> / </span>
                    <span class="floorplan-total text-white/60">{{ count($items) < 10 ? '0' . count($items) : count($items) }}</span>
                </div>
                <button type="button" class="floorplan-next slide-next">
                    <i class="fa-light fa-arrow-right text-lg"></i>
                </button>
            </div>
        </div>
    </div>
</div>

