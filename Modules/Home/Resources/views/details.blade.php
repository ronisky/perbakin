@extends('layouts.detail')
@section('title', 'Detail')

@section('content')


<div class="section p-0">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-10 offset-md-1 mt-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="fa fa-home mr-2 text-muted"></i><a
                                href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>

                <div class="card blog-item">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-2 text-muted px-3 pt-3">
                                {{ $created }}
                            </div>
                            <h4 class="blog-item__title px-3 pt-2">{{ $title }}</h4>
                            <a target="_blank" href="{{ url('/storage/uploads/images/'.$image) }}">
                                <img src="{{ url('storage/uploads/images/'.$image) }}" class="card-img-top p-2"
                                    alt="{{ $title }}">
                            </a>

                            <div class="card-body px-3 pt-2">
                                <div class="blog-item__content content">
                                    {{ strip_tags($content) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
