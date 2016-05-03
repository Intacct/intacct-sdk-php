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

namespace Intacct\Functions;

use Intacct\Xml\Request\Operation\Content\StandardObjects;
use InvalidArgumentException;
use Intacct\Xml\XMLWriter;

class Delete implements FunctionInterface
{

    use ControlIdTrait;
    
    /**
     * @var int
     */
    const MAX_KEY_COUNT = 100;

    /**
     *
     * @var string
     */
    private $objectName;

    /**
     *
     * @var array
     */
    private $keys;

    /**
     * 
     * @param array $params
     * @throws InvalidArgumentException
     */
    public function __construct(array $params = [])
    {
        $defaults = [
            'control_id' => null,
            'object' => null,
            'keys' => [],
        ];
        $config = array_merge($defaults, $params);

        if (!$config['object']) {
            throw new InvalidArgumentException(
                'Required "object" key not supplied in params'
            );
        }

        if (in_array('delete', StandardObjects::getMethodsNotAllowed($config['object']))) {
            throw new InvalidArgumentException(
                'using delete on object "' . $config['object'] . '" is not allowed'
            );
        }

        $this->setControlId($config['control_id']);
        $this->objectName = $config['object'];
        $this->setKeys($config['keys']);
    }

    /**
     * 
     * @param array $keys
     * @throws InvalidArgumentException
     */
    private function setKeys(array $keys)
    {
        if (count($keys) > static::MAX_KEY_COUNT) {
            throw new InvalidArgumentException(
                'keys count cannot exceed ' . static::MAX_KEY_COUNT
            );
        } else if (count($keys) === 0) {
            throw new InvalidArgumentException(
                'keys count must be greater than zero'
            );
        }

        $this->keys = $keys;
    }
    
    /**
     * 
     * @return string
     */
    private function getKeys()
    {
        $keys = implode(',', $this->keys);
        
        return $keys;
    }
    
    /**
     * 
     * @param XMLWriter $xml
     */
    public function getXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());
        
        $xml->startElement('delete');
        
        $xml->writeElement('object', $this->objectName, true);
        $xml->writeElement('keys', $this->getKeys(), true);
        
        $xml->endElement(); //delete
        
        $xml->endElement(); //function
    }

}
