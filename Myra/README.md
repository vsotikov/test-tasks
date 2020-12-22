# Assessment test backend developer

## Input

### Description

MyraCache (MC) customers are receiving a bill, which is based on the page impressions (PI) their online shop made in the last month. The billing amount of the invoice depends on the PI. Cost is based per 100,000 PI.
Currently MyraCache is generating a CSV "MyraCache_1.csv", which includes date, URL, PI / day, and MB / day. From that CSV we are manually calculating the PI totals per customer per month. We charge the customer for each commenced 100,000 PI a fixed amount.
After the calculation we manually edit invoices in OpenOffice. 
The current effort when a new customer signs a contract is to open the file Template_Rechnung_Deutschland.odt and create a new template for that new customer editing following items:

- Invoice address of the client
- Sender address - Soprado GmbH - Bavariafilmplatz 7 - 82031 Grünwald
- Phone – if it changed – currently 089/75 40 88 30
- Fax – if it changed – currently 089/75 40 88 33
- Email – if it changed – currently info@soprado.de
- Header – if it changed – currently SOPRADO GMBH
- Footer – stayes the same, except something changes
- Column heading – Rechnung %RENR%
- Text in column "Leistung" 
- Calculation of the invoice amount, %EINHEITSPREIS%, %ANZAHL%, and so on
- Due date of the payment
- Signature – if it changes – currently Sascha Schumann

### Calculation

Commenced 100,000 PI x Unit Price = MyraCache-cost per month excluding VAT. 
Depending on the MC package the costs varies:

- Basic = 50, - EUR
- Professional = 120, - EUR
- Enterprise = individual (for reference see pricelist "myracache-preise.pdf").

## Tasks

- Use the OpenOffice template with placeholders (Template_Rechnung_Deutschland.odt) 
- ODT files can be unpacked as a ZIP file, which contain XML documents. One of these file is the main document with placeholders. 
- Generate the invoice based on "MyraCache_1.csv" (date, URL, PI / day, MB / day) round up the sum
- Replace placeholders in the XML main document, save it as a file odt. 
- Info - sample customer has the "MyraCache Professional Edition" in use. 
- Bonus task: convert the ODT to PDF.

## Expected result

Most possible level of automation of MyraCache billing. 

## Additional information
- [Myracloud](https://myracloud.com/en/)
- [Open Document technical specification](https://en.wikipedia.org/wiki/OpenDocument_technical_specification)
- [Comma sparated values](https://en.wikipedia.org/wiki/Comma-separated_values)
- [XML](https://en.wikipedia.org/wiki/XML)
- [PHP](http://php.net/)

