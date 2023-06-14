<?php

namespace EBuildingDiary;

use EBuildingDiary\Traits\PermissionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * EBuildingDiary\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\EBuildingDiary\Position[] $positions
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property string $controller
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Permission whereController($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\EBuildingDiary\Permission whereUpdatedAt($value)
 */
class Permission extends Model
{
    use PermissionTrait;

    protected $guarded = ['id'];
    protected $fillable = ['name', 'display_name', 'description'];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}