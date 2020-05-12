<?php

namespace App\Repositories\Role;


use App\Model\Role\Role;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
     public function __construct(Role $role)
     {
         $this->model = $role;
     }
     public function create($input){
         Role::create($input);
         return true;
     }
     public function update($input, $id){
         Role::where('id',$id)->update($input);
         return true;
     }
}
