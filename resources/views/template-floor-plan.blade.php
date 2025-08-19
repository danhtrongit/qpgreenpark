{{--
  Template Name: Mặt bằng
--}}

@extends('layouts.app')

@section('content')
  <div data-fullpage>
    <div class="section" data-anchor="mat-bang" data-tooltip="Mặt bằng">
      <x-floor-plan-section />
    </div>

    <div class="section" data-anchor="lien-he" data-tooltip="Liên hệ">
      <x-contact-section />
    </div>
  </div>
@endsection

