<?php

namespace App\Enums;

enum TrainingType: string
{
    case Individual = 'individual';
    case Group = 'group';
    case Private = 'private';
}
