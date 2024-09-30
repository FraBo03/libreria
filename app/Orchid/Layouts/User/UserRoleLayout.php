<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Platform\Models\Role;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserRoleLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        // Ottieni l'utente autenticato
        $user = auth()->user();
    
        // Verifica se l'utente autenticato è un amministratore
        $rolesQuery = Role::query();
    
        if (!$user->roles->contains('id', 1)) {
            // Se l'utente non è un admin, escludi il ruolo con ID = 1 (admin)
            $rolesQuery->where('id', '!=', 1);
        }
    
        return [
            Select::make('user.roles.')
                ->fromModel($rolesQuery, 'name')
                ->multiple()
                ->title(__('Name role'))
                ->help('Specify which groups this account should belong to'),
        ];
    }
}
