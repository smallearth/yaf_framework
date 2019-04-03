<?php

/*
 * This file is part of the overtrue/yaf-skeleton.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Exceptions;

/**
 * class ErrorException.
 *
 * @author overtrue <i@overtrue.me>
 */
class ErrorException extends AppException
{
    protected $code = 1500;
}