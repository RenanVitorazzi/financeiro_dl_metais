@extends('layout')
@section('title')
Editar cliente
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('js/cep.js') }}"></script>
@endpush
@section('body')
    <form method="POST" action="{{ route('clientes.update', $cliente->id)}}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <x-form-group name='nome' autofocus value='{{ $cliente->pessoa->nome }}'>Nome completo</x-form-group>
            </div>
            <div class="col-md-6">
                <x-form-group name='nascimento' type='date' value='{{ $cliente->pessoa->nascimento }}'>Data de nascimento</x-form-group>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipoCadastro">Tipo de cadastro</label>
                    <select type="text" name="tipoCadastro" id="tipoCadastro" class="form-control" required>
                        {{-- {{ ($cliente->pessoa->tipo_cadastro == 'Pessoa Física') ? 'selected' : '' }} --}}
                        {{-- {{ ($cliente->pessoa->tipo_cadastro == 'Pessoa Jurídica') ? 'selected' : '' }} --}}
                        <option value='Pessoa Física'  > Pessoa Física</option>
                        <option value='Pessoa Jurídica' > Pessoa Jurídica</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div id='cpfGroup'>
                    <x-form-group name='cpf' value='{{ $cliente->pessoa->cpf }}'>CPF</x-form-group>
                </div>
                <div style='display:none' id='cnpjGroup'>
                    <x-form-group name='cnpj' value='{{ $cliente->pessoa->cnpj }}'>CPNJ</x-form-group>
                </div>
            </div>
        </div> 

        @include('formEndereco')
        <div class="row">
            <div class="col-md-6">
                <x-form-group name='telefone' value='{{ $cliente->pessoa->telefone }}'>Telefone com DDD</x-form-group>
            </div>
            <div class="col-md-6">
                <x-form-group name='celular' value='{{ $cliente->pessoa->celular }}'>Celular com DDD</x-form-group>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representante">Representante</label>
                    <select type="text" name="representante" id="representante" class="form-control">
                        <option></option>
                        @foreach ($representantes as $representante)
                            <option value="{{ $representante->id }}" 
                            {{ ($cliente->representante_id == $representante->id) ? 'selected' : '' }} 
                            >
                                {{ $representante->pessoa->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div> 
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class='mt-2'>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="submit" class='btn btn-success'>
    </form>
@endsection