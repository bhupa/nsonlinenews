<?php

namespace App\Repositories\Advertising;

use App\Model\Advertising\Advertising;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class AdvertisingRepository.
 */
class AdvertisingRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Advertising $advertising)
    {
        $this->model = $advertising;
    }
}
