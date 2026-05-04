<?php

declare(strict_types=1);

$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$uriPath = is_string($uriPath) ? $uriPath : '/';
if ($uriPath === '') {
    $uriPath = '/';
}

$isHomePage = ($uriPath === '/');
$mainPt = $isHomePage ? 'pt-0' : 'pt-8';

?>
<main class="<?= htmlspecialchars($mainPt, ENT_QUOTES, 'UTF-8') ?> mx-auto max-w-jobscape px-6 pb-14 sm:px-8" aria-label="Main content">
