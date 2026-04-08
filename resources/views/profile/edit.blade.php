@extends('layouts.app')

@section('content')
<div class="profile-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="fas fa-edit me-2"></i> Edit Profile</h2>
            <p class="mb-0">Update your personal information</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('profile.show') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i> Back to Profile
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" 
                                   value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" 
                                   value="{{ old('last_name', $user->last_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact_number" class="form-label">Contact Number *</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" 
                                   value="{{ old('contact_number', $user->contact_number) }}" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Address *</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact" class="form-label">Emergency Contact *</label>
                            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" 
                                   value="{{ old('emergency_contact', $user->emergency_contact) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="guardian_name" class="form-label">Guardian Name *</label>
                            <input type="text" class="form-control" id="guardian_name" name="guardian_name" 
                                   value="{{ old('guardian_name', $user->guardian_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="guardian_contact" class="form-label">Guardian Contact *</label>
                            <input type="text" class="form-control" id="guardian_contact" name="guardian_contact" 
                                   value="{{ old('guardian_contact', $user->guardian_contact) }}" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection