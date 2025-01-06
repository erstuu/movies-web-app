@extends('layouts.app')

@section('content')

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <div class="card h-100">
                        {{-- <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}"> --}}

                        <div class="image-container" style="height: 450px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $movie->title }}">
                        </div>

                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader mb-2">{{ $movie->year }}</div>
                            </div>

                            <div class="h1 mb-2">{{ $movie->title }}</div>

                            <div class="d-flex mb-1">
                                <div class="p"><strong>Genre:</strong> {{ $movie->genre->name }}</div>
                            </div>

                            <div class="d-flex mb-1">
                                <div class="p"><strong>Available:</strong> {{ $movie->available ? 'Yes' : 'No' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection