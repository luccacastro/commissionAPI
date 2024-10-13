<?php
// app/Http/Controllers/CommissionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommissionService;
use App\Validators\CommissionValidator;
use Illuminate\Support\Facades\Log;

class CommissionController extends Controller
{
    protected $commissionService;
    protected $commissionValidator;

    public function __construct(CommissionService $commissionService,CommissionValidator $commissionValidator)
    {
        $this->commissionService = $commissionService;
        $this->commissionValidator = $commissionValidator;
    }

    public function calculate(Request $request)
    {
        try {
            $this->commissionValidator->validate($request);
            
            $revenue = $request->input('revenue');
            $modelType = $request->input('modelType');

            $commission = $this->commissionService->calculateCommission($revenue, $modelType);
            $breakdown = $this->commissionService->getPriceBreakdown($revenue, $modelType);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Unable to calculate commission. Please try again later.'. $e->getMessage()], 500);
        }

        return response()->json([
            'commission' => $commission,
            'breakdown' => $breakdown
        ], 200);
    }
}

