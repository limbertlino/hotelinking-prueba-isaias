<?php

namespace App\Enums;

/**
 * Represents the possible statuses of a promotional/discount code.
 * 
 * - **Active**: Code is valid and available for use.
 * - **Redeemed**: Code has already been redeemed (inactive).
 */
enum CodeStatus: string
{
  case Active = 'active';
  case Redeemed = 'redeemed';
}