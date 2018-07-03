<?php

namespace Vundb\Test\IfElse;

use PHPUnit\Framework\TestCase;
use Vundb\IfElse\Product;
use Vundb\IfElse\Tool;

/**
 * Class ToolTest
 *
 * @package Vundb\Test\IfElse
 *
 */
class ToolTest extends TestCase
{
    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod()
    {
        $product = new Product();
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 0], $old);
        $this->assertSame(['quantity' => 0], $new);
    }

    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod_withZeroQuantity()
    {
        $product = new Product();
        $product->quantity = 0;
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 0], $old);
        $this->assertSame(['quantity' => 0], $new);
    }

    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod_withQuantity()
    {
        $product = new Product();
        $product->quantity = 11;
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 11], $old);
        $this->assertSame(['quantity' => 11], $new);
    }

    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod_withQuantity_andEmptyRelation()
    {
        $product = new Product();
        $product->quantity = 11;
        $product->quantity_relation = '';
        $product->availability = '';
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 0], $old);
        $this->assertSame(['quantity' => 0], $new);
    }

    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod_withQuantity_andEqualRelation()
    {
        $product = new Product();
        $product->quantity = 11;
        $product->quantity_relation = '=';
        $product->availability = '';
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 11], $old);
        $this->assertSame(['quantity' => 11], $new);
    }

    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod_withQuantity_andGreatherRelation()
    {
        $product = new Product();
        $product->quantity = 11;
        $product->quantity_relation = '>';
        $product->availability = '';
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 11], $old);
        $this->assertSame(['quantity' => 11], $new);
    }

    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod_withoutQuantity_withEmptyAvailability()
    {
        $product = new Product();
        $product->quantity_relation = '>';
        $product->availability = '';
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 0], $old);
        $this->assertSame(['quantity' => 0], $new);
    }

    /**
     * @covers \Vundb\IfElse\Tool
     */
    public function testMethod_withoutQuantity_withValidAvailability()
    {
        $product = new Product();
        $product->quantity_relation = '>';
        $product->availability = 'in stock';
        $tool = new Tool();

        $old = $tool->oldMethod($product);
        $new = $tool->newMethod($product);

        $this->assertSame(['quantity' => 3], $old);
        $this->assertSame(['quantity' => 3], $new);
    }
}
