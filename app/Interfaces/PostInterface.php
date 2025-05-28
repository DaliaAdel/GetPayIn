<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PostInterface
{
    public function create(Request $data);
    public function getUserPosts($filters);
    public function update($id, array $data);
    public function delete($id);
    public function find($id);
}
