---
layout: default
title: Intro
nav_order: 0
---

# Gutenberg Blocks Framework 🧱
{: .fs-9 }

Library to load custom Gutenberg blocks in a WordPress plugin or theme.
{: .fs-6 .fw-300 }

[Get started now](installation.html){: .btn .btn-primary .fs-5 .mb-4 .mb-md-0 .mr-2 } [View it on GitHub](https://github.com/spenserhale/gutenberg-blocks-framework){:target="_blank"}{: .btn .fs-5 .mb-4 .mb-md-0 }

---

Since this library is solely taking care of registering and setting up blocks on the server side it is built to work with the following packages:  

* [SH/gutenberg-blocks-components](https://github.com/spenserhale/gutenberg-blocks-components)
* [spenserhale/create-block](https://github.com/spenserhale/create-block)

Example projects:
* [https://github.com/spenserhale/SH-gutenberg-blocks](https://github.com/spenserhale/SH-gutenberg-blocks) (as a seperate plugin)
* ~~[https://github.com/spenserhale/SH-gutenberg-theme](https://github.com/spenserhale/SH-gutenberg-blocks-theme) (as part of a theme)~~ <small style="opacity:.5;">(coming soon)</small>

## Features

* customizable whitelist of selected core blocks
* enhance output of core blocks
* optimized for performance (critical CSS)
* all blocks are [dynamic](https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/creating-dynamic-blocks/) (pure PHP or Twig views)
* easy integration of i18n
* view utility functions
* supports BEM methodology

Read more: [Installation](/installation.html)