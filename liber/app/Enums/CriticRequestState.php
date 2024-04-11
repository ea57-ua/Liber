<?php

namespace App\Enums;

enum CriticRequestState: string {
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
