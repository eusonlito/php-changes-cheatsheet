# PHP changes cheatsheet

## Build Requirements:

- PHP 7.4 or later with the DOM and mbstring extensions
- Enable the PHP cURL extension to download up to 8 migration pages at once with `php command Cache` or `php command All`. Without cURL, the pages download sequentially.

## Installation:

- Clone this repo: `git clone https://github.com/eusonlito/php-changes-reference.git`
- Generate all files with: `php command All`
- Or, execute step by step:
- Create cache: `php command Cache`
- Create HTML chunks: `php command Chunk`
- Create HTML files: `php command Html`
- Create Assets: `php command Asset`
- Open file `html/index.html`
