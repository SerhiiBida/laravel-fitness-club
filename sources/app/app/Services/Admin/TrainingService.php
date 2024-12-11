<?php

namespace App\Services\Admin;

use App\Repositories\Admin\TrainingRepository;

class TrainingService
{
    public function __construct(
        protected TrainingRepository $trainingRepository
    )
    {

    }
}
