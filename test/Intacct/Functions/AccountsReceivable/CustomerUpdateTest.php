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

namespace Intacct\Functions\AccountsReceivable;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \Intacct\Functions\AccountsReceivable\CustomerUpdate
 */
class CustomerUpdateTest extends \PHPUnit\Framework\TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <update>
        <CUSTOMER>
            <CUSTOMERID>C1234</CUSTOMERID>
            <DISPLAYCONTACT />
        </CUSTOMER>
    </update>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new CustomerUpdate('unittest');
        $record->setCustomerId('C1234');

        $record->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testFullXml(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <update>
        <CUSTOMER>
            <CUSTOMERID>C1234</CUSTOMERID>
            <NAME>SaaS Corp</NAME>
            <DISPLAYCONTACT>
                <PRINTAS>SaaS Corporation</PRINTAS>
                <COMPANYNAME>SaaS Corp.</COMPANYNAME>
                <TAXABLE>true</TAXABLE>
                <TAXGROUP>CA</TAXGROUP>
                <PREFIX>Mr</PREFIX>
                <FIRSTNAME>Bill</FIRSTNAME>
                <LASTNAME>Smith</LASTNAME>
                <INITIAL>G</INITIAL>
                <PHONE1>12</PHONE1>
                <PHONE2>34</PHONE2>
                <CELLPHONE>56</CELLPHONE>
                <PAGER>78</PAGER>
                <FAX>90</FAX>
                <EMAIL1/>
                <EMAIL2/>
                <URL1>www.intacct.com</URL1>
                <URL2>us.intacct.com</URL2>
                <MAILADDRESS>
                    <ADDRESS1>300 Park Ave</ADDRESS1>
                    <ADDRESS2>Ste 1400</ADDRESS2>
                    <CITY>San Jose</CITY>
                    <STATE>CA</STATE>
                    <ZIP>95110</ZIP>
                    <COUNTRY>United States</COUNTRY>
                    <COUNTRYCODE>US</COUNTRYCODE>
                </MAILADDRESS>
            </DISPLAYCONTACT>
            <ONETIME>false</ONETIME>
            <STATUS>active</STATUS>
            <HIDEDISPLAYCONTACT>false</HIDEDISPLAYCONTACT>
            <CUSTTYPE>SaaS</CUSTTYPE>
            <PARENTID>C5678</PARENTID>
            <GLGROUP>Group</GLGROUP>
            <TERRITORYID>NE</TERRITORYID>
            <SUPDOCID>A1234</SUPDOCID>
            <TERMNAME>N30</TERMNAME>
            <OFFSETGLACCOUNTNO>1200</OFFSETGLACCOUNTNO>
            <ARACCOUNT>4000</ARACCOUNT>
            <SHIPPINGMETHOD>USPS</SHIPPINGMETHOD>
            <RESALENO>123</RESALENO>
            <TAXID>12-3456789</TAXID>
            <CREDITLIMIT>1234.56</CREDITLIMIT>
            <ONHOLD>false</ONHOLD>
            <DELIVERYOPTIONS>Print#~#E-Mail</DELIVERYOPTIONS>
            <CUSTMESSAGEID>hello</CUSTMESSAGEID>
            <COMMENTS>my comment</COMMENTS>
            <CURRENCY>USD</CURRENCY>
            <ARINVOICEPRINTTEMPLATEID>temp1</ARINVOICEPRINTTEMPLATEID>
            <OEQUOTEPRINTTEMPLATEID>temp2</OEQUOTEPRINTTEMPLATEID>
            <OEORDERPRINTTEMPLATEID>temp3</OEORDERPRINTTEMPLATEID>
            <OELISTPRINTTEMPLATEID>temp4</OELISTPRINTTEMPLATEID>
            <OEINVOICEPRINTTEMPLATEID>temp5</OEINVOICEPRINTTEMPLATEID>
            <OEADJPRINTTEMPLATEID>temp6</OEADJPRINTTEMPLATEID>
            <OEOTHERPRINTTEMPLATEID>temp7</OEOTHERPRINTTEMPLATEID>
            <CONTACTINFO>
                <CONTACTNAME>primary</CONTACTNAME>
            </CONTACTINFO>
            <BILLTO>
                <CONTACTNAME>bill to</CONTACTNAME>
            </BILLTO>
            <SHIPTO>
                <CONTACTNAME>ship to</CONTACTNAME>
            </SHIPTO>
            <OBJECTRESTRICTION>Restricted</OBJECTRESTRICTION>
            <RESTRICTEDLOCATIONS>100#~#200</RESTRICTEDLOCATIONS>
            <RESTRICTEDDEPARTMENTS>D100#~#D200</RESTRICTEDDEPARTMENTS>
            <CUSTOMFIELD1>Hello</CUSTOMFIELD1>
        </CUSTOMER>
    </update>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new CustomerUpdate('unittest');
        $record->setCustomerId('C1234');
        $record->setCustomerName('SaaS Corp');
        $record->setPrintAs('SaaS Corporation');
        $record->setCompanyName('SaaS Corp.');
        $record->setTaxable(true);
        $record->setTaxId('12-3456789');
        $record->setContactTaxGroupName('CA');
        $record->setPrefix('Mr');
        $record->setFirstName('Bill');
        $record->setLastName('Smith');
        $record->setMiddleName('G');
        $record->setPrimaryPhoneNo('12');
        $record->setSecondaryPhoneNo('34');
        $record->setCellularPhoneNo('56');
        $record->setPagerNo('78');
        $record->setFaxNo('90');
        $record->setPrimaryEmailAddress('');
        $record->setSecondaryEmailAddress('');
        $record->setPrimaryUrl('www.intacct.com');
        $record->setSecondaryUrl('us.intacct.com');
        $record->setAddressLine1('300 Park Ave');
        $record->setAddressLine2('Ste 1400');
        $record->setCity('San Jose');
        $record->setStateProvince('CA');
        $record->setZipPostalCode('95110');
        $record->setCountry('United States');
        $record->setIsoCountryCode('US');
        $record->setOneTime(false);
        $record->setActive(true);
        $record->setExcludedFromContactList(false);
        $record->setCustomerTypeId('SaaS');
        $record->setParentCustomerId('C5678');
        $record->setGlGroupName('Group');
        $record->setTerritoryId('NE');
        $record->setAttachmentsId('A1234');
        $record->setPaymentTerm('N30');
        $record->setOffsetArGlAccountNo('1200');
        $record->setDefaultRevenueGlAccountNo('4000');
        $record->setShippingMethod('USPS');
        $record->setResaleNumber('123');
        $record->setCreditLimit(1234.56);
        $record->setOnHold(false);
        $record->setDeliveryMethod([
            'Print',
            'E-Mail',
        ]);
        $record->setDefaultInvoiceMessage('hello');
        $record->setComments('my comment');
        $record->setDefaultCurrency('USD');
        $record->setPrintOptionArInvoiceTemplateName('temp1');
        $record->setPrintOptionOeQuoteTemplateName('temp2');
        $record->setPrintOptionOeOrderTemplateName('temp3');
        $record->setPrintOptionOeListTemplateName('temp4');
        $record->setPrintOptionOeInvoiceTemplateName('temp5');
        $record->setPrintOptionOeAdjustmentTemplateName('temp6');
        $record->setPrintOptionOeOtherTemplateName('temp7');
        $record->setPrimaryContactName('primary');
        $record->setBillToContactName('bill to');
        $record->setShipToContactName('ship to');
        $record->setRestrictionType(CustomerUpdate::RESTRICTION_TYPE_RESTRICTED);
        $record->setRestrictedLocations([
            '100',
            '200',
        ]);
        $record->setRestrictedDepartments([
            'D100',
            'D200',
        ]);
        $record->setCustomFields([
            'CUSTOMFIELD1' => 'Hello',
        ]);

        $record->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testRequiredId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Customer ID or record number is required for update");

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new CustomerUpdate('unittest');

        $record->writeXml($xml);
    }
}
