# HtmlMaster

[![build](https://github.com/ordinary9843/html-master/actions/workflows/build.yml/badge.svg)](https://github.com/ordinary9843/html-master/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/ordinary9843/html-master/branch/master/graph/badge.svg?token=QKCE7LJISZ)](https://codecov.io/gh/ordinary9843/html-master)

### Intro

Analyzing and crawling the html structure of a static/dynamic website.

## Requirements

This library has the following requirements:

- PHP 7.1+
- NodeJs v12+
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
 * Get error message.
 *
 * Output: [
 *  '[INFO] Message ...',
 *  '[ERROR] Message ...',
 * ]
 */
$htmlMaster->getError();
```

## Testing

```bash
composer test
```

## Licenses

(The [MIT](http://www.opensource.org/licenses/mit-license.php) License)

Copyright &copy; [Jerry Chen](https://ordinary9843.medium.com/)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE
