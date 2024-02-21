@extends('home')


@section('notes')
<div>
    <div>
        @livewire('notas.index-component')

        @livewire('notas.create-component')
    </div>
</div>
