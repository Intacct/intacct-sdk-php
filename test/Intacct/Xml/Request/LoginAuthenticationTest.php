<?php
/**
 * Copyright 2018 Sage Intacct, Inc.
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
 * @coversDefaultClass \Intacct\Xml\Request\LoginAuthentication
 */
class LoginAuthenticationTest extends \PHPUnit\Framework\TestCase
{

    public function testWriteXml()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<authentication>
    <login>
        <userid>testuser</userid>
        <companyid>testcompany</companyid>
        <password>testpass</password>
    </login>
</authentication>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $loginAuth = new LoginAuthentication('testuser', 'testcompany', 'testpass');
        $loginAuth->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testWriteXmlWithEntity()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<authentication>
    <login>
        <userid>testuser</userid>
        <companyid>testcompany</companyid>
        <password>testpass</password>
        <locationid>testentity</locationid>
    </login>
</authentication>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $loginAuth = new LoginAuthentication('testuser', 'testcompany', 'testpass', 'testentity');
        $loginAuth->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testWriteXmlWithEmptyEntity()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<authentication>
    <login>
        <userid>testuser</userid>
        <companyid>testcompany</companyid>
        <password>testpass</password>
        <locationid/>
    </login>
</authentication>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $loginAuth = new LoginAuthentication('testuser', 'testcompany', 'testpass', '');
        $loginAuth->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Company ID is required and cannot be blank
     */
    public function testInvalidCompanyId()
    {
        new LoginAuthentication('testuser', '', 'testpass');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage User ID is required and cannot be blank
     */
    public function testInvalidUserId()
    {
        new LoginAuthentication('', 'testcompany', 'testpass');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage User Password is required and cannot be blank
     */
    public function testInvalidUserPass()
    {
        new LoginAuthentication('testuser', 'testcompany', '');
    }
}
