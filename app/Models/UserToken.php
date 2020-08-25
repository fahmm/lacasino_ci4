<?php

namespace App\Models;

use CodeIgniter\Model;

class UserToken extends Model
{
    protected $table = 'user_token';
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'token'];
}
