<?php

namespace App\Http\Controllers;

use App\Services\PersonalServices;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PersonalCTRL extends Controller
{
    private $personal;

    public function __construct(PersonalServices $personal)
    {
        $this->personal = $personal;
    }

    public function index(Request $request)
    {
        return $this->personal->index($request);
    }

    public function store(Request $request)
    {
        return $this->personal->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->personal->update($request, $id);
    }

    public function edit($id)
    {
        return $this->personal->edit($id);
    }

    public function destroy($id)
    {
        return $this->personal->destroy($id);
    }
}
