<?php

namespace App\Repositories\Category;


use App\Repositories\BaseRepository;
use App\Model\Category\Category;
//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */

    public function  __construct(Category $category){
        $this->model = $category;
    }
    public function create($input){
        Category::create($input);
        return true;
    }
    public function update($id,$input){
        Category::where('id',$id)->update($input);

        return true;
    }


}
