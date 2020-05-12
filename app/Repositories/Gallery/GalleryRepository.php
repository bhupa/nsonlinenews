<?php

namespace App\Repositories\Gallery;

use App\Model\Gallery\Gallery;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class GalleryRepository.
 */
class GalleryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;
    }
    public function create($input){
        $this->model->create($input);
        return true;
    }
    public function update($id,$input){

        $this->model->where('id',$id)->update($input);
        return true;
    }
}
