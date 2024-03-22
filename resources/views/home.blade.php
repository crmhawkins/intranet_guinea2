@extends('layouts.app')

@section('title', 'Dashboard')

@section('head')
    @vite(['resources/sass/productos.scss'])
    @vite(['resources/sass/alumnos.scss'])
@endsection

@section('content-principal')
    <style>
        .content-page .content {
            padding: unset !important;
            margin-bottom: unset !important;
            background: white;
        }
    </style>
    <iframe src="/laravel-filemanager" style="width: 100%; height: 100%;"></iframe>
    {{-- <div style="width: 35%; height: 100%;">
        @yield('notes')
    </div> --}}

@endsection
