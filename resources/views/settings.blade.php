@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('updateFitnessLevel') }}">
    @csrf
        <div class="form-group row">
            <label for="fitnesslevelLabel" class="col-md-4 col-form-label text-md-right">{{ __('Wähle dein Fitnesslevel') }}</label>

            <fieldset id="fitnesslevelLabel" style="border:0">
                <div class="col-md-6">
                    <div>
                        <input type="radio" name="fitnesslevel" value="0" id="beginner" checked>
                        <label for="beginner">Leicht</label>
                    </div>
                    <div>
                        <input type="radio" name="fitnesslevel" value="1" id="pro">
                        <label for="pro">Anspruchsvoll</label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Speichern') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
