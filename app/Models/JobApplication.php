<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'job_id', 'expected_salary', 'cv_path'];

    // protected static function booted()
    // {
    //     static::addGlobalScope('parentNotDeleted', function($query){
    //         $query->whereHas('job', function($query){
    //             $query->whereNull('deleted_at');
    //         });
    //     });
    // }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }
}
