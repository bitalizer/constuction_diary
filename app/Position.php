<?php

namespace EBuildingDiary;

use EBuildingDiary\Traits\PositionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * EBuildingDiary\Position
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Permission[] $permissions
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Position whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Position whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Position whereUpdatedAt($value)
 */
class Position extends Model
{
    use PositionTrait;

    protected $guarded = ['id'];
    protected $fillable = array('name');

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_position', 'position_id', 'permission_id');
    }
}
