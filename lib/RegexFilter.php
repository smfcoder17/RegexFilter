<?php

/**
 * Helps you validate a string against multiple filters using regular expressions
 */
class RegexFilter
{
    protected $filters = [];

    public const FILTER_URL = "/[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*/im";
    public const FILTER_HTML_TAGS = "/<\/?[\sa-z\d]*[^>]*>/im";
    public const FILTER_HTML_LINKS = "/<\s*a(\s+.*?>|>).*?<\s*\/\s*a\s*>/im";
    public const FILTER_PHONE_NUMBER = "/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/im";
    public const FILTER_EMAIL_ADDRESS = "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/im";
    public const FILTER_IP4_ADDRESS = "/\b(?:(?:2(?:[0-4][0-9]|5[0-5])|[0-1]?[0-9]?[0-9])\.){3}(?:(?:2([0-4][0-9]|5[0-5])|[0-1]?[0-9]?[0-9]))\b/i";

    /**
     * Add a list of regex filters to use to validate
     * your string against later on.
     * @param array $filters list of filters to add to the filter object
     */
    public function addFilters(array $filters) : void
    {
        if (is_array($filters)) {
            foreach ($filters as $filter) {
                array_push($this->filters, $filter);
            }
        }
    }

    /**
     * Add a list of expressions(words, phrases, text) to use
     * to validate your string against later on.
     * @param bool $caseSensitive precise whether the expression should be matched by case too
     * @param array $expressions list of expressions to add to the filter
     */
    public function addExpressions($caseSensitive, $expressions) : void
    {
        if (is_array($expressions)) {
            foreach ($expressions as $exp) {
                $expRegex = "/";
                $expRegex .= addslashes($exp);
                $expRegex .= ($caseSensitive) ? "/m" : "/im";
                array_push($this->filters, $expRegex);
            }
        }
    }

    /**
     * Determine whether or not the string passed as param match
     * with any of the filters.
     * @param string $string the string to match against.
     * @return bool returns true if any match found and false otherwise.
     */
    public function match($string) : bool
    {
        foreach ($this->filters as $filter) {
            if (preg_match($filter, $string)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the list of all matches between the filters
     * and the string passed.
     * @param string $string the string to match against.
     * @return array|bool list of matches if any found or false if none.
     */
    public function getMatches($string)
    {
        $matches = [];
        foreach ($this->filters as $filter) {
            if (preg_match_all($filter, $string, $filterMatches)) {
                $matches[$filter] = $filterMatches[0];
            }
        }

        return (count($matches) !== 0) ? $matches : false;
    }

    public function getFilters() : array
    {
        return $this->filters;
    }
}
