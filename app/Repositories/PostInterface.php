<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface PostInterface{

    public function store(array $data);

    public function getAll();

    public function validate(Request $request);

    public function getById($id);

    public function update($id, array $data);

    public function delete($id);

}
