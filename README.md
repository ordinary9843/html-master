# Html Master

[![build](https://github.com/ordinary9843/html-master/actions/workflows/build.yml/badge.svg)](https://github.com/ordinary9843/html-master/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/ordinary9843/html-master/branch/master/graph/badge.svg?token=QKCE7LJISZ)](https://codecov.io/gh/ordinary9843/html-master)

### Intro

Analyzing and crawling the html structure of a static/dynamic website.

## Requirements

This library has the following requirements:

- PHP 7.1+
- NodeJs 12+
- Browser (default browser is `/use/bin/chromium`)

## Installation

Requires:

```bash
apt-get install nodejs
apt-get install chromium # or `chromium-browser`
```

Require the package via composer:

```bash
composer require ordinary9843/html-master
```

## Usage

Example usage:

```php
<?php
require './vendor/autoload.php';

use Ordinary9843\HtmlMaster;

$htmlMaster = new HtmlMaster();

// For the first time use of this package, it is recommended to enable the debug mode.
$htmlMaster->setDebug(true);

// Set the browser path for dynamic mode.
$htmlMaster->setExecutablePath('/usr/bin/chromium');

/**
 * Set the connection time (in seconds) for dynamic mode.
 *
 * If you are unable to obtain the dynamic (SPA) HTML.
 * You can try extending the wait time in seconds to wait for the website JavaScript elements to finish rendering.
 */
$htmlMaster->setWaitSeconds(5);

// Set the connection time (in seconds) for static mode.
$htmlMaster->setConnectTimeout(5);
$htmlMaster->setTimeout(5);

/**
 * The decision to execute the crawler in static or dynamic mode depends on whether your browser path is correctly set.
 * Please use `setExecutablePath()` to set the browser path.
 *
 * Output: [
 *  'title' => '',
 *  'description' => '',
 *  'meta' => [
 *    'keywords' => '',
 *    'description' => '',
 *    'viewport' => '',
 *    'author' => '',
 *    'copyright' => '',
 *    'robots' => '',
 *    'og' => [],
 *    'twitter' => []
 *  ],
 *  'icons' => [],
 *  'images' => [],
 *  'css' => [],
 *  'js' => []
 * ]
 */
$htmlMaster->parse('https://github.com/ordinary9843');

/**
 * Get all messages.
 *
 * Output: [
 *  '[INFO] Message.',
 *  '[ERROR] Message.'
 * ]
 */
$htmlMaster->getMessages();
```

## Testing

```bash
composer test
```

## Licenses

(The [MIT](http://www.opensource.org/licenses/mit-license.php) License)
