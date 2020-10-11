<?php
include("../../lib/RegexFilter.php");

class SpamDetector
{
    public $filter;

    public function __construct()
    {
        $this->filter = new RegexFilter();
        $this->filter->addFilters([
            RegexFilter::FILTER_URL,
            RegexFilter::FILTER_HTML_TAGS
        ]);
        $this->filter->addExpressions(false, [
            "offer[a-z]*"
        ]);
    }

    public function isSpamLike($text) {
        return $this->filter->match($text);
    }
}

$spamDetector = new SpamDetector();
$testString = "<h1>This is spammy</h1>";

echo $spamDetector->isSpamLike($testString) ? "Warning, spam-like text." : "No filter matched.";