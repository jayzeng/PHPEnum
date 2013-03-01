<?php
/**
 * An abstract class to provide utility functions
 * to build Enum in PHP
 * @author Jay Zeng (jayzeng@jay-zeng.com)
 */
namespace Util;

/**
 * Enum utility class to provide a number of commonly used functionalities, such as reverse look up constants name, populate all constant labels etc
 * @example
 * <pre>
 * <code>
 * class ExampleEnum extends Enum
 * {
 *    const ONE = 1;
 *    const TWO = 2;
 *    const THREE = 3;
 * }
 * </code>
 * </pre>
 * One rule you need to follow:
 * - Values and Labels must be unique. This is because we need to map a value uniquely back to its label
 * @todo
 * - Convert getters into static so we can avoid instantizing the object every single time
 * - Not an efficient implementation to directly manipulate constant arrays
 * - Does not allow case insensitive search, for example, it should accept lower case or mixed case search if callee wants to (by passing it in an option)
 *
 */
abstract class Enum
{
    /**
     * A multi-dimensional array to hold class constants
     *
     * @var array
     */
    private $_cachedEnums = array();

    /**
     * Constructor
     */
    public function __construct() {
        $this->_cachedEnums = $this->getAllValues();
    }

    /**
     * Factory method
     *
     * @return static
     */
    public static function create() {
        $className = get_called_class();
        return new $className();
    }

    /**
     * Return all populated arrays
     *
     * @return false|array  return array of constants
     *                      or false when the subclass is
     *                      already registered in cache
     */
    final public function getAllValues() {
        $subClass = get_called_class();

        // Subclass has already been registered
        if(isset($this->_cachedEnums[$subClass])) {
            return FALSE;
        }

        $reflection = new \ReflectionClass($subClass);

        return $reflection->getConstants();
    }

    /**
     * Return value associated with input label
     *
     * @param string $label
     * @return mixed
     */
    public function getValue($label) {
        return $this->_cachedEnums[$label];
    }

    /**
     * Whether the given value exists
     *
     * @param mixed $value
     * @return boolean
     */
    public function hasValue($value) {
        return in_array($value, $this->_cachedEnums);
    }

    /**
     * Return a label associated with a given value, or false if the value does
     * not exist.
     *
     * @param mixed $value
     * @return string|false label
     */
    public function getLabel($value) {
        return array_search($value, $this->_cachedEnums);
    }

    /**
     * @return string[] constant labels
     */
    public function getLabels() {
        return array_keys($this->_cachedEnums);
    }

    /**
     * @return array constant values
     */
    public function getValues() {
        return array_values($this->_cachedEnums);
    }

    /**
     * Whether the given label exists
     *
     * @param string $label
     * @return boolean
     */
    public function hasLabel($label) {
        return array_key_exists($label, $this->_cachedEnums);
    }

    /**
     * Whether a given class is an enumerable class
     *
     * @param string $class
     * @return boolean
     */
    public static function isEnumable($class) {
        if(!class_exists($class)) {
            return FALSE;
        }
        return is_subclass_of($class, __CLASS__);
    }
}
?>
