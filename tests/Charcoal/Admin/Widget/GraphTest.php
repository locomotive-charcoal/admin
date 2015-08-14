<?php

namespace Charcoal\Admin\Tests\Widget;

use \Charcoal\Admin\Widget\GraphWidget;

class GraphWidgetTest extends \PHPUnit_Framework_TestCase
{

    public function testSetData()
    {
        $obj = new GraphWidget();
        $ret = $obj->set_data([
            'height'=>222,
            'colors'=>['#ff0000', '#0000ff']
        ]);
        $this->assertSame($obj, $ret);
        $this->assertEquals(222, $obj->height());
        $this->assertEquals(['#ff0000', '#0000ff'], $obj->colors());
    }

    public function testSetHeight()
    {
        $obj = new GraphWidget();
        $this->assertEquals(400, $obj->height());

        $ret = $obj->set_height(333);
        $this->assertSame($obj, $ret);
        $this->assertEquals(333, $obj->height());

        //$this->setExpectedException('\InvalidArgumentException');
        //$obj->set_height(false);
    }

    public function testSetColors()
    {
        $obj = new GraphWidget();
        $this->assertEquals($obj->default_colors(), $obj->colors());

        $ret = $obj->set_colors(['#fff', '#000']);
        $this->assertSame($ret, $obj);
        $this->assertEquals(['#fff', '#000'], $obj->colors());

        $this->setExpectedException('\InvalidArgumentException');
        $obj->set_colors('#fff');
    }
}
