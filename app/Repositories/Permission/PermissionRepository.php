<?php

namespace App\Repositories\Permission;

use App\Model\Permission\Permission;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
    public function create($input){
       Permission::create($input);
       return true;

    }
    public function update($input,$id){

        Permission::where('id', $id)->update($input);
        return true;

    }

}
