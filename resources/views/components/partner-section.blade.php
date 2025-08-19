@php
    use function App\get_chu_dau_tu;
    use function App\get_doi_tac_chien_luoc;
    use function App\get_doi_tac_phan_phoi;

    $chu_dau_tu = get_chu_dau_tu();
    $doi_tac_chien_luoc = get_doi_tac_chien_luoc();
    $doi_tac_phan_phoi = get_doi_tac_phan_phoi();
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center">

    <div class="container p-4 py-12 lg:pt-12">
        <h2 class="text-2xl lg:text-4xl font-base uppercase mb-4 text-center" data-aos="fade-down" data-aos-duration="600" data-aos-delay="200">
            Chủ đầu tư
        </h2>
        <div class="flex items-center" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
            <div class="bg-secondary-lighter flex-1 h-0.5 w-full opacity-10"></div>
            <div class="size-3 bg-secondary-light rounded-full opacity-20"></div>
            <div class="bg-secondary-lighter flex-1 h-0.5 w-full opacity-10"></div>

        </div>

        @if ($chu_dau_tu['logo'])
            <img class="w-40 lg:w-60 mx-auto" src="{{ $chu_dau_tu['logo']['url'] }}"
                alt="{{ $chu_dau_tu['ten_cong_ty'] }}" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">
        @else
            <img class="w-40 lg:w-60 mx-auto" src="/wp-content/uploads/2025/08/logo.svg"
                alt="{{ $chu_dau_tu['ten_cong_ty'] }}" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">
        @endif

        <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 mt-8">

            <div class="text-center" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">

                <h2
                    class="text-lg lg:text-2xl font-base bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text uppercase mb-4 lg:mb-8">
                    ĐỐI TÁC PHÂN PHỐI</h2>

                <div class="bg-primary-50/5 p-4 rounded">
                    {{-- Mobile/Tablet: Grid (no slider) --}}
                    <div class="grid grid-cols-4 gap-4 sm:grid-cols-4 lg:hidden">
                        @if ($doi_tac_phan_phoi && count($doi_tac_phan_phoi) > 0)
                            @foreach ($doi_tac_phan_phoi as $partner)
                                @if ($partner['logo'])
                                    @if ($partner['website'])
                                        <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                            <img class="h-12 sm:h-14 w-auto mx-auto object-contain hover:opacity-80 transition-opacity"
                                                src="{{ $partner['logo']['url'] }}"
                                                alt="{{ $partner['ten_cong_ty'] }}"
                                                title="{{ $partner['ten_cong_ty'] }}">
                                        </a>
                                    @else
                                        <img class="h-12 sm:h-14 w-auto mx-auto object-contain" src="{{ $partner['logo']['url'] }}"
                                            alt="{{ $partner['ten_cong_ty'] }}"
                                            title="{{ $partner['ten_cong_ty'] }}">
                                    @endif
                                @endif
                            @endforeach
                        @else
                            @for ($i = 0; $i < 5; $i++)
                                <img class="h-12 sm:h-14 w-auto mx-auto object-contain" src="/wp-content/uploads/2025/08/logo.svg"
                                    alt="QP Green Park">
                            @endfor
                        @endif
                    </div>

                    {{-- Desktop: Owl Carousel --}}
                    <div class="hidden lg:block">
                        <div class="owl-carousel owl-partner">
                            @if ($doi_tac_phan_phoi && count($doi_tac_phan_phoi) > 0)
                                @foreach ($doi_tac_phan_phoi as $partner)
                                    @if ($partner['logo'])
                                        <div class="item">
                                            @if ($partner['website'])
                                                <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                                    <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain hover:opacity-80 transition-opacity"
                                                        src="{{ $partner['logo']['url'] }}"
                                                        alt="{{ $partner['ten_cong_ty'] }}"
                                                        title="{{ $partner['ten_cong_ty'] }}">
                                                </a>
                                            @else
                                                <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain" src="{{ $partner['logo']['url'] }}"
                                                    alt="{{ $partner['ten_cong_ty'] }}"
                                                    title="{{ $partner['ten_cong_ty'] }}">
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                {{-- Fallback content if no partners are set --}}
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="item">
                                        <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain" src="/wp-content/uploads/2025/08/logo.svg"
                                            alt="QP Green Park">
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>

            </div>


            <div class="text-center" data-aos="fade-left" data-aos-duration="800" data-aos-delay="600">

                <h2
                    class="text-lg lg:text-2xl font-base bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text uppercase mb-4 lg:mb-8">
                    ĐỐI TÁC CHIẾN LƯỢC</h2>

                <div class="bg-primary-50/5 p-4 rounded">
                    {{-- Mobile/Tablet: Grid (no slider) --}}
                    <div class="grid grid-cols-4 gap-4 sm:grid-cols-4 lg:hidden">
                        @if ($doi_tac_chien_luoc && count($doi_tac_chien_luoc) > 0)
                            @foreach ($doi_tac_chien_luoc as $partner)
                                @if ($partner['logo'])
                                    @if ($partner['website'])
                                        <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                            <img class="h-12 sm:h-14 w-auto mx-auto object-contain hover:opacity-80 transition-opacity"
                                                src="{{ $partner['logo']['url'] }}"
                                                alt="{{ $partner['ten_cong_ty'] }}"
                                                title="{{ $partner['ten_cong_ty'] }}">
                                        </a>
                                    @else
                                        <img class="h-12 sm:h-14 w-auto mx-auto object-contain" src="{{ $partner['logo']['url'] }}"
                                            alt="{{ $partner['ten_cong_ty'] }}"
                                            title="{{ $partner['ten_cong_ty'] }}">
                                    @endif
                                @endif
                            @endforeach
                        @else
                            @for ($i = 0; $i < 5; $i++)
                                <img class="h-12 sm:h-14 w-auto mx-auto object-contain" src="/wp-content/uploads/2025/08/logo.svg"
                                    alt="QP Green Park">
                            @endfor
                        @endif
                    </div>

                    {{-- Desktop: Owl Carousel --}}
                    <div class="hidden lg:block">
                        <div class="owl-carousel owl-partner">
                            @if ($doi_tac_chien_luoc && count($doi_tac_chien_luoc) > 0)
                                @foreach ($doi_tac_chien_luoc as $partner)
                                    @if ($partner['logo'])
                                        <div class="item">
                                                @if ($partner['website'])
                                                    <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                                        <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain hover:opacity-80 transition-opacity"
                                                            src="{{ $partner['logo']['url'] }}"
                                                            alt="{{ $partner['ten_cong_ty'] }}"
                                                            title="{{ $partner['ten_cong_ty'] }}">
                                                    </a>
                                                @else
                                                    <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain" src="{{ $partner['logo']['url'] }}"
                                                        alt="{{ $partner['ten_cong_ty'] }}"
                                                        title="{{ $partner['ten_cong_ty'] }}">
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                            @else
                                {{-- Fallback content if no partners are set --}}
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="item">
                                        <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain" src="/wp-content/uploads/2025/08/logo.svg"
                                            alt="QP Green Park">
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
