<?php

namespace App\Repositories\SubCategory;

use App\Model\SubCategory\SubCategory;
use App\Repositories\BaseRepository;
use Redirect;
//use Your Model

/**
 * Class SubCategoryRepository.
 */
class SubCategoryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $subcategory;
    public function __construct(SubCategory $subcategory)
    {
        $this->model = $subcategory;
    }
    public function create($input){
            SubCategory::create($input);
            true;
    }
    public function update($id,$input){
        SubCategory::where('id',$id)->update($input);

        return true;
    }
}
