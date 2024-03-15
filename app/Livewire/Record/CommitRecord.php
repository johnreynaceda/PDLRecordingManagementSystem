<?php

namespace App\Livewire\Record;

use App\Filament\Exports\PdlExporter;
use App\Models\Crime;
use App\Models\EmergencyContact;
use App\Models\Jail;
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

class CommitRecord extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type== 'records' ? Pdl::query()->whereHas('jail', function($record){
                $record->where('region_id', auth()->user()->region_id);
            }) : Pdl::query())
            ->columns([
                TextColumn::make('id')->label('FULLNAME')->formatStateUsing(
                    function ($record) {
                        return $record->personalInformation->lastname. ', '. $record->personalInformation->firstname. ' '. $record->personalInformation->middlename;
                    }
                )->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('personalInformation', function($record) use ($search){
                        return $record->where('firstname', 'LIKE', '%'.$search.'%')->orWhere('lastname', 'LIKE', '%'.$search.'%')->orWhere('middlename', 'LIKE', '%'. $search. '%');
                    });
                }),
                TextColumn::make('classification')->label('CLASSIFICATION')->searchable(),
                TextColumn::make('date_of_confinement')->date()->label('DATE COMMITED')->searchable(),
                ViewColumn::make('crime')->label('CRIME COMMITTED')->view('filament.tables.columns.crime-committed')->searchable(
                    query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('pdlcases', function($record) use ($search){
                            $record->whereHas('crime', function($k) use ($search){
                                $k->where('name', 'LIKE', '%'.$search.'%');
                            });
                        });
                    }
                ),
                TextColumn::make('court')->label('BRANCH/COURT')->searchable(),
                TextColumn::make('status')->label('STATUS')->searchable(),
                TextColumn::make('remarks')->label('REMARKS')->searchable(),
                TextColumn::make('jail.region.name')->label('REGION')->searchable()->visible(auth()->user()->user_type == 'superadmin'),
                ])
            ->filters([
    //             Filter::make('created_at')->indicator('Administrators')
    //             ->form([
    //                 DatePicker::make('created_from'),
    //             ])
    //             ->query(function (Builder $query, array $data): Builder {
    //                 return $query
    //                     ->when(
    //                         $data['created_from'],
    //                         fn (Builder $query, $date): Builder => $query->whereDate('created_at', $date),
    //                     );

    //             }),
    //             SelectFilter::make('jail')
    // ->options(Jail::pluck('name', 'id'))
            ])
            ->actions([

                Action::make('view_data')->icon('heroicon-s-folder-open')->color('warning')->url(
                    function($record){
                        return route('record.commits.view', ['id' => $record->id]);
                    }
                ),


            ])
            ->bulkActions([

            ])->emptyStateDescription('Once you add PDL Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }

    public function render()
    {
        return view('livewire.record.commit-record');
    }
}
