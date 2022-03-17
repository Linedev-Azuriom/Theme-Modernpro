@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="form-group">
                    <label for="subtitleInput">{{ trans('theme::theme.config.subtitle') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="subtitleInput" name="subtitle" value="{{ old('subtitle', theme_config('subtitle')) }}">

                    @error('subtitle')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="footer_descriptionInput">{{ trans('theme::theme.config.footer_description') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="footer_descriptionInput" name="footer_description" value="{{ old('footer_description', theme_config('footer_description')) }}">

                    @error('subtitle')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-5">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
