<?php namespace EBuildingDiary\Traits;

use EBuildingDiary\Permission;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

trait PositionTrait
{
    /**
     * Checks if the role has a permission by its name.
     *
     * @param string|array $name Permission name or array of permission names.
     * @param bool $requireAll All permissions in the array are required.
     *
     * @return bool
     */
    public function hasPermission($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);
                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }
            // If we've made it this far and $requireAll is FALSE, then NONE of the permissions were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the permissions were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->permissions as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * Save the inputted permissions.
     *
     * @param mixed $inputPermissions
     *
     * @return void
     */
    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->permissions()->sync($inputPermissions);
        } else {
            $this->permissions()->detach();
        }
    }
    /**
     * Attach permission to current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }
        if (is_array($permission)) {
            return $this->attachPermissions($permission);
        }
        $this->permissions()->attach($permission);
    }
    /**
     * Detach permission from current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }
        if (is_array($permission)) {
            return $this->detachPermissions($permission);
        }
        $this->permissions()->detach($permission);
    }
    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }
    /**
     * Detach multiple permissions from current role
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions = null)
    {
        if (!$permissions) $permissions = $this->permissions()->get();
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }
}