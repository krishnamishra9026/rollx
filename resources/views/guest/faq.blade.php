@extends('layouts.app')
@section('title', 'FAQs')
@section('content')
<div class="contact-page">
    <div class="container">
        <h1>FAQs</h1>
    </div>
</div>
<div class="all-faq">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="accordion custom-accordion" id="custom-accordion-one">
                    @if($faqs && count($faqs))
                    @foreach($faqs as $key => $faq)

                    @php
                    
                    switch (app()->getLocale()) {
                      case 'nl':
                        $title = $faq->title_nl;
                        $description = $faq->description_nl;
                        break;
                      case 'es':
                        $title = $faq->title_es;
                        $description = $faq->description_es;
                        break;
                      case 'pl':
                        $title = $faq->title_pl;
                        $description = $faq->description_pl;
                        break;
                    case 'no':
                        $title = $faq->title_no;
                        $description = $faq->description_no;
                        break;
                      default:
                        $title = $faq->title;
                        $description = $faq->description;
                        break;
                    }

                    @endphp
                    <div class="card mb-2">
                        <div class="card-header" id="headingOne">
                            <h5 class="m-0">
                                <a class="custom-accordion-title d-block py-1" data-toggle="collapse" href="#collapse{{ $faq->id }}"
                                    aria-expanded="@if(!$key) true @else false @endif" aria-controls="collapse{{ $faq->id }}">
                                    Q. {{ $title }}? <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse{{ $faq->id }}" class="collapse @if(!$key) show @else  @endif" aria-labelledby="headingOne"
                            data-parent="#custom-accordion-one">
                            <div class="card-body">
                                {!! $description !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div style="display: none;" class="card mb-2">
                        <div class="card-header" id="headingThree">
                            <h5 class="m-0">
                                <a class="custom-accordion-title d-block py-1" data-toggle="collapse" href="#collapseThree"
                                    aria-expanded="true" aria-controls="collapseThree">
                                    Q. What is Lorem Ipsum? <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#custom-accordion-one">
                            <div class="card-body">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley of type and scrambled it to make a type specimen book. It has survived not only five
                                centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                passages, and more recently with desktop publishing software like Aldus PageMaker including
                                versions of Lorem Ipsum.
                            </div>
                        </div>
                    </div>
                    
                </div>
                    {{ $faqs->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
