<?php
/**
 * PHP File Abstract.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

abstract class Enum_Abstract
{
    /**
     * Retourne un tableau associatif des constantes
     *
     * @static
     * @return array
     */
    public static function getAssociativeArray()
    {
        $ref = new ReflectionClass(get_called_class());
        return $ref->getConstants();
    }

    /**
     * Retourne une constant en fonction de son nom sous forme de chaine
     *
     * @static
     *
     * @param $constant
     *
     * @return const|null
     */
    public static function fromString($constant)
    {
        $ref = new ReflectionClass(get_called_class());
        if ($ref->hasConstant($constant)) {
            return static::$constant;
        }
        return null;
    }

    /**
     * Retourne une constante en fonction de sa valeur
     *
     * @static
     *
     * @param $value
     *
     * @return const|null
     */
    public static function toString($value)
    {
        $ref = new ReflectionClass(get_called_class());
        $constants = array_flip($ref->getConstants());
        if (array_key_exists($value, $constants)) {
            return $constants[$value];
        }
        return null;
    }

    /**
     * Retourne vrai si la valeur existe
     *
     * @static
     *
     * @param $value
     *
     * @return bool
     */
    public static function isValid($value)
    {
        $ref = new ReflectionClass(get_called_class());
        return array_key_exists($value, array_flip($ref->getConstants()));
    }
}