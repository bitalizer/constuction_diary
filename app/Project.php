<?php

namespace EBuildingDiary;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * EBuildingDiary\Project
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Employee[] $employees
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $location
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Project whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Project whereUpdatedAt($value)
 */
class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'location',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withPivot('hourly_rate', 'weekend_payable', 'holiday_payable', 'night_shift_payable', 'start_date', 'end_date');
    }

}
