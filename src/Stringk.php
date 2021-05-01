<?php

namespace Alnahari\Stringk;

use Closure;
use Exception;

/**
 * @property-read int   $lastIndex
 * @property-read array $indices
 * @property-read bool  $isEmpty
 * @property-read int   $length
 * @method Stringk forEach(Closure $action)
 * @method Stringk trim()
 * @author  Ahmed Alnahari <alna7ari@gmail.com>
 */

class Stringk
{
    private static $varProxies = [
        'lastIndex',
        'indices',
        'isEmpty',
        'length'
    ];

    private static $keyWordsProxies = [
        'forEach',
        'trim'
    ];
    /**
     *
     * @var string | int
     */
    private $value;

    /**
     * @return int
     */
    function length() {
        return strlen($this->value);
    }

    function compareTo($other, $ignoreCase = false) {
        if ($ignoreCase)
            return strcmp(strtolower($this->value), strtolower($other));

        return strcmp($this->value, $other);
    }
    /**
     * @param int $index
     * @return string|null
     */
    function get($index) {
        if (!isset($this->value[$index])) return null;
        return $this->value[$index];
    }

    /**
     * @param string $other
     * @return Stringk
     */
    function plus($other) {
        $this->value = $this->value . $other;
        return $this;
    }

    /**
     * @param int $startIndex
     * @param int $endIndex
     * @return Stringk
     */
    function subSequence($startIndex, $endIndex) {
        $str = substr($this->value, $startIndex, $endIndex - $startIndex);
        if (! $str) $str = "";
        $this->value = $str;
        return $this;
    }

    function lastIndex() {
        return $this->length() - 1;
    }

    function indices() {
        return range(0, $this->lastIndex());
    }

    function all(Closure $predicate) {
        foreach ($this->toCharArray() as $char) {
            if (! $predicate($char)) return false;
        }
        return true;
    }

    function any(Closure $predicate) {
        foreach ($this->toCharArray() as $char) {
            if ($predicate($char)) return true;
        }
        return false;
    }

    /**
     * @param string $str
     * @return Stringk
     */
    function concat($str) {
        $this->value .= $str;
        return $this;
    }

    /**
     * @param string $other
     * @param bool $ignoreCase
     * @return bool
     */
    function contains($other, $ignoreCase = false) {
        if ($ignoreCase) return stripos($this->value, $other) !== false;
        return strpos($this->value, $other) !== false;
    }

    function toCharArray() {
        return str_split($this->value);
    }

    function contentEquals($other) {
        return $this->value == $other;
    }

    function forEachIndexed(Closure $action) {
        foreach ($this->toCharArray() as $index => $char) {
            $action($index, $char);
        }
        return $this;
    }

    function substringAfter($delimiter) {
        $array = explode($delimiter, $this->value, 2);
        $result = end($array);
        $this->value = $result;
        return $this;
    }

    function substringAfterLast($delimiter) {
        $array = explode($delimiter, $this->value);
        $this->value = array_pop($array);
        return $this;
    }

    function substringBefore($delimiter) {
        $array = explode($delimiter, $this->value, 2);
        $this->value = $array[0];
        return $this;
    }

    function substringBeforeLast($delimiter) {
        $array = explode($delimiter, $this->value);
        array_pop($array);
        $this->value = implode($delimiter, $array);
        return $this;
    }

    private function forEachProxy(Closure $action) {
        foreach ($this->toCharArray() as $char) {
            $action($char);
        }
        return $this;
    }

    private function trimProxy() {
        $this->value = trim($this->value);
        return $this;
    }
    /**
     * @param string $value The value you want to process.
     */

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __get($key)
    {
        if (! in_array($key, static::$varProxies)) {
            throw new Exception("Property [{$key}] does not exist on stringk package.");
        }
        return $this->$key();
    }

    function __call($method, array $args) {
        if (! in_array($method, static::$keyWordsProxies)) {
            throw new Exception("Method [{$method}] does not exist on stringk package.");
        }
        call_user_func_array([&$this, $method."Proxy"], $args);
    }

    public function __toString()
    {
        if (is_string($this->value))
            return $this->value;
    }
}
