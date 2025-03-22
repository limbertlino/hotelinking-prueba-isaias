<?php

namespace App\Enums;

enum CodeStatus: string
{
  case Active = 'active';
  case Redeemed = 'redeemed';
}