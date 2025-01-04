@extends('layouts.app')

@section('content')

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="row row-cols-1 row-cols-2 row-cols-3 row-cols-4">
                    {{-- @foreach ($listPeserta as $peserta) --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader mb-2">Series</div>
                                </div>
                                <div class="h1 mb-2">Dark</div>
                                <div class="d-flex mb-1">
                                    <div class="p">1 Hours per episode</div>
                                </div>
                            </div>
                        </div>
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>

@endsection