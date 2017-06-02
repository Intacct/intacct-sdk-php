<?php
/**
 * Copyright 2017 Intacct Corporation.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions\Common\Query\Comparison\GreaterThan;

/**
 * @coversDefaultClass \Intacct\Functions\Common\Query\Comparison\GreaterThan\GreaterThanFloat
 */
class GreaterThanFloatTest extends \PHPUnit_Framework_TestCase
{

    public function testToString()
    {
        $condition = new GreaterThanFloat();
        $condition->setField('AMOUNTDUE');
        $condition->setValue(123.45);

        $expected = "AMOUNTDUE > 123.45";

        $this->assertEquals($expected, (string)$condition);
    }

    public function testToStringNot()
    {
        $condition = new GreaterThanFloat();
        $condition->setField('AMOUNTDUE');
        $condition->setValue(123.45);
        $condition->setNegate(true);

        $expected = "NOT AMOUNTDUE > 123.45";

        $this->assertEquals($expected, (string)$condition);
    }
}