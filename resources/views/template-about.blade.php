{{--
  Template Name: Giới thiệu
--}}

@extends('layouts.app')

@section('content')
  <div data-fullpage>
    <div class="section" data-anchor="video" data-tooltip="Video" data-aos="fade-up" data-aos-duration="800">
      <x-video-section />
    </div>

    <div class="section" data-anchor="tong-quan" data-tooltip="Tổng quan" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
      <x-overview-section />
    </div>

    <div class="section" data-anchor="loi-the" data-tooltip="Lợi thế" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
      <x-advantage-section />
    </div>

    <div class="section" data-anchor="doi-tac" data-tooltip="Đối tác" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
      <x-partner-section />
    </div>

    <div class="section" data-anchor="lien-he" data-tooltip="Liên hệ" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
      <x-contact-section />
    </div>
  </div>
@endsection
