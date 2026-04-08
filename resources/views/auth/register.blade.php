@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-user-plus fa-3x" style="color: #667eea"></i>
                    <h3 class="mt-3">Student Registration</h3>
                    <p class="text-muted">Create your account to get started</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">Student ID *</label>
                            <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                                   id="student_id" name="student_id" value="{{ old('student_id') }}" required>
                            @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name *</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                   id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                   id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth *</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                   id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender *</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contact_number" class="form-label">Contact Number *</label>
                            <input type="text" class="form-control @error('contact_number') is-invalid @enderror" 
                                   id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                            @error('contact_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Address *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="course" class="form-label">Course *</label>
                            <select class="form-control @error('course') is-invalid @enderror" id="course" name="course" required>
                                <option value="">Select Course</option>
                                <option value="BSIT" {{ old('course') == 'BSIT' ? 'selected' : '' }}>BS Information Technology</option>
                                <option value="BSCS" {{ old('course') == 'BSCS' ? 'selected' : '' }}>BS Computer Science</option>
                                <option value="BSIS" {{ old('course') == 'BSIS' ? 'selected' : '' }}>BS Information Systems</option>
                                <option value="BSCE" {{ old('course') == 'BSCE' ? 'selected' : '' }}>BS Computer Engineering</option>
                                <option value="BSBA" {{ old('course') == 'BSBA' ? 'selected' : '' }}>BS Business Administration</option>
                            </select>
                            @error('course') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="year_level" class="form-label">Year Level *</label>
                            <select class="form-control @error('year_level') is-invalid @enderror" id="year_level" name="year_level" required>
                                <option value="">Select Year</option>
                                <option value="1" {{ old('year_level') == 1 ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('year_level') == 2 ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('year_level') == 3 ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('year_level') == 4 ? 'selected' : '' }}>4th Year</option>
                                <option value="5" {{ old('year_level') == 5 ? 'selected' : '' }}>5th Year</option>
                            </select>
                            @error('year_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="guardian_name" class="form-label">Guardian Name *</label>
                            <input type="text" class="form-control @error('guardian_name') is-invalid @enderror" 
                                   id="guardian_name" name="guardian_name" value="{{ old('guardian_name') }}" required>
                            @error('guardian_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="guardian_contact" class="form-label">Guardian Contact *</label>
                            <input type="text" class="form-control @error('guardian_contact') is-invalid @enderror" 
                                   id="guardian_contact" name="guardian_contact" value="{{ old('guardian_contact') }}" required>
                            @error('guardian_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="emergency_contact" class="form-label">Emergency Contact *</label>
                            <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" 
                                   id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact') }}" required>
                            @error('emergency_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </button>
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login here</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection