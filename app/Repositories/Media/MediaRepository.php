<?php

namespace App\Repositories\Media;

use App\Model\Media\Media;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class MediaRepository.
 */
class MediaRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Media $media)
    {
        $this->model =$media;
    }
}
