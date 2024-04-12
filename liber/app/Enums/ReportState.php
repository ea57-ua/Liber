<?php

namespace App\Enums;

enum ReportState: string {
    case Pending = 'pending';
    case Resolved = 'resolved';
}
