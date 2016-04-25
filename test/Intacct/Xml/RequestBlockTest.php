<?php

namespace Intacct\Xml;

use Intacct\Xml\Request\Operation\ContentBlock;

class RequestBlockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Intacct\Xml\RequestBlock::__construct
     * @covers Intacct\Xml\RequestBlock::getXml
     * @covers Intacct\Xml\RequestBlock::getVerifySSL
     */
    public function testGetXml()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="iso-8859-1"?>
<request><control><senderid>testsenderid</senderid><password>pass123!</password><controlid>requestControlId</controlid><uniqueid>false</uniqueid><dtdversion>3.0</dtdversion><policyid/><includewhitespace>false</includewhitespace></control><operation transaction="false"><authentication><sessionid>testsession..</sessionid></authentication><content></content></operation></request>
EOF;

        $config = [
            'sender_id' => 'testsenderid',
            'sender_password' => 'pass123!',
            'session_id' => 'testsession..',
        ];

        $contentBlock = new ContentBlock();

        $requestHandler = new RequestBlock($config, $contentBlock);

        $xml = $requestHandler->getXml();

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
}
