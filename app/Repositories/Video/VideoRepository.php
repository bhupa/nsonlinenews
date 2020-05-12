<?php

namespace App\Repositories\Video;

use App\Model\Video\Video;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class VideoRepository.
 */
class VideoRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Video $video)
    {
        $this->model = $video;
    }
}
