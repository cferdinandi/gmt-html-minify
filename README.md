# HTML Minify
HTML Minify is a plugin for WordPress that compresses the HTML output to reduce file size and improve performance. It's forked from a [script by DVS](http://www.intert3chmedia.net/2011/12/minify-html-javascript-css-without.html).

[Download HTML Minify](https://github.com/cferdinandi/html-minify/archive/master.zip)

**In This Documentation**

1. [Getting Started](#getting-started)
2. [How to Contribute](#how-to-contribute)
3. [Known Issues](#known-issues)
4. [License](#license)



## Getting Started

Getting started with HTML Minify is as simple as installing a plugin:

1. Upload the `html-minify` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the Plugins menu in WordPress.

And that's it, you're done. Nice work! You change what gets minified under "Settings" in the Admin Dashboard.

*Inline JavaScript sometimes breaks when minified, so you may wish to exclude it from minification.*



## How to Contribute

In lieu of a formal style guide, take care to maintain the existing coding style. Don't forget to update the version number, the changelog (in the `readme.md` file), and when applicable, the documentation.



## Known Issues

It's been reported that [data URIs](https://developer.mozilla.org/en-US/docs/Web/HTTP/data_URIs) may [break the minifier](https://github.com/cferdinandi/html-minify/issues/2). This has not been consistently duplicated, nor is their a fix available, but is something to be aware of.



## License

HTML Minify is licensed under the [MIT License](http://gomakethings.com/mit/).