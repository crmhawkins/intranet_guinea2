@extends('home')


@section('content-principal')
<div>
    @livewire('notas.index-component', ['identificador'=>$id])
</div>
@endsection