<?php

/**
 * Copyright 2016 Intacct Corporation.
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

namespace Intacct\Functions\DDS;

use Intacct\Xml\XMLWriter;

class GetObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Intacct\Functions\DDS\GetDDL::__construct
     * @covers Intacct\Functions\DDS\GetDDL::setObjectName
     * @covers Intacct\Functions\DDS\GetDDL::getObjectName
     * @covers Intacct\Functions\DDS\GetDDL::getXML
     */
    public function testDefaultParams()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <getDdsDdl>
        <object>GLACCOUNT</object>
    </getDdsDdl>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $ddl = new GetDDL([
            'object' => 'GLACCOUNT',
            'control_id' => 'unittest',
        ]);

        $ddl->getXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
}