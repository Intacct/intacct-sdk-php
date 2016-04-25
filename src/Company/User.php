<?php

/*
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

namespace Intacct\Company;

use Intacct\IntacctClientInterface;
use Intacct\Xml\Response\Operation\Result;
use Intacct\Xml\Response\Operation\ResultException;
use Intacct\Xml\Request\Operation\ContentBlock;
use Intacct\Xml\Request\Operation\Content\GetUserPermissions;
use Intacct\Xml\RequestHandler;

class User implements UserInterface
{
    
    /**
     *
     * @var IntacctClientInterface
     */
    private $client;

    /**
     * User constructor.
     * @param IntacctClientInterface $client
     */
    public function __construct(IntacctClientInterface &$client)
    {
        $this->client = $client;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - user_id: (string, required)
     *
     * @param array $params
     * @return Result
     * @throws ResultException
     */
    public function getUserPermissions(array $params)
    {
        $session = $this->client->getSessionConfig();
        $config = array_merge($session, $params);

        $contentBlock = new ContentBlock([
            new GetUserPermissions($params),
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to get user permissions', $result->getErrors()
            );
        }

        return $result;
    }

}