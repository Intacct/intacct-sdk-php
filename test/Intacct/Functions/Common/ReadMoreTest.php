<?php

/**
 * Copyright 2021 Sage Intacct, Inc.
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

namespace Intacct\Functions\Common;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \Intacct\Functions\Common\ReadMore
 */
class ReadMoreTest extends \PHPUnit\Framework\TestCase
{

    public function testParamOverrides(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <readMore>
        <resultId>6465763031VyprCMCoHYQAAGr@aRsAAAAU4</resultId>
    </readMore>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $readMore = new ReadMore('unittest');
        $readMore->setResultId('6465763031VyprCMCoHYQAAGr@aRsAAAAU4');

        $readMore->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testNoResultId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Result ID or report ID is required for read more");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $readMore = new ReadMore('unittest');
        //$readMore->setResultId('6465763031VyprCMCoHYQAAGr@aRsAAAAU4');

        $readMore->writeXml($xml);
    }
}
