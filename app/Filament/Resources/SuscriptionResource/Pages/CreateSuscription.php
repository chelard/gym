<?php

namespace App\Filament\Resources\SuscriptionResource\Pages;

use App\Filament\Resources\SuscriptionResource;
use App\Models\Payment;
use App\Models\Suscription;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSuscription extends CreateRecord
{
    protected static string $resource = SuscriptionResource::class;

    protected function handleRecordCreation(array $data): Suscription
    {
        $suscriptionData = array_diff_key($data, array_flip(['payment_date', 'amount', 'payment_method']));
        $paymentData = array_intersect_key($data, array_flip(['payment_date', 'amount', 'payment_method']));

        $suscription = Suscription::create($suscriptionData);

        Payment::create([
            'suscription_id' => $suscription->id,
            'payment_date' => $paymentData['payment_date'],
            'amount' => $paymentData['amount'],
            'payment_method' => $paymentData['payment_method'],
        ]);

        return $suscription;
    }
}
