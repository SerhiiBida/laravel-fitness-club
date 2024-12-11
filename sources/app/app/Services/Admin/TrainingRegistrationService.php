<?php

namespace App\Services\Admin;

use App\Repositories\Admin\TrainingRegistrationRepository;

class TrainingRegistrationService
{
    public function __construct(
        protected TrainingRegistrationRepository $trainingRegistrationRepository
    )
    {

    }
}
