# PHP changes cheatsheet

## Build Requirements:

- PHP 7.4 or later with the DOM and mbstring extensions
- Pandoc on the build machine's `PATH` to convert the manual (including code examples and tables) to GitHub Flavored Markdown
- Enable the PHP cURL extension to download up to 8 migration pages at once with `php command Cache` or `php command All`. Without cURL, the pages download sequentially.

## Installation:

- Clone this repo: `git clone https://github.com/eusonlito/php-changes-reference.git`
- Generate all files with: `php command All`
- Or, execute step by step:
- Create cache: `php command Cache`
- Create HTML chunks: `php command Chunk`
- Create HTML and Markdown pages: `php command Html`
- Create Assets: `php command Asset`
- Open file `html/index.html`

## Markdown for agents

Agents can discover each page’s Markdown file through `<link rel="alternate" type="text/markdown">` in the HTML head. Start at `index.md` to browse by topic or fetch `all.md` for the complete reference. Both paths are relative to the site's base URL.

GitHub Pages serves the two representations at separate URLs. Fetch `features.md` directly for the Markdown version of `features.html`. The generated `.nojekyll` file keeps the Markdown files from being processed by Jekyll. Pages controls the HTTP response headers and selects the MIME type by file extension. [GitHub Pages MIME types](https://docs.github.com/en/pages/getting-started-with-github-pages/creating-a-github-pages-site#mime-types-on-github-pages)

On a configurable host, serve UTF-8 Markdown with `Content-Type: text/markdown; charset=utf-8`. HTML responses can also advertise a sibling file with an HTTP header such as `Link: <features.md>; rel="alternate"; type="text/markdown"`. If the server supports returning either format at the **same URL** according to the request's `Accept` header, send `Vary: Accept` on both responses so caches distinguish them. [Markdown media type](https://www.rfc-editor.org/rfc/rfc7763) · [HTTP content negotiation](https://www.rfc-editor.org/rfc/rfc9110#section-12.5.5)
