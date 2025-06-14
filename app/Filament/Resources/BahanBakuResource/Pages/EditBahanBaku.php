<?php

namespace App\Filament\Resources\BahanBakuResource\Pages;

use App\Filament\Resources\BahanBakuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBahanBaku extends EditRecord
{
    protected static string $resource = BahanBakuResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Hitung safety stock
        if (isset($data['penggunaan_harian_rata2']) && isset($data['lead_time_maks'])) {
            $data['safety_stock'] = $data['penggunaan_harian_rata2'] * $data['lead_time_maks'];
        }

        // Hitung ROP
        if (isset($data['penggunaan_harian_rata2']) && isset($data['lead_time'])) {
            $data['rop'] = $data['penggunaan_harian_rata2'] * $data['lead_time'];
        }

        // Hitung EOQ
        if (isset($data['permintaan_per_tahun']) && isset($data['biaya_pemesanan']) && isset($data['biaya_penyimpanan']) && $data['biaya_penyimpanan'] > 0) {
            $data['eoq'] = sqrt((2 * $data['permintaan_per_tahun'] * $data['biaya_pemesanan']) / $data['biaya_penyimpanan']);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
