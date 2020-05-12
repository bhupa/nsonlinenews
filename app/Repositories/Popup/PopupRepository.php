<?php

namespace App\Repositories\Popup;

use App\Model\Popup\Popup;
use App\Repositories\BaseRepository;
//use Your Model

/**
 * Class PopupRepository.
 */
class PopupRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function __construct(Popup $popup)
    {
      $this->model = $popup;

    }

}
