<?php

namespace Framework;

use Framework\Session;

class Authorization
{
  /**
   * Check if current logged in user owns a resource
   * 
   * @param int $resourceId
   * @return bool
   */
  public static function isOwner($resourceUserId)
  {
    $sessionUser = Session::get('user');

    if ($sessionUser !== null && isset($sessionUser['id'])) {
      $sessionUserId = (int) $sessionUser['id'];
      // PDO may return listing.user_id as a string — compare as ints for strict match
      return $sessionUserId === (int) $resourceUserId;
    }

    return false;
  }
}
