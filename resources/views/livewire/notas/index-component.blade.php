
<div class="container-fluid" style="width: 100%">
    <div class="page-title-box">
        <div class="col-sm-4">
            <a
            href="{{ route('home') }}"
            {{-- href="notas-index/{{ $user->id }}" --}}
                class="btn btn-primary p-3 mb-2">Volver</a>
            {{-- <h4 class="page-title">Notas</h4> --}}
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Notas</h4>
            </div>
        </div> <!-- end row -->
    </div>
    <!-- end page-title -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body" style="display:flex; flex-direction:column; gap:15px;">
                    {{-- @dd($notas) --}}
                    @forelse ($notas as $nota)

                        @if ($nota->author === Auth::user()->id)
                        {{-- {{var_dump($nota->author)}} --}}
                        <div style="
                        background-color: lightgreen;
                        text-align: right;
                        border-radius: 6px;
                        padding: 16px;
                        width: fit-content;
                        align-self: end;
                        ">
                            <h6>Yo:</h6>
                            <p>{{$nota->descripcion}}</p>
                            <span style="font-size: 8px">
                                {{$nota->created_at}}
                            </span>
                        </div>
                        @else
                        <div style="
                        background-color: lightblue;
                        border-radius: 6px;
                        padding: 16px;
                        width: fit-content;
                        ">
                            <h6>{{$targetName}}:</h6>
                            <p>
                                {{$nota->descripcion}}
                            </p>
                            <span style="font-size: 8px">
                                {{$nota->created_at}}
                            </span>
                        </div>
                        @endif
                    @empty
                        <p>No existe ninguna nota</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body" style="display:flex; flex-direction:column; gap:15px;">
                    <form wire:submit.prevent="submit">
                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
                        <label for="example-text-input" class="col-sm-12 col-form-label">Nueva nota</label>
                        <div class="col-sm-12">
                            <input type="text" wire:model.lazy="descripcion" class="form-control"
                                name="descripcion" id="descripcion" placeholder="Nota...">
                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <button class="w-100 btn btn-success mt-2" id="alertaGuardar">Enviar nota </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @section('scripts')
    @endsection
