# RegexFilter
Php class that helps you validate a string against multiple filters using regular expressions.

## Class `RegexFilter`
```php
class RegexFilter
{
    // Predefined regular expressions
    public const FILTER_URL
    public const FILTER_HTML_TAGS
    public const FILTER_HTML_LINKS
    public const FILTER_PHONE_NUMBER
    public const FILTER_EMAIL_ADDRESS
    public const FILTER_IP4_ADDRESS

    public function addFilters(array $filters) : void {...}
    public function addExpressions($caseSensitive, $expressions) : void {...}
    public function match($string) : bool {...}
    public function getMatches($string) {...}
    public function getFilters() : array {...}
}

```

## Usage
```php
<?php
 include('lib/RegexFilter');
 
 $spamFilter = new RegexFilter();
 
 //Add some filters to the filter
 $spamFilter->addFilters([
    RegexFilter::FILTER_URL, // filter urls
    RegexFilter::FILTER_HTML_TAGS, //filter html tags
    RegexFilter::FILTER_HTML_LINKS //filter html <a> tag
 ]);
 
 //Add expressions to the filter
 $spamFilter->addExpressions(false, [
    "offer[a-z]*",
    "deal"
 ]);
 
 $text = "Good day Wear with intent, live with purpose.
   Fairly priced sunglasses with high quality UV400 lenses protection only $19.99
   for the next 24 Hours ONLY. Order here: kickshades.online Best,
   Accueil - SmfCoder <a href='ee.tr'>test</a>
   FREE Worldwide Shipping! Get yours for here: medicopostura.online Cheers, Accueil - SmfCoder";

 // Determine if $text match with any of our filters
 echo "This text is ". ($spamFilter->match($text) ? "a spam" : "not a spam");
 
 // Get all the matches between filters and $text
 print_r($spamFilter->getMatches($text));
```