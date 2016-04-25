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

namespace Intacct;

use Intacct\Xml\RequestHandler;
use Intacct\Xml\Request\Operation\ContentBlock;
use Intacct\Xml\Request\Operation\Content\Create;
use Intacct\Xml\Request\Operation\Content\Update;
use Intacct\Xml\Request\Operation\Content\Delete;
use Intacct\Xml\Response\Operation\Result;
use Intacct\Xml\Response\Operation\ResultException;
use Intacct\Xml\Request\Operation\Content\Inspect;
use Intacct\Xml\Request\Operation\Content\ReadByQuery;
use Intacct\Xml\Request\Operation\Content\ReadMore;
use Intacct\Xml\Request\Operation\Content\Read;
use Intacct\Xml\Request\Operation\Content\ReadByName;
use Intacct\Xml\Request\Operation\Content\InstallApp;
use ArrayIterator;

trait IaObjectTrait
{
    
    /**
     * @var int
     */
    private static $MAX_QUERY_TOTAL_COUNT = 100000;

    /**
     * 
     * @param array $params
     * @param IntacctClientInterface $client
     * @return array
     */
    private function mergeParams(array $params, IntacctClientInterface &$client)
    {
        $session = $client->getSessionConfig();
        
        return array_merge($session, $params);
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - records: (array, required)
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function createRecords(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $contentBlock = new ContentBlock([
            new Create($params),
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to create records', $result->getErrors()
            );
        }

        return $result;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - records: (array, required)
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function updateRecords(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $content = new ContentBlock([
            new Update($params),
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $content);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to update records', $result->getErrors()
            );
        }

        return $result;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - keys: (array, required)
     * - object: (string, required)
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function deleteRecords(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $contentBlock = new ContentBlock([
            new Delete($params),
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to delete records', $result->getErrors()
            );
        }

        return $result;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - object: (string)
     * - show_detail: (bool, default=bool(false))
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function inspectObject(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $contentBlock = new ContentBlock([
            new Inspect([$params])
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to inspect an object', $result->getErrors()
            );
        }

        return $result;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - doc_par_id: (string)
     * - fields: (array)
     * - object: (string, required)
     * - page_size: (int, default=int(1000)
     * - query: (string)
     * - return_format: (string, default=string(3) "xml")
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function readFirstPageByQuery(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $content = new ContentBlock([
            new ReadByQuery($params),
        ]);

        $requestHandler = new RequestHandler($config);

        $operation = $requestHandler->executeContent($config, $content);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException('An error occurred trying to read query records', $result->getErrors());
        }

        return $result;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - doc_par_id: (string)
     * - fields: (array)
     * - max_total_count: (int, default=int(100000))
     * - object: (string, required)
     * - page_size: (int, default=int(1000)
     * - query: (string)
     * - return_format: (string, default=string(3) "xml")
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return ArrayIterator
     * @throws ResultException
     */
    protected function readAllObjectsByQuery(array $params, IntacctClientInterface &$client)
    {
        $defaults = [
            'max_total_count' => self::$MAX_QUERY_TOTAL_COUNT,
        ];
        $config = array_merge($defaults, $params);

        $result = $this->readFirstPageByQuery($config, $client);

        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to get query records', $result->getErrors()
            );
        }

        $records = new ArrayIterator();
        foreach ($result->getDataArray() as $record) {
            $records->append($record);
        }

        $totalCount = (int) strval($result->getData()->attributes()->totalcount);
        if ($totalCount > $config['max_total_count']) {
            throw new ResultException(
                'Query result totalcount exceeds max_total_count parameter of ' . $config['max_total_count']
            );
        }
        $numRemaining = (int) strval($result->getData()->attributes()->numremaining);
        if ($numRemaining > 0) {
            $pages = ceil($numRemaining / $config['page_size']);
            $resultId = (string) $result->getData()->attributes()->resultId;
            $config['result_id'] = $resultId;
            for ($page = 1; $page <= $pages; $page++) {
                $readMore = $this->readMore($config, $client);

                //append the readMore records to the original array
                foreach ($readMore->getDataArray() as $record) {
                    $records->append($record);
                }
            }
        }

        return $records;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - result_id: (string, required)
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function readMore(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $contentBlock = new ContentBlock([
            new ReadMore($params),
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to read more records', $result->getErrors()
            );
        }

        return $result;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - doc_par_id: (string)
     * - fields: (array)
     * - keys: (array)
     * - object: (string, required)
     * - return_format: (string, default=string(3) "xml")
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function readRecordById(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $contentBlock = new ContentBlock([
            new Read($params),
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to read records', $result->getErrors()
            );
        }

        return $result;
    }

    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - fields: (array)
     * - names: (array)
     * - object: (string, required)
     * - return_format: (string, default=string(3) "xml")
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function readRecordByName(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $contentBlock = new ContentBlock([
            new ReadByName($params),
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
                'An error occurred trying to read records by name', $result->getErrors()
            );
        }

        return $result;
    }
    
    /**
     * Accepts the following options:
     *
     * - control_id: (string)
     * - xml_filename: (string)
     *
     * @param array $params
     * @param IntacctClientInterface $client
     * @return Result
     * @throws ResultException
     */
    protected function installApp(array $params, IntacctClientInterface &$client)
    {
        $config = $this->mergeParams($params, $client);

        $contentBlock = new ContentBlock([
            new InstallApp($params)
        ]);

        $requestHandler = new RequestHandler($params);

        $operation = $requestHandler->executeContent($config, $contentBlock);

        $result = $operation->getResult();
        if ($result->getStatus() !== 'success') {
            throw new ResultException(
            'An error occurred trying to install platform app', $result->getErrors()
            );
        }

        return $result;
    }

}