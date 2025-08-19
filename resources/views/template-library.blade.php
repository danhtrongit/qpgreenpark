{{--
  Template Name: Thư viện
--}}

@extends('layouts.app')

@section('content')
  <div data-fullpage>
    <div class="section" data-anchor="thu-vien" data-tooltip="Thư viện">
      <x-perspective-section />
    </div>

    <div class="section" data-anchor="tai-lieu" data-tooltip="Tài liệu">
      <x-document-section />
    </div>

    <div class="section" data-anchor="lien-he" data-tooltip="Liên hệ">
      <x-contact-section />
    </div>
  </div>
@endsection
