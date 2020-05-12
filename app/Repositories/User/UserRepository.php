<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Model\User\User;

//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */

    public function __construct(User $user)
    {
        $this->model= $user;
    }

        public function update($id,$input){

        $this->model->where('id',$id)->update($input);
        return true;

    }


}
