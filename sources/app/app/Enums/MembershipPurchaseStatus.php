<?php

namespace App\Enums;

enum MembershipPurchaseStatus: string
{
    case Paid = 'paid';
    case Pending = 'pending';
    case Cancelled = 'cancelled';
}
