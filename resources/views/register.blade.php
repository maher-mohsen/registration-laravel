@extends('layouts.app')
@push('styles')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endpush



@section('content')

        <!-- Display Session Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<div class="container">
    <h1>@lang('titles.Registration Page')</h1>
    <form method="post" enctype="multipart/form-data" id="myForm" action="{{ route('register.submit') }}" >
        @csrf
        <div class="form-group">
            <label for="full_name">@lang('titles.Full Name'):</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
            <span id="full_name_error" class="error"></span>
        </div>
        <div class="form-group">
            <label for="user_name">@lang('titles.Username'):</label>
            <input type="text" class="form-control" id="user_name" name="user_name" required placeholder="e.g., jane_smith123">
            <span id="user_name_error" class="error"></span>
        </div>
        <div class="form-group">
            <label for="birthdate">@lang('titles.Birth Date'):</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            <span id="birthdate_error" class="error"></span>
        </div>
        <div class="form-group">
            <button type="button" onclick="checkBornToday()">@lang('titles.Check Actors Born Today')</button>
        </div>
        <div class="form-group">
            <label for="phone">@lang('titles.Phone'):</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
            <span id="phone_error" class="error"></span>
        </div>
        <div class="form-group">
            <label for="address">@lang('titles.Address'):</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            <span id="address_error" class="error"></span>
        </div>
        <div class="form-group">
            <label for="password">@lang('titles.Password'):</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <span id="password_error" class="error"></span>
        </div>
        <div class="form-group">
            <label for="confirm_password">@lang('titles.Confirm Password'):</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            <span id="confirm_password_error" class="error"></span>
        </div>
        <div class="form-group">
            <label for="email">@lang('titles.Email'):</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="e.g., Jane@example.com">
            <span id="email_error" class="error"></span>
        </div>
        <div class="form-group">
            <label for="user_image">@lang('titles.User Image'):</label>
            <input type="file" class="form-control-file" id="user_image" name="user_image" required>
            <span id="user_image_error" class="error"></span>
        </div>
        <input type="submit" value=@lang('titles.Register')>
    </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endpush

<!--
    Export localization for public JS
-->
<script>
    var langDecorator = @json(array_merge(__('messages'), __('validation'), __('titles')));
</script>