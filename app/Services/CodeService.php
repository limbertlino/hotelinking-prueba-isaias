<?php

namespace App\Services;

use App\Enums\CodeStatus;
use App\Repositories\CodeRepository;
use App\Traits\ApiResponses;
use App\Models\User;
use App\Models\Code;

class CodeService
{
  use ApiResponses;

  protected $codeRepository;

  public function __construct(CodeRepository $codeRepository)
  {
    $this->codeRepository = $codeRepository;
  }

  // public function redeemCode(User $user, Code $code)
  // {
  //   try {
  //     if ($code->user_id !== $user->id) {
  //       return null;
  //     }

  //     if ($code->status === CodeStatus::Redeemed) {
  //       return null;
  //     }

  //     $redeemedCode = $this->codeRepository->redeem($code);

  //     return [
  //       'code' => $redeemedCode,
  //     ];
  //   } catch (\Exception $e) {
  //     \Log::error('Error redeeming code: ' . $e->getMessage());
  //     return null;
  //   }
  // }
}