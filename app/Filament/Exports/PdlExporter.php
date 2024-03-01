<?php

namespace App\Filament\Exports;

use App\Models\Pdl;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PdlExporter extends Exporter
{
    protected static ?string $model = Pdl::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('jail_id'),
            ExportColumn::make('date_arrested'),
            ExportColumn::make('criminal_case_no'),
            ExportColumn::make('date_of_confinement'),
            ExportColumn::make('court'),
            ExportColumn::make('time'),
            ExportColumn::make('photo_path'),
            ExportColumn::make('classification'),
            ExportColumn::make('cell_location'),
            ExportColumn::make('date_of_hearing'),
            ExportColumn::make('date_of_remand'),
            ExportColumn::make('date_of_release'),
            ExportColumn::make('status'),
            ExportColumn::make('remarks'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pdl export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
