<?php
/**
 * @name HelloCommand
 * @author sunquan003@ke.com
 * @desc
 * @see    http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */

namespace App\Commands;

class HelloCommand extends Command
{
    protected $name = 'hello';
    protected $description = '输出 Hello.';

    public function handle()
    {
        echo "Hello.";
    }

}