<?php

namespace App\Helpers;

use App\Models\UserLog;

class UserLogHelper
{
    public static function log(
        ?string $id,
        string $action,
        ?string $module = 'adminpanel',
        ?string $message = null,
        ?array $oldValues = null,
        ?array $newValues = null
    ): UserLog {
        return UserLog::create([
            'user_id' => $id,
            'action' => $action,
            'module' => $module,
            'message' => $message,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}
