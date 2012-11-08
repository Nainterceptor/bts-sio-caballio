<?php

namespace s4a\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class s4aUserBundle extends Bundle
{
	public function getParent()	{
	    return 'FOSUserBundle';
	}
}