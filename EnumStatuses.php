<?php

namespace App\Enums;

enum EnumStatuses: string
{

    case DRAFT = 'Draft';
    case SUBMITTED = 'Submitted';
    case CHANGES_REQUESTED = 'Changes requested';
    case PUBLISHED = 'Published';
    case ARCHIVED = 'Archived';
}
