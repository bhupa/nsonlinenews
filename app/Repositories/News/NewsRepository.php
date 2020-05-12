<?php

namespace App\Repositories\News;

use App\Model\News\News;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class NewsRepository.
 */
class NewsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(News $news)
    {
        $this->model = $news;
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
