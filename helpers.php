<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
  return __DIR__ . '/' . $path;
}

/**
 * Load a view
 * 
 * @param string $name
 * @return void
 * 
 */
function loadView($name, $data = [])
{
  $viewPath = basePath("App/views/{$name}.view.php");

  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
  } else {
    echo "View '{$name} not found!'";
  }
}


/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 * 
 */
function loadPartial($name, $data = [])
{
  $partialPath = basePath("App/views/partials/{$name}.php");

  if (file_exists($partialPath)) {
    extract($data);
    require $partialPath;
  } else {
    echo "Partial '{$name} not found!'";
  }
}

/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
}

/**
 * Inspect a value(s) and die
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
  echo '<pre>';
  die(var_dump($value));
  echo '</pre>';
}

/**
 * Format salary
 * 
 * @param string $salary
 * @return string Formatted Salary
 */
function formatSalary($salary)
{
  $s = trim((string) $salary);
  if ($s === '') {
    return '';
  }
  // Plain annual number from typical form entry
  if (preg_match('/^\d+(?:\.\d{1,2})?$/', $s)) {
    return '$' . number_format((float) $s, 0, '.', ',');
  }
  // Ranges, hourly, prefixed currency, notes — display as supplied
  return $s;
}

/**
 * Split a listing tags string (comma-separated) into trimmed labels.
 *
 * @param string|null $tags
 * @return list<string>
 */
function listingTagParts($tags)
{
  if ($tags === null) {
    return [];
  }
  $raw = trim((string) $tags);
  if ($raw === '') {
    return [];
  }
  $parts = preg_split('/\s*,\s*/', $raw, -1, PREG_SPLIT_NO_EMPTY);
  $out = [];
  foreach ($parts as $part) {
    $t = trim($part);
    if ($t !== '') {
      $out[] = $t;
    }
  }
  return $out;
}

/**
 * Sanitize Data
 * 
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given url
 * 
 * @param string $url
 * @return void
 */
function redirect($url)
{
  header("Location: {$url}");
  exit;
}
