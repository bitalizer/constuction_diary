<?php namespace EBuildingDiary\Traits;

use EBuildingDiary\Position;

trait PermissionTrait
{
    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'permissions', 'permission_id', 'position_id');
    }
}