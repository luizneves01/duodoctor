<?php

namespace Facades;

use Entity\RolesEntity;
use Illuminate\Support\Facades\Log;

class RolesFacades {

    protected $roles = [];

    function __construct()
    {
        try {
            
            $json_content = json_decode(file_get_contents(__DIR__ . "/../../role.json"));

            foreach($json_content as $role) {
                $this->setRoles(new RolesEntity($role->name, $role->code, $role->group));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function setRoles(RolesEntity $role)
    {
        $this->roles[] = $role;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}