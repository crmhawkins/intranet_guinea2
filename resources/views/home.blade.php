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
    <iframe src="/laravel-filemanager" style="width: 91%; height: 100%;"></iframe>
    <div style="width: 30%; height: 100%;">
        @yield('notes')
        {{-- @yield('send-note') --}}
    </div>
    
@endsection
