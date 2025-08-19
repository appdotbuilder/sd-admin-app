<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\GradeScore
 *
 * @property int $id
 * @property int $student_id
 * @property int $subject_id
 * @property int $class_id
 * @property int $teacher_id
 * @property string $assessment_type
 * @property float $score
 * @property float $max_score
 * @property string $assessment_name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon $assessment_date
 * @property string $academic_year
 * @property string $semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $student
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\SchoolClass $schoolClass
 * @property-read \App\Models\User $teacher
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereAcademicYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereAssessmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereAssessmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereAssessmentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereMaxScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradeScore whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class GradeScore extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grades_scores';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'subject_id',
        'class_id',
        'teacher_id',
        'assessment_type',
        'score',
        'max_score',
        'assessment_name',
        'notes',
        'assessment_date',
        'academic_year',
        'semester',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'score' => 'decimal:2',
        'max_score' => 'decimal:2',
        'assessment_date' => 'date',
    ];

    /**
     * Get the student that owns the grade.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the subject that owns the grade.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the class that owns the grade.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the teacher that owns the grade.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get the percentage score.
     *
     * @return float
     */
    public function getPercentageAttribute(): float
    {
        return $this->max_score > 0 ? ($this->score / $this->max_score) * 100 : 0;
    }
}