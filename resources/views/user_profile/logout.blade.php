@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Logout</h2>
    <p>Are you sure you want to log out?</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Yes, Logout</button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
