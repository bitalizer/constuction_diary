<?php

namespace EBuildingDiary;

use Illuminate\Database\Eloquent\Model;

/**
 * EBuildingDiary\Diary
 *
 * @property-read \EBuildingDiary\Employee $employee
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Employee[] $employees
 * @property-read \EBuildingDiary\Project $project
 * @mixin \Eloquent
 * @property int $id
 * @property int $employee_id
 * @property int $project_id
 * @property string|null $mechanisms
 * @property string|null $equipment
 * @property string $work_description
 * @property string|null $comments
 * @property string|null $instructions
 * @property string|null $acts_and_documents
 * @property string|null $control
 * @property string $weather_time
 * @property int $weather_temperature
 * @property int $weather_snow
 * @property int $weather_dry
 * @property int $weather_rain
 * @property int $weather_wind
 * @property int $weather_sleet
 * @property string $date
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereActsAndDocuments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereEquipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereMechanisms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWeatherDry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWeatherRain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWeatherSleet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWeatherSnow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWeatherTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWeatherTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWeatherWind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Diary whereWorkDescription($value)
 */
class Diary extends Model
{
    protected $fillable = [
        'project_id',
        'submitter_id',
        'object',
        'mechanisms',
        'equipment',
        'work_description',
        'comments',
        'instructions',
        'acts_and_documents',
        'control',
        'weather_time',
        'weather_temperature',
        'weather_snow',
        'weather_dry',
        'weather_rain',
        'weather_wind',
        'weather_sleet',
        'date'
    ];

    public function submitter()
    {
        return $this->belongsTo(Employee::class);
    }

    public function employees()
    {
        return $this->belongstoMany(Employee::class)->withPivot('start_time', 'end_time', 'hours', 'note', 'weekend', 'holiday', 'night_shift');
    }

    public function project()
    {
        return $this->belongsTo(Project::class)->withTrashed();
    }
}
