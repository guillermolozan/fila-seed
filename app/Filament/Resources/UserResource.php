<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\FiltersLayout;
use Carbon\Carbon;

// use App\Filament\Clusters\SystemCluster;

// use App\Filament\Components\Controller;

// use Filament\Support\Enums\Alignment;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    // protected static ?string $cluster = SystemCluster::class;
    protected static ?string $pluralModelLabel = 'usuarios';

    protected static ?string $modelLabel = 'usuario';

    protected static ?string $navigationLabel = 'Usuarios';

    protected static ?int $navigationSort = 101;

    protected static ?string $navigationGroup = 'Sistema';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-s-user';

    protected static ?string $slug = 'sistema/users';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }



    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Nombre')->unique(column: "name", ignoreRecord: true, )->rules(["alpha_dash",])->validationMessages(["alpha_dash" => "Formato de usuario incorrecto","unique" => "Este nombre de acceso ya existe",])->required(),
                        Forms\Components\TextInput::make('email')->email()->prefixIcon('heroicon-m-envelope')->label('Email')->unique(column: 'email', ignoreRecord: true, )->rules(['email',])->validationMessages(['email' => 'Formato de email incorrecto','unique' => 'Este email ya existe',]),
                        Forms\Components\TextInput::make('password')->password()->revealable()->autocomplete('new-password')->required(fn (string $context): bool => $context === 'create')->rules(fn (string $context): array => $context === 'create' ? [ function ($attribute, $value, $fail) { if (strlen($value) < 8) { $fail('El password debe tener al menos 8 caracteres.'); } } ] : [])->dehydrated(fn ($state) => filled($state))->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null),
                        Forms\Components\Select::make('roles')->label('Roles')->relationship('roles', 'name')->multiple()->preload()->searchable()
                    ])
                    ->columns(['sm' => 1,'md' => 2,'lg' => 3,'xl' => 3,'2xl' => 4,])
            ])
        ;
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')->label('id')->sortable()->toggleable(isToggledHiddenByDefault:false)->width('100px')->extraAttributes(['style' => 'opacity:.2;']),
                Tables\Columns\TextColumn::make('id')->label('id')->sortable()->toggleable(isToggledHiddenByDefault:false)->width('100px')->extraAttributes(['style' => 'opacity:.2;']),
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable()->toggleable(isToggledHiddenByDefault: false)->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->icon('heroicon-m-envelope')->searchable()->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('roles.name')->label('Roles')->badge(),
                Tables\Columns\TextColumn::make('created_at')->label('Creado')->sortable()->toggleable(isToggledHiddenByDefault: true)->width('150px')->since()->color('warning')->dateTimeTooltip(),
                // Tables\Columns\TextColumn::make('created_at')->label('Creado')->sortable()->toggleable(isToggledHiddenByDefault: true)->width('150px')->since()->color('warning')->dateTimeTooltip(),
            ])
            ->persistSortInSession()
            ->defaultSort('id', 'desc')
            ->groups([

            ])

            // ->groupingSettingsHidden()
            ->filters([
                Tables\Filters\SelectFilter::make('roles')->label('Roles')->relationship('roles', 'name')->multiple()->preload()
            ], FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([

            ])
            ->defaultPaginationPageOption(20)
            ->paginated([10, 20, 50, 100, 200])
            // ->recordUrl(fn ($record): ?string => null)
            // ->heading('Clients')
            // ->description('Manage your clients here.')
            // ->striped()
            // ->groups([
            //    Tables\Grouping\Group::make('status')->label('Estado'),
            //    Tables\Grouping\Group::make('expenseGroup.name')->label('Grupo'),
            // ])
            // ->emptyStateActions([
            //     Tables\Actions\Action::make('create')
            //         ->label('Nuevo Gasto')
            //         ->url(route('filament.admin.resources.sistema.expenses.create'))
            //         ->icon('heroicon-m-plus')
            //         ->button(),
            // ])
        ;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
