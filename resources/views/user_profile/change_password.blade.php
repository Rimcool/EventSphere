@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Change Password</h2>

    <form method="POST" action="{{ route('user.updatePassword') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Current Password</label>
            <input type="password" name="current_password" class="form-control">
        </div>

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">Change Password</button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
