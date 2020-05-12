<?php

namespace App\Repositories\Password;

use Illuminate\Support\Facades\Password;
use  App\Repositories\BaseRepository;
//use Your Model

/**
 * Class PasswordRepository.
 */
class PasswordRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
   public function __construct(password $password)
   {
       $this->model = $password;
   }
   public function create($input){
       dd($input);
       $this->model->create($input);
       return true;
   }
}
