<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_id')->unique()->after('id');
            $table->string('first_name')->after('name');
            $table->string('last_name')->after('first_name');
            $table->date('date_of_birth')->after('last_name');
            $table->string('gender')->after('date_of_birth');
            $table->string('contact_number')->after('gender');
            $table->string('address')->after('contact_number');
            $table->string('course')->after('address');
            $table->integer('year_level')->after('course');
            $table->string('guardian_name')->after('year_level');
            $table->string('guardian_contact')->after('guardian_name');
            $table->string('emergency_contact')->after('guardian_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
              $table->dropColumn([
                'student_id', 'first_name', 'last_name', 'date_of_birth',
                'gender', 'contact_number', 'address', 'course', 'year_level',
                'guardian_name', 'guardian_contact', 'emergency_contact'
            ]);
        });
    }
};
