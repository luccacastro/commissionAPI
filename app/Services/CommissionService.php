<?php

namespace App\Services;
use App\Models\CommissionModel;
use Illuminate\Support\Facades\Log;
use Mockery\QuickDefinitionsConfiguration;

class CommissionService
{
    public function calculateCommission($revenue, $modelType)
    {
        $tiers = $this->getCommissionTiers($modelType);

        $commission = 0;

        foreach ($tiers as $index => $tier) {
            $previousLimit = $tiers[$index - 1]['limit'] ?? 0;

            // For the last tier, treat it as "above the previous limit"
            if ($index === count($tiers) - 1) {
                $tierRevenue = max(0, $revenue - $previousLimit);
                $commission += $tierRevenue * $tier['rate'];
                break;
            }

            // Calculate the revenue applicable to the current tier
            if ($revenue > $previousLimit) {
                $tierRevenue = min($revenue, $tier['limit']) - $previousLimit;
                $commission += $tierRevenue * $tier['rate'];
            }
        }

        return $commission;
    }



    private function getCommissionTiers($modelType)
    {
        $model = CommissionModel::where('model_type', $modelType)->first();

        return $model ? $model->price_data['tiers'] : [];
    }

    private function generateLabel($tiers, $index)
    {
        $currentTier = $tiers[$index];
        $previousTier = $tiers[$index - 1] ?? null;

        $start = $previousTier ? '£' . number_format($previousTier['limit'] / 1000, 0) . 'k' : '£0';
        $end = $currentTier['limit'] > 0 ? '£' . number_format($currentTier['limit'] / 1000, 0) . 'k' : '+';
        $ratePercentage = $currentTier['rate'] * 100;

        if ($index == count($tiers) - 1) {
            return "$end + ({$ratePercentage}%)";
        } else {
            return "$start - $end ({$ratePercentage}%)";
        }
    }

    public function getPriceBreakdown($revenue, $modelType)
    {
        $tiers = $this->getCommissionTiers($modelType);
        $breakdown = [];
        $BRACKET_RANGE = 5000;
    
        foreach ($tiers as $index => $tier) {
            $value = 0;
            
            $label = $this->generateLabel($tiers, $index);
            if($revenue > $BRACKET_RANGE && $index != count($tiers) - 1){
                $value = ($BRACKET_RANGE) * $tier['rate'];
            }
            
            else{
                $value = ($revenue) * $tier['rate'];
            }

            $breakdown[] = [
                'limit' => $tier['limit'],
                'rate' => $tier['rate'],
                'value' => max($value, 0),
                'label' => $label,
            ];

            $revenue -= $BRACKET_RANGE;
        }
    
        return $breakdown;
    }
    
}