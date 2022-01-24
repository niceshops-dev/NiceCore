<?php

declare(strict_types=1);

/**
 * @see       https://github.com/Pars/pars-patterns for the canonical source repository
 * @license   https://github.com/Pars/pars-patterns/blob/master/LICENSE BSD 3-Clause License
 */

namespace Pars\Pattern\PHPUnit;

use PHPUnit\Framework\TestCase;

class DefaultTestCase extends TestCase
{
    use TestCaseClassMemberInvokerTrait;


    /**
     * @param string $expected trait classname
     * @param string|object $actual object or classname
     * @param string $message
     */
    public static function assertUseTrait(string $expected, $actual, string $message = '')
    {
        self::assertTrue(self::classUseTrait($actual, $expected), $message);
    }

    /**
     * @param        $object
     * @param string $trait
     *
     * @return bool
     */
    protected static function classUseTrait($object, string $trait): bool
    {
        $classUseTrait = false;
        $arrClassName = class_parents($object);
        array_unshift($arrClassName, get_class($object));
        foreach ($arrClassName as $className) {
            $arrTrait = class_uses($className);
            if (in_array($trait, $arrTrait)) {
                $classUseTrait = true;
                break;
            }
        }

        return $classUseTrait;
    }
}
