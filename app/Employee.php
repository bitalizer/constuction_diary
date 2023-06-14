<?php

namespace EBuildingDiary;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use EBuildingDiary\Traits\EmployeeTrait;

/**
 * EBuildingDiary\Employee
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Diary[] $diaries
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \EBuildingDiary\Position $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Project[] $projects
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee withRole($role)
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $password
 * @property string|null $phone_number
 * @property int $position_id
 * @property string $avatar
 * @property string|null $hire_date
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereHireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Employee whereUpdatedAt($value)
 */
class Employee extends Authenticatable
{
    use Notifiable;
    use EmployeeTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'position_id', 'hire_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function diaries()
    {
        return $this->belongstoMany(Diary::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('hourly_rate', 'weekend_payable', 'holiday_payable', 'night_shift_payable', 'start_date', 'end_date');
    }
}