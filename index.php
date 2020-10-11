<?php
    include("lib/RegexFilter.php");
    $app = "RegexFilter";

    $spamFilter = new RegexFilter();
    $spamFilter->addFilters([
        RegexFilter::FILTER_URL,
        RegexFilter::FILTER_HTML_TAGS,
        RegexFilter::FILTER_HTML_LINKS
    ]);
    $spamFilter->addExpressions(false, [
        "offer[a-z]*",
        "deal"
    ]);

    $text = "Good day Wear with intent, live with purpose. Fairly priced sunglasses with high quality UV400 lenses protection only $19.99 for the next 24 Hours ONLY. Order here: kickshades.online Best, Accueil - SmfCoder <a href='ee.tr'>test</a>
FREE Worldwide Shipping! Get yours for here: medicopostura.online Cheers, Accueil - SmfCoder";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/prism.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1><?= $app ?></h1>
    <p><em class="token class-name"><?= $app ?></em> is a class that allow you to validate a string against multiple filters(regex).</p>

    <h2>Usage example</h2>
    <pre><code class="language-php">$spamFilter = new RegexFilter();
$spamFilter->addFilters([
    RegexFilter::FILTER_URL,
    RegexFilter::FILTER_HTML_TAGS
]);
$spamFilter->addExpressions(false, [
    "offer[a-z]*",
    "deal"
]);

$text = "<?= htmlspecialchars($text) ?>";

echo "< p>$text</ p>\n\n This text is ". ($spamFilter->match($text) ? "a spam" : "not a spam");
    </code></pre>

    <p>Result</p>
    <pre><code class="language-none"><?= "<p>". htmlspecialchars($text) ."</p>\n\nThis text is ". ($spamFilter->match($text) ? "a spam" : "not a spam"); ?></code></pre>
    
    <h2>Get Matches</h2>
    <pre><code class="language-php">print_r($spamFilter->getMatches($text);</code></pre>

    <p>Result</p>
    <pre><code class="language-php"><?= htmlspecialchars(print_r($spamFilter->getMatches($text), true)) ?></code></pre>
    
    <script src="vendor/prism.js"></script>
</body>
</html>