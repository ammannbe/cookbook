<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Form Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used various messages that we need
    | to display in forms.
    |
    */

    'global' => [
        'dropdown_first' => 'Bitte wählen',
        'cancel'     => 'Abbrechen',
        'edit'       => 'Bearbeiten',
        'save_edits' => 'Änderungen speichern',
        'name'       => 'Name',
        'confirm'    => 'Bist du sicher?',
    ],

    'auth' => [
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'login'    => 'Anmelden',
    ],

    'author' => [
        'create' => 'Verfasser hinzufügen',
        'examples' => [
            'name' => 'z.B. Benjamin Ammann',
        ],
    ],

    'category' => [
        'create' => 'Kategorie hinzufügen',
        'examples' => [
            'name' => 'z.B. Apéros'
        ],
    ],

    'ingredient' => [
        'create'   => 'Zutat hinzufügen',
        'examples' => [
            'amount' => 'z.B. 50'
        ],
        'ingredient' => 'Zutat',
        'prep'       => 'Vorbereitung',
        'alternate'  => 'Diese Zutat als Alternative zu:',
        'position'   => 'Position',
    ],

    'prep' => [
        'create' => 'Vorbereitung hinzufügen',
        'examples' => [
            'name' => 'z.B. gehackt',
        ],
    ],

    'rating-criterion' => [
        'create' => 'Bewertungs-Kriterium hinzufügen',
        'examples' => [
            'name' => 'z.B. Geschmack',
        ],
    ],

    'rating' => [
        'create' => 'Bewertung hinzufügen',
        'edit'   => 'Bewertung bearbeiten',
        'examples' => [
            'name' => 'z.B. Geschmack'
        ],
        'rating'    => 'Bewertung',
        'criterion' => 'Kriterium',
        'comment'   => 'Kommentar',
    ],

    'recipe' => [
        'create' => 'Rezept hinzufügen',
        'examples' => [
            'name' => 'z.B. Benis Spezialkukis',
        ],
        'author'   => 'Verfasser',
        'category' => 'Kategorie',
        'yield_amount' => 'Portionen',
        'preparation_time' => 'Zubereitungszeit',
        'instructions' => 'Zubereitung',
        'photo' => 'Foto (max. 2MB)',
        'delete_old_photo' => 'Altes Foto löschen (falls vorhanden)?',
        'overwrite_old_photo' => 'Altes Foto überschreiben (max 2MB)',
    ],

    'import' => [
        'create' => 'Rezept importieren',
        'file'   => 'Rezept (*.kreml)',
    ],

    'search' => [
        'create' => 'Rezept suchen',
        'examples' => [
            'term' => 'z.B. Kartoffel',
        ],
        'meta_description' => 'Einfach und schnell in über :count Rezepten suchen.',
        'item' => 'Suchen in',
        'term' => 'Suchbegriff',
    ],

    'unit' => [
        'create' => 'Enheit erstellen',
        'examples' => [
            'name' => 'z.B. Flasche',
            'name_shortcut' => 'z.B. Fl.',
            'name_plural'   => 'z.B. Flaschen',
            'name_plural_shortcut' => 'z.B. Fl.',
        ],
        'name' => 'Name (Singular)',
        'name_shortcut' => 'Abkürzung (Singular)',
        'name_plural'   => 'Name (Plural)',
        'name_plural_shortcut' => 'Abkürzung (Plural)',
    ],

    'user' => [
        'edit'  => 'Profil bearbeiten',
        'email' => 'E-Mail',
        'current_password' => 'Aktuelles Passwort',
        'let_empty' => '(Leer lassen um nicht zu ändern)',
        'new_password' => 'Neues Passwort',
        'new_password_confirm' => 'Passwort bestätigen',
    ],

];