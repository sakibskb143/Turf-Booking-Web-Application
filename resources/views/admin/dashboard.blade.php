@extends('layouts.master_navbar')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="fw-bold mb-2">Admin Dashboard</h3>
            <p class="text-muted mb-4">Welcome back, {{ auth()->user()->name }}.</p>

            <div class="d-flex gap-2">
                <a href="{{ url('/') }}" class="btn btn-success">Go to Landing Page</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

