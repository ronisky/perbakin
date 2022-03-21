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
                    <img src="{{ url('storage/uploads/images/'.$image) }}" class="card-img-top" alt="{{ $title }}">

                    <div class="card-body p-5">
                        <div class="mb-2 text-muted">
                            {{ $created }}
                        </div>
                        <h3 class="blog-item__title">{{ $title }}</h3>
                        <hr>

                        <div class="blog-item__content content">
                            {{ strip_tags($content) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
