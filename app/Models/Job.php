<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'location', 'salary', 'description', 'experience', 'category'];

    public static array $experience = ['junior', 'intermediate', 'senior'];

    public static array $category = ['IT', 'Finance', 'Sales', 'Engineering', 'Marketing'];

    protected $table = 'offered_jobs';

    public function employer(): BelongsTo{
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany{
        return $this->hasMany(JobApplication::class);
    }

    public function hasAlreadyApplied($user){
        return $this->where('id', $this->id)
                ->whereRelation('jobApplications', 'user_id', $user->id)
                ->exists();
    }

    public function scopeFilter($query, array $filter){
        
        $query->when($filter['search'] ?? null, function($query, $search){
            $query->where(function($query) use($search){
                $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orwhereRelation('employer', 'company_name', 'like', '%'.$search.'%');
            });
        })
        ->when($filter['min_salary'] ?? null, function($query, $min_salary){
            $query->where('salary', '>=', $min_salary);
        })
        ->when($filter['max_salary'] ?? null, function($query, $max_salary){
            $query->where('salary', '<=', $max_salary);
        })
        ->when($filter['experience'] ?? null, function($query, $experience){
            $query->where('experience', $experience);
        })
        ->when($filter['category'] ?? null, function($query, $category){
            $query->where('category', $category);
        });

        return $query;
    }
}
