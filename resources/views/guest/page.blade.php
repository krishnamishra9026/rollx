@extends('layouts.app')
@section('title', $page->meta_title)
@section('meta-desc', $page->meta_description ?? $page->meta_title)
@section('content')


@php

switch (app()->getLocale()) {
    case 'nl':
    $title = $page->name_nl;
    $description = $page->content_nl;
    break;
    case 'es':
    $title = $page->name_es;
    $description = $page->content_es;
    break;
    case 'pl':
    $title = $page->name_pl;
    $description = $page->content_pl;
    break;
    case 'no':
    $title = $page->name_no;
    $description = $page->content_no;
    break;
    default:
    $title = $page->name;
    $description = $page->content;
    break;
}

@endphp

    <div class="about_Us">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="about-caption">
                        <h1>{{ $title }}</h1>
                        <p>{!! $description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
