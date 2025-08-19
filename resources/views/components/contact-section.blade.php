<div class="h-auto lg:h-screen relative grid content-center overflow-hidden">

    <div class="absolute inset-0 z-0 bg-no-repeat bg-contain bg-left opacity-20"
    style="background-image: url('{{ wp_get_attachment_image_url(14, 'full') }}')"
    >
    </div>

    <div class="container max-w-5xl p-4 py-8 mx-auto relative z-10">
        <div class="grid lg:grid-cols-2 items-center gap-8 lg:gap-16">
            <div class="col-span-1" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                <div class="mb-8" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="400">
                    {!! wp_get_attachment_image(7, 'full', '', 'class=w-40 h-auto') !!}
                </div>
                <div class="space-y-4">
                    {{-- Address --}}
                    <div class="flex items-start gap-4">
                        <div
                            class="bg-secondary-mid/20 size-10 rounded-full flex-shrink-0 flex items-center justify-center">
                            <i class="fa-light fa-location-dot text-secondary-dark"></i>
                        </div>
                        <div class="space-y-0 flex-1">
                            <h4 class="text-base font-normal">Địa chỉ</h4>
                            <p class="text-sm">{{ \App\get_contact_address() }}</p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="flex items-start gap-4">
                        <div
                            class="bg-secondary-mid/20 size-10 rounded-full flex-shrink-0 flex items-center justify-center">
                            <i class="fa-light fa-phone text-secondary-dark"></i>
                        </div>
                        <div class="space-y-0 flex-1">
                            <h4 class="text-base font-normal">Hotline</h4>
                            <p class="text-sm">
                                <a href="tel:{{ \App\get_contact_phone_link() }}" class="hover:text-secondary-dark transition-colors">
                                    {{ \App\get_contact_phone() }}
                                </a>
                            </p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-start gap-4">
                        <div
                            class="bg-secondary-mid/20 size-10 rounded-full flex-shrink-0 flex items-center justify-center">
                            <i class="fa-light fa-envelope text-secondary-dark"></i>
                        </div>
                        <div class="space-y-0 flex-1">
                            <h4 class="text-base font-normal">Email</h4>
                            <p class="text-sm">
                                <a href="mailto:{{ \App\get_contact_email() }}" class="hover:text-secondary-dark transition-colors">
                                    {{ \App\get_contact_email() }}
                                </a>
                            </p>
                        </div>
                    </div>

                    {{-- Fax --}}
                    @if(\App\get_contact_fax())
                        <div class="flex items-start gap-4">
                            <div
                                class="bg-secondary-mid/20 size-10 rounded-full flex-shrink-0 flex items-center justify-center">
                                <i class="fa-light fa-fax text-secondary-dark"></i>
                            </div>
                            <div class="space-y-0 flex-1">
                                <h4 class="text-base font-normal">Fax</h4>
                                <p class="text-sm">{{ \App\get_contact_fax() }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Website --}}
                    @if(\App\get_contact_website())
                        <div class="flex items-start gap-4">
                            <div
                                class="bg-secondary-mid/20 size-10 rounded-full flex-shrink-0 flex items-center justify-center">
                                <i class="fa-light fa-globe text-secondary-dark"></i>
                            </div>
                            <div class="space-y-0 flex-1">
                                <h4 class="text-base font-normal">Website</h4>
                                <p class="text-sm">
                                    <a href="{{ \App\get_contact_website() }}" target="_blank" rel="noopener noreferrer" class="hover:text-secondary-dark transition-colors">
                                        {{ str_replace(['https://', 'http://'], '', \App\get_contact_website()) }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Social Media --}}
                    @if(\App\get_social_links())
                        <div class="flex items-start gap-4">
                            <div class="space-y-0 flex-1">
                                <div class="mt-2">
                                    {!! \App\display_social_links(
                                        'flex gap-2',
                                        'w-8 h-8 bg-secondary-mid/20 hover:bg-secondary-dark hover:text-white rounded-full flex items-center justify-center transition-all duration-300 text-sm',
                                        false
                                    ) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-span-1" data-aos="fade-left" data-aos-duration="800" data-aos-delay="600">
                <x-form.form-contact/>
            </div>
        </div>
    </div>
</div>
