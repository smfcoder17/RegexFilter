<?php
include("../../lib/RegexFilter.php");

class AdultContentDetector
{
    public $filter;

    public function __construct()
    {
        $this->filter = new RegexFilter();
        $this->filter->addExpressions(false, include('words-db.php'));
    }

    public function isSafe($text) {
        return !$this->filter->match($text);
    }
    public function getUnsafeWords($text) {
        return $this->filter->getMatches($text);
    }
}

$detector = new AdultContentDetector();
$testString = "<h1>This is spammy</h1>";
$testString2 = "<h1>This is not an ass, but fuck it smells bad.</h1>";

// var_dump($detector->filter->getFilters());
echo $testString2 ."<br>";
if ($detector->isSafe($testString2)) {
    echo "text seem safe";
} else {
    echo "Warning, text contains adult content.<br>";
    print_r($detector->getUnsafeWords($testString2));
}
