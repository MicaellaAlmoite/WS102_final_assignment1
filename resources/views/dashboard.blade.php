@extends('layouts.app')

@section('content')
<div class="profile-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="fas fa-tachometer-alt me-2"></i> Student Dashboard</h2>
            <p class="mb-0">Welcome back, {{ $user->first_name }} {{ $user->last_name }}!</p>
        </div>
        <div class="col-md-4 text-end">
            <i class="fas fa-user-graduate fa-3x"></i>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-id-card fa-3x" style="color: #667eea"></i>
                <h5 class="mt-3">Student ID</h5>
                <h4>{{ $user->student_id }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-book-open fa-3x" style="color: #667eea"></i>
                <h5 class="mt-3">Course</h5>
                <h4>{{ $user->course }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-chalkboard-teacher fa-3x" style="color: #667eea"></i>
                <h5 class="mt-3">Year Level</h5>
                <h4>{{ $user->year_level }}{{ $user->year_level == 1 ? 'st' : ($user->year_level == 2 ? 'nd' : ($user->year_level == 3 ? 'rd' : 'th')) }} Year</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Full Name</label>
                        <p class="fw-bold">{{ $user->first_name }} {{ $user->last_name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Email Address</label>
                        <p class="fw-bold">{{ $user->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Date of Birth</label>
                        <p class="fw-bold">{{ date('F d, Y', strtotime($user->date_of_birth)) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Gender</label>
                        <p class="fw-bold">{{ ucfirst($user->gender) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Contact Number</label>
                        <p class="fw-bold">{{ $user->contact_number }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Emergency Contact</label>
                        <p class="fw-bold">{{ $user->emergency_contact }}</p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="text-muted">Address</label>
                        <p class="fw-bold">{{ $user->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i> Recent Activities</h5>
            </div>
            <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                @forelse($recentLogs as $log)
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted">
                            @php
                                $date = new DateTime($log->created_at);
                                $now = new DateTime();
                                $diff = $date->diff($now);
                                
                                if ($diff->days == 0) {
                                    if ($diff->h == 0) {
                                        if ($diff->i == 0) {
                                            echo "Just now";
                                        } else {
                                            echo $diff->i . " minute" . ($diff->i > 1 ? "s" : "") . " ago";
                                        }
                                    } else {
                                        echo $diff->h . " hour" . ($diff->h > 1 ? "s" : "") . " ago";
                                    }
                                } elseif ($diff->days == 1) {
                                    echo "Yesterday";
                                } elseif ($diff->days < 7) {
                                    echo $diff->days . " days ago";
                                } else {
                                    echo date('M d, Y', strtotime($log->created_at));
                                }
                            @endphp
                        </small>
                        <p class="mb-0 small">{{ $log->description }}</p>
                    </div>
                @empty
                    <p class="text-muted text-center">No recent activities</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection