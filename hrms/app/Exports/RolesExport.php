<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RolesExport implements FromView
{
    protected $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    public function view(): View
    {
        return view('roles.excel', [
            'roles' => $this->roles
        ]);
    }
}
