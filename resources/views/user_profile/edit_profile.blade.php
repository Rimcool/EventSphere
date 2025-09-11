@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Profile</h2>

    <form method="POST" action="{{ route('user.updateProfile') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Profile Picture -->
        <div class="mb-3 text-center">
            <img src="{{ Auth::user()->profile_picture ? asset('storage/'.Auth::user()->profile_picture) : 'https://via.placeholder.com/120' }}"
                 alt="Profile Picture" class="rounded-circle mb-2" width="120" height="120">
            <input type="file" name="profile_picture" class="form-control mt-2">
        </div>

        <!-- Basic Info -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
            </div>
        </div>

        <!-- More Profile Info -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location', Auth::user()->location) }}" class="form-control">
            </div>
        </div>

        <!-- Bio -->
        <div class="mb-3">
            <label>About Me</label>
            <textarea name="bio" rows="3" class="form-control">{{ old('bio', Auth::user()->bio) }}</textarea>
        </div>

        <!-- Social Links -->
        <h5 class="mt-4">Social Media Links</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Facebook</label>
                <input type="url" name="facebook" value="{{ old('facebook', Auth::user()->facebook) }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>Instagram</label>
                <input type="url" name="instagram" value="{{ old('instagram', Auth::user()->instagram) }}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Twitter (X)</label>
                <input type="url" name="twitter" value="{{ old('twitter', Auth::user()->twitter) }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>LinkedIn</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', Auth::user()->linkedin) }}" class="form-control">
            </div>
        </div>

        <!-- Preferences -->
        <h5 class="mt-4">Preferences</h5>
        <div class="mb-3">
            <label>Notification Preferences</label>
            <select name="notifications" class="form-control">
                <option value="all" {{ Auth::user()->notifications == 'all' ? 'selected' : '' }}>Receive all notifications</option>
                <option value="important" {{ Auth::user()->notifications == 'important' ? 'selected' : '' }}>Only important updates</option>
                <option value="none" {{ Auth::user()->notifications == 'none' ? 'selected' : '' }}>No notifications</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
