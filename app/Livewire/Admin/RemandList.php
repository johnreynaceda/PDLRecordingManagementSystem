<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\PdlList;
use App\Models\LogHistory;
use App\Models\Pdl;
use App\Models\PdlCases;
use Filament\Tables\Columns\ViewColumn;
use Livewire\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Shop\Product;
use Carbon\Carbon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use WireUi\Traits\Actions;

class RemandList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;

    public $view_cases = false;
    public $crime_data = [];

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ? Pdl::query()->where('status', 'remand') : Pdl::query()->where('status', 'remand')->where('jail_id', auth()->user()->jail_id))
            ->columns([
                TextColumn::make('id')->label('FULLNAME')->formatStateUsing(
                    function ($record) {
                        return $record->personalInformation->lastname. ', '. $record->personalInformation->firstname. ' '. ($record->personalInformation->middlename == null ? '' : $record->personalInformation->middlename[0].'.') ;
                    }
                )->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('personalInformation', function($record) use ($search){
                        return $record->where('firstname', 'LIKE', '%'.$search.'%')->orWhere('lastname', 'LIKE', '%'.$search.'%')->orWhere('middlename', 'LIKE', '%'. $search. '%');
                    });
                }),
                TextColumn::make('classification')->label('CLASSIFICATION')->searchable(),
                TextColumn::make('criminal_case_no')->label('CRIMINAL CASE NO.')->searchable(),
                ViewColumn::make('crime')->label('CRIME COMMITTED')->view('filament.tables.columns.crime-committed')->searchable(
                    query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('pdlcases', function($record) use ($search){
                            $record->whereHas('crime', function($k) use ($search){
                                $k->where('name', 'LIKE', '%'.$search.'%');
                            });
                        });
                    }
                ),
                TextColumn::make('cell_location')->label('CELL/LOCATION')->searchable(),
                TextColumn::make('court')->label('BRANCH/COURT')->searchable(),
                TextColumn::make('date_of_remand')->date()->label('REMAND DATE')->searchable(),
                TextColumn::make('jail.region.name')->label('REGION')->searchable()->visible(auth()->user()->user_type == 'superadmin'),

                ])
            ->filters([
                // Filter::make('created_at')->indicator('Administrators')
                // ->form([
                //     DatePicker::make('created_from'),
                // ])
                // ->query(function (Builder $query, array $data): Builder {
                //     return $query
                //         ->when(
                //             $data['created_from'],
                //             fn (Builder $query, $date): Builder => $query->whereDate('created_at', $date),
                //         );

                // })
            ])
            ->actions([
                // EditAction::make('edit')->color('success'),
                ActionGroup::make([
                    // Action::make('hearings')->icon('heroicon-s-cursor-arrow-ripple')->color('info'),
                    Action::make('release')->icon('heroicon-s-cursor-arrow-ripple')->color('success')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'release',
                                'date_of_release' => Carbon::parse($data['date']),
                            ]);
                            LogHistory::create([
                                'pdl_id' => $record->id,
                                'user_id' => auth()->user()->id,
                                'description' => 'Update to Release',
                                'type' => 'Update',
                            ]);
                            $this->dialog()->success(
                                $title = 'Status updated',
                                $description = 'PDL infos are now in release status.'

                            );
                        }
                    )->form([

                        DatePicker::make('date')->label('Date of Release'),
                    ])->modalWidth('xl'),
                ])
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Remands yet!')->emptyStateDescription('Once you add Remands Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }

    public function viewCommitedCrime($id){
        $this->crime_data = PdlCases::where('pdl_id', $id)->get();

        $this->view_cases = true;

    }



    public function render()
    {
        return view('livewire.admin.remand-list');
    }
}
