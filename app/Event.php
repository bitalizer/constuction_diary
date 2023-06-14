<?php

namespace EBuildingDiary;

use Illuminate\Database\Eloquent\Model;

/**
 * EBuildingDiary\Event
 *
 * @property-read \EBuildingDiary\Employee $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Employee[] $employees
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Event[] $sequences
 * @mixin \Eloquent
 * @property int $id
 * @property int $employee_id
 * @property string $title
 * @property string $information
 * @property string $color
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Event whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Event whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Event whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Event whereUpdatedAt($value)
 */
class Event extends Model
{
    public function sequences()
    {
        return $this->belongstoMany(Event::class);
    }

    public function creator()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function employees()
    {
        return $this->belongstoMany(Employee::class, 'event_employee');
    }
}
