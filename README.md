# HTML Minify
HTML Minify is a plugin for WordPress that compresses the HTML output to reduce file size and improve performance. It's forked from a [script by DVS](http://www.intert3chmedia.net/2011/12/minify-html-javascript-css-without.html).

[Download HTML Minify](https://github.com/cferdinandi/html-minify/archive/master.zip)



## Getting Started

Getting started with HTML Minify is as simple as installing a plugin:

1. Upload the `html-minify` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the Plugins menu in WordPress.

And that's it, you're done. Nice work! You change what gets minified under "Settings" in the Admin Dashboard.

It's recommended that you also install the [GitHub Updater plugin](https://github.com/afragen/github-updater) to get automattic updates.



## Known Issues

It's been reported that [data URIs](https://developer.mozilla.org/en-US/docs/Web/HTTP/data_URIs) may [break the minifier](https://github.com/cferdinandi/html-minify/issues/2). This has not been consistently duplicated, nor is their a fix available, but is something to be aware of.



## How to Contribute

Please read the [Contribution Guidelines](CONTRIBUTING.md).



## License

The code is available under the [MIT License](LICENSE.md).