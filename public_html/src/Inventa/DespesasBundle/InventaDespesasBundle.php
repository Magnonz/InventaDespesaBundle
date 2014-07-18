<?php

namespace Inventa\DespesasBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class InventaDespesasBundle extends Bundle
{
    public function getParent() {
       return 'FOSUserBundle';
    }
    
}
