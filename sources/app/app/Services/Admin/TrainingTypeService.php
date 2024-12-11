<?php

namespace App\Services\Admin;

use App\Repositories\Admin\TrainingTypeRepository;

class TrainingTypeService
{
    public function __construct(
        protected TrainingTypeRepository $trainingTypeRepository
    )
    {

    }
}
