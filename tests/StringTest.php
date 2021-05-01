<?php


namespace Alnahari\Stringk\Tests;


use Alnahari\Stringk\Stringk;

class StringTest extends TestCase
{
    public function testForEach() {
        $string = new Stringk("ahmed");
        $result = "";
        $string->forEach(function ($char) use (&$result) {
            $result .= $char;
        });
        $this->assertEquals("ahmed", $result);
    }

    public function testContains() {
        $result = string("contains")->contains("Con");
        $this->assertFalse($result);

        $result = string("contains")->contains("Con", true);
        $this->assertTrue($result);
    }

    public function testSubStr() {
        //after first
        $array = explode('_', '233718_This_is_a_string', 2);
        $text = end($array);
        $this->assertEquals("This_is_a_string", $text);
        //after last
        $array = explode('_', '233718_This_is_a_string');
        $text = array_pop($array);
        $this->assertEquals("string", $text);
        //before first
        $array = explode('_', '233718_This_is_a_string', 2);
        $text = $array[0];
        $this->assertEquals("233718", $text);
        //before last
        $array = explode('_', '233718_This_is_a_string');
        array_pop($array);
        $text = implode('_', $array);
        $this->assertEquals("233718_This_is_a", $text);
    }

    public function testSubstringAfter() {
        $result = string("this is is only test")->substringAfter("this is")->trim();
        $this->assertEquals("is only test", $result);
    }

    public function testSubstringFromTo() {
        $result = string("this is is only test")->substringAfter("this")->substringBefore("test");
        $this->assertEquals("is is only", $result);
    }
}
