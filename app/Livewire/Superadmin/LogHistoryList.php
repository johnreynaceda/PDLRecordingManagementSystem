<?php

namespace App\Livewire\Superadmin;

use App\Filament\Exports\PdlExporter;
use App\Models\Crime;
use App\Models\EmergencyContact;
use App\Models\Jail;
use App\Models\LogHistory;
use App\Models\Pdl;
use App\Models\PdlCases;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Shop\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use WireUi\Traits\Actions;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\ViewColumn;
use pxlrbt\FilamentExcel\Columns\Column;
// use App\Filament\Exports\ProductExporter;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\ProductExporter;
use Filament\Tables\Actions\ExportBulkAction;

class LogHistoryList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;

    public function table(Table $table): Table
    {
        return $table
            ->query(LogHistory::query())
            ->columns([

                TextColumn::make('user.name')->label('USER NAME')->searchable(),
                TextColumn::make('pdl')->label('PDL NAME')->formatStateUsing(
                    function($record){
                        return $record->pdl->personalInformation->firstname . ' '. $record->pdl->personalInformation->middlename. ' '. $record->pdl->personalInformation->lastname;
                    }
                )->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('pdl', function($pdl) use ($search){
                        $pdl->whereHas('personalInformation', function($record) use ($search){
                            return $record->where('firstname', 'LIKE', '%'.$search.'%')->orWhere('lastname', 'LIKE', '%'.$search.'%')->orWhere('middlename', 'LIKE', '%'. $search. '%');
                        });
                    });
                }),
                TextColumn::make('description')->label('DESCRIPTION')->searchable(),
                TextColumn::make('type')->label('TYPE')->searchable(),
                ])
            ->filters([

            ])
            ->actions([


            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Log History yet!')->emptyStateDescription('Once it has Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }

    public function render()
    {
        return view('livewire.superadmin.log-history-list');
    }
}
