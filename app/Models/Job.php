<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Job extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title','salary','location','description','experience','category'];
    public static array $experience = ['entry','intermediate','senior'];
    public static array $categories = ['It','Finance','Sales','Marketing'];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied(Authenticatable|User|int $user): bool
    {
        return $this->where('id',$this->id)
                    ->whereHas(
                      'jobApplications',
                      fn($query) => $query->where('user_id','=',$user->id ?? $user)
                    )->exists();
    }
    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder | QueryBuilder
    {
        return $query->when(// search for job by any text
            $filters['search'] ?? null,
            function($query,$search) {
                $query->where(
                    fn($query) => $query->where('title','like','%' . $search . '%')
                        ->orWhere('description','like','%' . $search . '%')
                        ->orWhereHas('employer',fn($query) =>
                            $query->where('company_name','like','%' . $search . '%'))
                );
            }
        )->when( // filtering by min salary
            $filters['min_salary'] ?? null,
            fn($query,$min_salary) =>
            $query->where('salary', '>=' , $min_salary)
        )->when( // filtering by max salary
            $filters['max_salary'] ?? null,
            fn($query,$max_salary) =>
            $query->where('salary', '<=' , $max_salary)
        )->when(//filtering by experience
            $filters['experience'] ?? null,
            fn($query,$experience) => $query->where('experience',$experience)
        )->when(//filtering by category
            $filters['category'] ?? null,
            fn($query,$category) => $query->where('category',$category)
        );
    }
}
