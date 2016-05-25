<?php

// src/Octopouce/AuthBundle/OctopouceAuthBundle.php

namespace AuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AuthBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}


