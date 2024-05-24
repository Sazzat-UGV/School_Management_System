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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('user_type',['admin','teacher','student','parent']);
            $table->string('photo')->default('default_profile.png');
            $table->boolean('is_deletable')->default('1');
            $table->string('admission_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('class_id')->nullable();
            $table->enum('gender',['Male','Female'])->nullable();
            $table->string('dob')->nullable();
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('occupation')->nullable();
            $table->string('admission_date')->nullable();
            $table->enum('blood_group',['A-', 'A+', 'B-', 'B+', 'AB-', 'AB+', 'O-','O+'])->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('last_name')->nullable();
            $table->boolean('status')->default(true);
            $table->string('date_of_joining')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('qualification')->nullable();
            $table->string('work_experience')->nullable();
            $table->longText('note')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
