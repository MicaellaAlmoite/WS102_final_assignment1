@extends('layouts.app')

@section('content')
<div class="profile-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="fas fa-user-circle me-2"></i> My Profile</h2>
            <p class="mb-0">View and manage your personal information</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('profile.edit') }}" class="btn btn-light">
                <i class="fas fa-edit me-2"></i> Edit Profile
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i> Personal Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Student ID:</th>
                        <td><strong>{{ $user->student_id }}</strong></td>
                    </tr>
                    <tr>
                        <th>Full Name:</th>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth:</th>
                        <td>{{ date('F d, Y', strtotime($user->date_of_birth)) }}</td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td>{{ ucfirst($user->gender) }}</td>
                    </tr>
                    <tr>
                        <th>Contact Number:</th>
                        <td>{{ $user->contact_number }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Address Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Address:</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i> Academic Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Course:</th>
                        <td><strong>{{ $user->course }}</strong></td>
                    </tr>
                    <tr>
                        <th>Year Level:</th>
                        <td>{{ $user->year_level }}{{ date('S', $user->year_level) }} Year</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i> Guardian Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Guardian Name:</th>
                        <td>{{ $user->guardian_name }}</td>
                    </tr>
                    <tr>
                        <th>Guardian Contact:</th>
                        <td>{{ $user->guardian_contact }}</td>
                    </tr>
                    <tr>
                        <th>Emergency Contact:</th>
                        <td>{{ $user->emergency_contact }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection