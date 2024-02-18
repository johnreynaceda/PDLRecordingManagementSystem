<?php

namespace App\Livewire\Admin;

use App\Models\Pdl;
use Carbon\Carbon;
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
use Livewire\Component;
use App\Models\Shop\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use WireUi\Traits\Actions;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\ViewColumn;

class CommitList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use Actions;
    public $pdl_data;

    public $view_modal = false;

    public function table(Table $table): Table
    {
        return $table
            ->query(auth()->user()->user_type == 'superadmin' ? Pdl::query() : Pdl::query()->where('jail_id', auth()->user()->jail_id))->headerActions([
               Action::make('new_record')->icon('heroicon-o-plus')->icon('heroicon-o-plus')->color('success')->action(
                function(){
                    return redirect()->route('admin.commits.add');
                }
               )->hidden(auth()->user()->user_type == 'superadmin')
            ])
            ->columns([
                TextColumn::make('personalInformation.firstname')->label('FIRSTNAME')->searchable(),
                TextColumn::make('personalInformation.lastname')->label('LASTNAME')->searchable(),
                TextColumn::make('classification')->label('CLASSIFICATION')->searchable(),
                TextColumn::make('date_of_confinement')->date()->label('DATE COMMITED')->searchable(),
                ViewColumn::make('status')->label('COMMITTED CRIME')->view('filament.tables.columns.cases')
                ])
            ->filters([
                Filter::make('created_at')->indicator('Administrators')
                ->form([
                    DatePicker::make('created_from'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', $date),
                        );

                })
            ])
            ->actions([
                Action::make('view_data')->icon('heroicon-s-folder-open')->color('warning')->action(
                    function($record){
                        $this->pdl_data = $record;
                        $this->view_modal = true;
                    }
                ),
                EditAction::make('edit')->color('success'),
                ActionGroup::make([
                    Action::make('hearings')->icon('heroicon-s-cursor-arrow-ripple')->color('info')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'hearing',
                                // 'date_of_hearing' => Carbon::parse($data['date']),
                            ]);

                            $this->dialog()->success(
                                $title = 'Status updated',
                                $description = 'PDL infos are now in hearing status.'
                            );
                        }
                    ),
                    Action::make('remands')->icon('heroicon-s-cursor-arrow-ripple')->color('warning')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'remand',
                                'date_of_remand' => Carbon::parse( $data['date']),
                            ]);

                            $this->dialog()->success(
                                $title = 'Status updated',
                                $description = 'PDL infos are now in remand status.'

                            );
                        }
                    )->form([
                        ViewField::make('data')
                        ->view('filament.forms.pdl'),
                        DatePicker::make('date')->label('Date of Remand'),
                    ])->modalWidth('xl'),
                    Action::make('release')->icon('heroicon-s-cursor-arrow-ripple')->color('success')->action(
                        function($record, $data){
                            $record->update([
                                'status' => 'release',
                                'date_of_release' => Carbon::parse($data['date']),
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
            ])->emptyStateDescription('Once you add PDL Record, it will appear here.')->emptyStateIcon('heroicon-o-document-text');
    }
    public function render()
    {
        return view('livewire.admin.commit-list');
    }
}
