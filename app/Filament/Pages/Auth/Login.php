<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    public function mount(): void
    {
        // Inicializamos 'email' para que no dé error, aunque no se use.
        $this->form->fill([
          'password' => 'Administrador159357$$',
          'email' => 'super',
        ]);
    }


    public function form(Form $form): Form
    {
        return $form
          ->schema([
            TextInput::make('email')->label('Usuario')->required()->autocomplete()->autofocus()->extraInputAttributes(['tabindex' => 1]),
            // TextInput::make('name')->label('Usuario')->required()->maxLength(255),
            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent()
          ]);
    }

    public function getRules(): array
    {
        return [
            'email'    => ['nullable', 'string','max:255'],
            'password' => ['required', 'string'],
        ];
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
          'name'     => $data['email'],
          'password' => $data['password'],
        ];
    }

}
