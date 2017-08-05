<?php
/**
 * Copyright 2017 Sage Intacct, Inc.
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

namespace Intacct\Xml\Request;

use Intacct\Xml\XMLWriter;

/**
 * @coversDefaultClass \Intacct\Xml\Request\SessionAuthentication
 */
class SessionAuthenticationTest extends \PHPUnit\Framework\TestCase
{

    public function testWriteXml()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<authentication>
    <sessionid>testsessionid..</sessionid>
</authentication>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $sessionAuth = new SessionAuthentication('testsessionid..');
        $sessionAuth->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Session ID is required and cannot be blank
     */
    public function testInvalidSession()
    {
        new SessionAuthentication('');
    }
}
