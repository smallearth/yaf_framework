<?php
/**
 * @name Test
 * @author sunquan003@ke.com
 * @desc
 * @see    http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

namespace App\Models;

class Test extends Base
{
    public function test() {
        echo 'Model test.';
    }
}