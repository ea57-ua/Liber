<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.surname')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Surname'))
                ->placeholder(__('Surname')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),

            Input::make('user.biography')
                ->type('text')
                ->max(1000)
                ->title(__('Biography'))
                ->placeholder(__('Biography')),

            Input::make('user.image')
                ->type('file')
                ->title(__('Image'))
                ->horizontal(),
        ];
    }
}
