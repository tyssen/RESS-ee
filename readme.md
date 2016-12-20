# RESS ExpressionEngine Add-on

RESS (Responsive Design + Server Side Components) add-on for ExpressionEngine to detect screen resolution via javascript and then set a variable which you can then access in your templates. Useful for creating Responsive layouts that adapt to users’ screen size and can also conditionally show or hide content.

## Changelog

### 1.0.6 – 20 Dec 2016
--------------------
Updated for EE3

### 1.0.5 – 23 Aug 2014
--------------------
Replaced window.outerWidth with Verge viewportW (https://github.com/ryanve/verge#viewportw) for more accurate viewport width reporting

### 1.0.4 – 21 Sep 2012
--------------------
Added a check to see if cookies are enabled before doing location.reload(true);

### 1.0.3 – 19 Apr 2012
--------------------
Added conditional to check if window.outerWidth is supported as it was [reported](http://www.johnfaulds.com.au/journal/responsive-layouts-with-expressionengine/#comment-420834555) that the cookie had a value of 'undefined' in IE.

### 1.0.2 – 11 Jan 2012
--------------------
Changed Math.max(screen.width,screen.height) to window.outerWidth to measure width width instead of screen width again. Reasons why jQuery's (window).width() and window.innerWidth weren't working on iOS explained in [First, Understand Your Screen](http://tripleodeon.com/2011/12/first-understand-your-screen/)

### 1.0.1 – 11 Jan 2012
--------------------
In the plugin, changed (window).width() which requires jQuery to Math.max(screen.width,screen.height) because it was reporting an incorrect size on iOS.

### 1.0.0
--------------------
Initial public release

## Credit

This is an ExpressionEngine implementation of [Simple-RESS](https://github.com/jiolasa/Simple-RESS) by Matt Stauffer.