<?php

namespace BK\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BKUserBundle extends Bundle
{
	public function getParent()
	{
		return "FOSUserBundle";
	}
}
