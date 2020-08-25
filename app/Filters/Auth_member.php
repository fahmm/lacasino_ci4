<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth_member implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here

        // $uri = service('uri');
        // $db      = \Config\Database::connect();
        $role_id = session()->get('role_id');

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
