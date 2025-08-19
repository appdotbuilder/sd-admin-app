<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\StudentClass
 *
 * @property int $id
 * @property int $student_id
 * @property int $class_id
 * @property string $academic_year
 * @property \Illuminate\Support\Carbon $enrolled_at
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $student
 * @property-read \App\Models\SchoolClass $schoolClass
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereAcademicYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereEnrolledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentClass active()

 * 
 * @mixin \Eloquent
 */
class StudentClass extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'class_id',
        'academic_year',
        'enrolled_at',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enrolled_at' => 'date',
    ];

    /**
     * Get the student that owns the enrollment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the class that owns the enrollment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Scope a query to only include active enrollments.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}