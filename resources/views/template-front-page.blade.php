{{--
  Template Name: Trang chủ
--}}

@extends('layouts.app')

@section('content')
  <div id="fullpage">
    <div class="section" data-anchor="video" data-tooltip="Video">
      <x-video-section />
    </div>

    <div class="section" data-anchor="tong-quan" data-tooltip="Tổng quan">
      <x-introduction-section />
    </div>

    <div class="section" data-anchor="vi-tri" data-tooltip="Vị trí">
      <x-location-section />
    </div>

    <div class="section" data-anchor="mat-bang" data-tooltip="Mặt bằng">
      <x-floor-plan-section />
    </div>

    <div class="section" data-anchor="loi-the" data-tooltip="Lợi thế">
      <x-advantage-section />
    </div>

    <div class="section" data-anchor="doi-tac" data-tooltip="Đối tác">
      <x-partner-section />
    </div>

    <div class="section" data-anchor="tin-tuc" data-tooltip="Tin tức">
      <x-news-section />
    </div>

    <div class="section" data-anchor="lien-he" data-tooltip="Liên hệ">
      <x-contact-section />
    </div>
  </div>
@endsection
