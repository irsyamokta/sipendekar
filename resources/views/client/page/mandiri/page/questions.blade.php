@extends('client.index')
@section('content')
    @include('client.partials.preloader')
    @if ($umur < 18)
        @include('client.page.mandiri.components.sdq-question')
    @else
        @include('client.page.mandiri.components.srq-question')
    @endif
@endsection
