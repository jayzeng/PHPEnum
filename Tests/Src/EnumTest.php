<?php
/**
 * Test Abtract Enum class
 * @author Jay Zeng (jayzeng@jay-zeng.com)
 * @version 0.1
 */
namespace Test\Util;

use Util\Enum;

class Stub_Util_Enum extends Enum
{
    const ONE   = 1;
    const TWO   = 2;
    const THREE = 3;
    const FOUR  = "four";
}

class Stub_Util_Enum_Non_Unique extends Enum
{

}

class EnumAbstractTest extends \PHPUnit_Framework_TestCase
{
    private $stubUtilEnum;

    protected function setUp() {
        $this->stubUtilEnum = new Stub_Util_Enum();
    }

    protected function tearDown() {
        unset($this->stubUtilEnum);
    }

    /**
     * Test create() from EnumAbstract, should return an instance of the subclass
     * @return void
     */
    public function testCreate() {
        $this->assertInstanceOf( '\Test\Util\Stub_Util_Enum', Stub_Util_Enum::create() );
        $this->assertInstanceOf( '\Test\Util\Stub_Util_Enum_Non_Unique', Stub_Util_Enum_Non_Unique::create() );
    }

    public function testGetAllValues() {
        $this->assertSame(
                array(
                    'ONE'   => 1,
                    'TWO'   => 2,
                    'THREE' => 3,
                    'FOUR'  => "four"
                    ),
                $this->stubUtilEnum->getAllValues()
                );
        $this->assertEquals(1, $this->stubUtilEnum->getValue('ONE'));
        $this->assertEquals(2, $this->stubUtilEnum->getValue('TWO'));
        $this->assertEquals(3, $this->stubUtilEnum->getValue('THREE'));
        $this->assertEquals('four', $this->stubUtilEnum->getValue('FOUR'));
    }

    public function testHasValue() {
        // return type
        $this->assertInternalType('boolean', $this->stubUtilEnum->hasValue(2));

        // return value
        $this->assertTrue($this->stubUtilEnum->hasValue(1));
        $this->assertTrue($this->stubUtilEnum->hasValue('four'));
        $this->assertFalse($this->stubUtilEnum->hasValue('whatever'));
    }

    public function testGetLabels() {
        $labels = $this->stubUtilEnum->getLabels();

        // return type
        $this->assertInternalType('array', $labels);
        $this->assertContains('ONE', $labels);
        $this->assertCount(4, $labels);
    }

    public function testGetLabel() {
        $this->assertEquals('ONE', $this->stubUtilEnum->getLabel(1));
        $this->assertEquals('TWO', $this->stubUtilEnum->getLabel(2));
        $this->assertEquals('THREE', $this->stubUtilEnum->getLabel(3));
        $this->assertEquals('FOUR', $this->stubUtilEnum->getLabel('four'));
        $this->assertNotEquals('Five', $this->stubUtilEnum->getLabel('four'));
    }

    public function testGetValues() {
        $values = $this->stubUtilEnum->getValues();

        // return type
        $this->assertInternalType('array', $values);
        $this->assertContains('four', $values);
        $this->assertContains(1, $values);
        $this->assertCount(4, $values);
    }

    public function testHasLabel() {
        $this->assertTrue($this->stubUtilEnum->hasLabel('ONE'));
        $this->assertTrue($this->stubUtilEnum->hasLabel('FOUR'));

        // Yes, we don't support case insensitive search for now
        $this->assertFalse($this->stubUtilEnum->hasLabel('four'));
        $this->assertFalse($this->stubUtilEnum->hasLabel('whatever'));
    }

    public function testIsEnum() {
        $this->assertTrue(Enum::isEnumable('\Test\Util\Stub_Util_Enum'));
        $this->assertTrue(Enum::isEnumable('\Test\Util\Stub_Util_Enum_Non_Unique'));
        $this->assertFalse(Enum::isEnumable('weDontHaveThisSuperLongClass'));
    }
}
?>
