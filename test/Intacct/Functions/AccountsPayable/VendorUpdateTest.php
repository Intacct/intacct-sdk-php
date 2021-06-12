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

namespace Intacct\Functions\AccountsPayable;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \Intacct\Functions\AccountsPayable\VendorUpdate
 */
class VendorUpdateTest extends \PHPUnit\Framework\TestCase
{

    public function testConstruct(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <update>
        <VENDOR>
            <VENDORID>V1234</VENDORID>
            <DISPLAYCONTACT/>
        </VENDOR>
    </update>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new VendorUpdate('unittest');
        $record->setVendorId('V1234');

        $record->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testFullXml(): void
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <update>
        <VENDOR>
            <VENDORID>V1234</VENDORID>
            <NAME>SaaS Co</NAME>
            <DISPLAYCONTACT>
                <PRINTAS>SaaS Corp</PRINTAS>
                <COMPANYNAME>SaaS Co</COMPANYNAME>
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
                <EMAIL1>noreply@intacct.com</EMAIL1>
                <EMAIL2>noreplyagain@intacct.com</EMAIL2>
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
            <VENDTYPE>SaaS</VENDTYPE>
            <PARENTID>V5678</PARENTID>
            <GLGROUP>Group</GLGROUP>
            <TAXID>12-3456789</TAXID>
            <NAME1099>SAAS CORP</NAME1099>
            <FORM1099TYPE>MISC</FORM1099TYPE>
            <FORM1099BOX>3</FORM1099BOX>
            <SUPDOCID>A1234</SUPDOCID>
            <APACCOUNT>2000</APACCOUNT>
            <CREDITLIMIT>1234.56</CREDITLIMIT>
            <ONHOLD>false</ONHOLD>
            <DONOTCUTCHECK>false</DONOTCUTCHECK>
            <COMMENTS>my comment</COMMENTS>
            <CURRENCY>USD</CURRENCY>
            <CONTACTINFO>
                <CONTACTNAME>primary</CONTACTNAME>
            </CONTACTINFO>
            <PAYTO>
                <CONTACTNAME>pay to</CONTACTNAME>
            </PAYTO>
            <RETURNTO>
                <CONTACTNAME>return to</CONTACTNAME>
            </RETURNTO>
            <PAYMETHODKEY>Printed Check</PAYMETHODKEY>
            <MERGEPAYMENTREQ>true</MERGEPAYMENTREQ>
            <PAYMENTNOTIFY>true</PAYMENTNOTIFY>
            <BILLINGTYPE>openitem</BILLINGTYPE>
            <PAYMENTPRIORITY>Normal</PAYMENTPRIORITY>
            <TERMNAME>N30</TERMNAME>
            <DISPLAYTERMDISCOUNT>false</DISPLAYTERMDISCOUNT>
            <ACHENABLED>true</ACHENABLED>
            <ACHBANKROUTINGNUMBER>123456789</ACHBANKROUTINGNUMBER>
            <ACHACCOUNTNUMBER>1111222233334444</ACHACCOUNTNUMBER>
            <ACHACCOUNTTYPE>Checking Account</ACHACCOUNTTYPE>
            <ACHREMITTANCETYPE>CTX</ACHREMITTANCETYPE>
            <VENDORACCOUNTNO>9999999</VENDORACCOUNTNO>
            <DISPLAYACCTNOCHECK>false</DISPLAYACCTNOCHECK>
            <OBJECTRESTRICTION>Restricted</OBJECTRESTRICTION>
            <RESTRICTEDLOCATIONS>100#~#200</RESTRICTEDLOCATIONS>
            <RESTRICTEDDEPARTMENTS>D100#~#D200</RESTRICTEDDEPARTMENTS>
            <CUSTOMFIELD1>Hello</CUSTOMFIELD1>
        </VENDOR>
    </update>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new VendorUpdate('unittest');
        $record->setVendorId('V1234');
        $record->setVendorName('SaaS Co');
        $record->setPrintAs('SaaS Corp');
        $record->setCompanyName('SaaS Co');
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
        $record->setPrimaryEmailAddress('noreply@intacct.com');
        $record->setSecondaryEmailAddress('noreplyagain@intacct.com');
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
        $record->setVendorTypeId('SaaS');
        $record->setParentVendorId('V5678');
        $record->setGlGroupName('Group');
        $record->setForm1099Name('SAAS CORP');
        $record->setForm1099Type('MISC');
        $record->setForm1099Box(3);
        $record->setAttachmentsId('A1234');
        $record->setDefaultExpenseGlAccountNo('2000');
        $record->setCreditLimit(1234.56);
        $record->setOnHold(false);
        $record->setDoNotPay(false);
        $record->setComments('my comment');
        $record->setDefaultCurrency('USD');
        $record->setPrimaryContactName('primary');
        $record->setPayToContactName('pay to');
        $record->setReturnToContactName('return to');
        $record->setPreferredPaymentMethod('Printed Check');
        $record->setMergePaymentRequests(true);
        $record->setSendAutomaticPaymentNotification(true);
        $record->setVendorBillingType('openitem');
        $record->setPaymentPriority('Normal');
        $record->setPaymentTerm('N30');
        $record->setTermDiscountDisplayedOnCheckStub(false);
        $record->setAchEnabled(true);
        $record->setAchBankRoutingNo('123456789');
        $record->setAchBankAccountNo('1111222233334444');
        $record->setAchBankAccountType('Checking Account');
        $record->setAchBankAccountClass('CTX');
        $record->setVendorAccountNo('9999999');
        $record->setLocationAssignedAccountNoDisplayedOnCheckStub(false);
        $record->setRestrictionType(VendorUpdate::RESTRICTION_TYPE_RESTRICTED);
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

    public function testRequiredName()
    {
        $this->expectExceptionMessage("Vendor ID or record number is required for update");
        $this->expectException(InvalidArgumentException::class);

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $record = new VendorUpdate('unittest');

        $record->writeXml($xml);
    }
}
