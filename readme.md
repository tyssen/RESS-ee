# RESS ExpressionEngine Add-on

RESS (Responsive Design + Server Side Components) add-on for ExpressionEngine to detect screen resolution via javascript and then set a variable which you can then access in your templates. Useful for creating Responsive layouts that adapt to users’ screen size and can also conditionally show or hide content.

## Changelog

1.0.0
Initial public release

1.0.1 - 11 Jan 2012
In the plugin, changed (window).width() which requires jQuery to Math.max(screen.width,screen.height) because it was reporting an incorrect size on iOS.

## Credit

This is an ExpressionEngine implementation of [Simple-RESS](https://github.com/jiolasa/Simple-RESS) by Matt Stauffer.