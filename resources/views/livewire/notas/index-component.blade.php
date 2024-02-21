
<div class="container-fluid">
    <div class="page-title-box">
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
                <div class="card-body">
                    @forelse ($notas as $nota)
                        <p>{{$nota->descripcion}}</p>
                    @empty
                        <p>No existe ninguna nota</p>
                    @endforelse
                </div>
            </div>
        </div>
        <form wire:submit.prevent="submit">
            <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

            <div class="form-group row">
                <div class="col">
                    <label for="example-text-input" class="col-sm-12 col-form-label">Nueva nota</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="descripcion" class="form-control"
                            name="descripcion" id="descripcion" placeholder="Nota...">
                        @error('descripcion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button class="w-100 btn btn-success mb-2" id="alertaGuardar">Enviar nota
                            </button>
                    </div>
                </div>

                
            </div>
        </form>
    </div>


    @section('scripts')
    @endsection
