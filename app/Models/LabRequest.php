<?php

namespace App\Models;
use App\Models\LabRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'description', 'screenshot', 'status'];


    public function up()
{
    Schema::create('lab_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');  // Link to User (Student)
        $table->text('request_description');  // Details of the lab request
        $table->boolean('is_completed')->default(false);  // Completion status
        $table->timestamps();
    });
}

}
