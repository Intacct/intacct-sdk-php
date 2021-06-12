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

use Intacct\Functions\AbstractFunction;
use Intacct\Xml\XMLWriter;

class ReadMore extends AbstractFunction
{
    
    /** @var string */
    private $resultId = '';

     /** @var string */
	private $reportId = '';

    /**
     * @return string
     */
    public function getResultId(): string
    {
        return $this->resultId;
    }

    /**
     * @param string $resultId
     */
    public function setResultId(string $resultId)
    {
        $this->resultId = $resultId;
    }
    
    /**
     * @return string
     */
    public function getReportId(): string
    {
        return $this->reportId;
    }

    /**
     * @param string $reportId
     */
    public function setReportId(string $reportId)
    {
        $this->reportId = $reportId;
    }

    /**
     * Write the readMore block XML
     *
     * @param XMLWriter $xml
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());
        
        $xml->startElement('readMore');

        if ($this->getResultId()) {
            $xml->writeElement('resultId', $this->getResultId(), true);
        }
		else if ($this->getReportId()) {
            $xml->writeElement('reportId', $this->getReportId(), true);
        }
        else {
            throw new \InvalidArgumentException(
                'Result ID or report ID is required for read more'
            );
        }
        
        $xml->endElement(); //readMore
        
        $xml->endElement(); //function
    }
}
