<?php
/**
 * @name IndexController
 * @author sunquan003@ke.com
 * @desc
 * @see    http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

use Yaf\Controller_Abstract as YafController;

class IndexController extends YafController
{
    public function testAction() {
        echo 'Welcome admin.';
    }
}