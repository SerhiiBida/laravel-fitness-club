<?php

namespace App\Services\Admin;

use App\Repositories\Admin\ScheduleRepository;

class ScheduleService
{
    public function __construct(
        protected ScheduleRepository $scheduleRepository
    )
    {

    }
}
