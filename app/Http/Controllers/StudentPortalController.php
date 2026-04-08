<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class StudentPortalController extends Controller
{
    // ============ LOGGING HELPER ============
    private function logActivity($eventType, $description)
    {
        DB::table('logs')->insert([
            'user_id' => Auth::id(),
            'user_name' => Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : 'Guest',
            'event_type' => $eventType,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // ============ REGISTRATION ============
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|string|max:20|unique:users',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'course' => 'required|string|max:100',
            'year_level' => 'required|integer|min:1|max:5',
            'guardian_name' => 'required|string|max:100',
            'guardian_contact' => 'required|string|max:20',
            'emergency_contact' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Insert user directly using DB
        $userId = DB::table('users')->insertGetId([
            'student_id' => $request->student_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'course' => $request->course,
            'year_level' => $request->year_level,
            'guardian_name' => $request->guardian_name,
            'guardian_contact' => $request->guardian_contact,
            'emergency_contact' => $request->emergency_contact,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Log the activity
        DB::table('logs')->insert([
            'user_id' => $userId,
            'user_name' => $request->first_name . ' ' . $request->last_name,
            'event_type' => 'REGISTRATION',
            'description' => "New student registered: {$request->student_id} - {$request->first_name} {$request->last_name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Manually login the user
        Auth::loginUsingId($userId);
        
        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to Student Portal.');
    }

    // ============ LOGIN ============
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Get user data
            $user = DB::table('users')->where('id', Auth::id())->first();
            
            // Log login
            DB::table('logs')->insert([
                'user_id' => Auth::id(),
                'user_name' => $user->first_name . ' ' . $user->last_name,
                'event_type' => 'LOGIN',
                'description' => "User logged in: " . $request->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    // ============ LOGOUT ============
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = DB::table('users')->where('id', Auth::id())->first();
            
            // Log logout
            DB::table('logs')->insert([
                'user_id' => Auth::id(),
                'user_name' => $user->first_name . ' ' . $user->last_name,
                'event_type' => 'LOGOUT',
                'description' => "User logged out: " . $user->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // ============ DASHBOARD ============
    public function dashboard()
    {
        // Get user data directly from DB
        $user = DB::table('users')->where('id', Auth::id())->first();
        
        // Get recent logs
        $recentLogs = DB::table('logs')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('dashboard', compact('user', 'recentLogs'));
    }

    // ============ PROFILE ============
    public function showProfile()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        return view('profile.show', compact('user'));
    }

    public function editProfile()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'guardian_name' => 'required|string|max:100',
            'guardian_contact' => 'required|string|max:20',
            'emergency_contact' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Update user using DB
        DB::table('users')->where('id', Auth::id())->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'guardian_name' => $request->guardian_name,
            'guardian_contact' => $request->guardian_contact,
            'emergency_contact' => $request->emergency_contact,
            'updated_at' => now(),
        ]);

        // Log profile update
        DB::table('logs')->insert([
            'user_id' => Auth::id(),
            'user_name' => $request->first_name . ' ' . $request->last_name,
            'event_type' => 'PROFILE_UPDATE',
            'description' => "Profile updated for: {$user->student_id}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

}