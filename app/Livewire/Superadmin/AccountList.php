<?php

namespace App\Livewire\Superadmin;

use App\Models\Jail;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AccountList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $email, $name, $password, $jail_id, $user_type;

    public $add_modal = false;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('user_type', '!=', 'superadmin'))->headerActions([
            Action::make('new')->label('New Account')->color('main')->size('sm')->icon('heroicon-s-plus')->action(
                function () {
                    $this->add_modal = true;

                }
            )
        ])
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('email')->label('EMAIL')->searchable(),
                TextColumn::make('user_type')->label('USER TYPE')->searchable(),
                TextColumn::make('jail.name')->label('JAIL BRANCH')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateIcon('heroicon-s-table-cells')->emptyStateHeading('No Accounts yet!')->emptyStateDescription('Once you create new Account, it will appear here.');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->unique(),
                    TextInput::make('password')->password()->required(),
                    Select::make('user_type')->options([
                        'admin' => 'Jail Records Unit',
                        'records' => 'Operations Monitoring',
                    ])->required(),
                    Select::make('jail_id')->options(Jail::pluck('name', 'id'))->label('Jail')->required(),
                ]),
            ]);
    }

    public function saveAccount(){
        $this->validate([
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required',
            'user_type' => 'required',
            'jail_id' => 'required',

        ]);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'user_type' => $this->user_type,
            'jail_id' => $this->jail_id,
        ]);
        $this->reset('name', 'password', 'user_type', 'jail_id','email');
        $this->add_modal = false;
    }

    public function render()
    {
        return view('livewire.superadmin.account-list');
    }
}
