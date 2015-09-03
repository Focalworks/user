<?php
/**
 * Created by PhpStorm.
 * User: shirish
 * Date: 2/9/15
 * Time: 10:43 AM
 */

namespace Focalworks\Users;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class CustomEloquentUserProvider extends EloquentUserProvider
{

    public function retrieveByToken($identifier, $token)
    {
        $result = $this->createModel()->newQuery()->where($model->getKeyName(), $identifier)
            ->where($model->getRememberTokenName(), $token)
            ->first();

        $result->roles = $this->get_roles($result->id);
        $result->permissions = $this->get_permissions($result->roles);
        return $result;
    }

    /*
     * get all roles of user
     *  */

    private function get_roles($userid)
    {
        $user_roles = new UserRoles();
        $roles = $user_roles->join('roles', 'roles.rid', '=', 'user_roles.rid')->where('uid',
            $userid)->select('roles.role', 'roles.rid')->lists('role', 'rid')->toArray();
        return $roles;
    }

    /**
     * get all permissions of user by roles having that user
     * */
    private function get_permissions($roles)
    {
        $role_perm = new RolePermissions();
        $roles_ids = array_keys($roles);
        $permissions = $role_perm->join('permissions', 'permissions.pid', '=', 'role_permissions.pid')->whereIn('rid',
            $roles_ids)->select('permissions.name', 'permissions.pid')->lists('name', 'pid')->toArray();

        return $permissions;
    }

    public function retrieveByCredentials(array $credentials)
    {
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (!Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        $result = $query->first();

        $result->roles = $this->get_roles($result->id);
        $result->permissions = $this->get_permissions($result->roles);

        return $result;
    }


    public function updateRememberToken(UserContract $user, $token)
    {
        $current_user = parent::retrieveById($user->id);
        $current_user->setRememberToken($token);
        $current_user->save();
    }

    public function retrieveById($identifier)
    {
        $result = $this->createModel()->newQuery()->find($identifier);

        $result->roles = $this->get_roles($result->id);
        $result->permissions = $this->get_permissions($result->roles);
        return $result;
    }

} 