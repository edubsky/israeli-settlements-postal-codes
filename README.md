# israeli-settlements-postal-codes
Postal codes for Israeli settlements and an API to easily check if you're dealing with one. Handy for supply chain due diligence, compliance monitoring, and such.

# demo
Check if a seven-digit postal code (e.g. 1093000) matches a list of postal codes for Israeli settlements:: 
`https://wwwdot.org/settlements/api.php?postal_code=1093000&callback=is_it_illegal`

Returns this JSONP:

`is_it_illegal({'postal_code' : 1093000, 'is_settlement' : TRUE, 'occupying_power' : 'Israel', 'information_source' : 'European Commission', 'further_information' : 'https://taxation-customs.ec.europa.eu/eu-israel-technical-arrangement_en'})`
