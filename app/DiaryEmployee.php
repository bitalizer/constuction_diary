<?php

namespace EBuildingDiary;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DiaryEmployee extends Pivot
{
    protected $fillable = [
        'diary_id',
        'employee_id',
        'start_time',
        'end_time',
        'hours',
        'note',
        'weekend',
        'holiday',
        'night_shift'
    ];

    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
