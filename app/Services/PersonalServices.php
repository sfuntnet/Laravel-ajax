<?php

namespace App\Services;

use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalServices
{
    private $personal;

    public function __construct(Personal $personal)
    {
        $this->personal = $personal;
    }

    public function index($request)
    {
        return $this->personal->index($request);
    }

    public function store($request)
    {
        return $this->personal->store($request);
    }

    public function update($request, $id)
    {
        return $this->personal->updatePersonal($request, $id);
    }

    public function edit($id)
    {
        return $this->personal->edit($id);
    }

    public function destroy($id)
    {
        return $this->personal->destroyPersonal($id);
    }
}
