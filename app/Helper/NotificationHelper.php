<?php

namespace App\Helper;

use App\Models\Notification;

class NotificationHelper {

  /**
   * Create a notification for a user
   * @param string $type instance of Notification::types.
   * @param int $userId Which user will get the notification.
   * @param string $title Notification Title.
   * @param string $message Notification body.
   * @return bool
   */
  public static function create(string $type, int $userId, string $title, string $message): bool {
    try {
      Notification::create([
        'user_id' => $userId,
        'type' => $type,
        'title' => $title,
        'message' => $message
      ]);
      return true;
    }catch (\Exception $e){
      return false;
    }
  }
}
