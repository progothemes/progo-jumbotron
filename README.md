# ProGo Jumbotron
### Inserts a "Jumbotron" full width content area in the ProGo Base masthead header area of the home page.

The Jumbotron is designed to promote 1 idea and only 1 idea, at the tip top of a Page, so it is the first thing that catches a visitor's attention. Keep it simple. Sliders are bad.
Jumbotron post Content will be used as is in whatever theme you have, so if you are using something nice and Bootstrap-supporting like ProGo Base, you may want to start with an idea like

```
<div class="row">
<div class="col-sm-6"><img src="https://placekitten.com/480/320" alt="placekitten"></div>
<div class="col-sm-6">
<h1>ProGo Base is Here</h1>
Check it out, man
<a href="#" class="btn btn-default">GitHub</a>
</div>
</div>
```

Jumbotron Blocks use the Featured Image area as a Background image on display, which is set to background-position 50% 50% and background-size cover, so you may want to use an appropriately-sized image, something like `https://placekitten.com/g/1920/480`

## Screenshots

Example ProGo Jumbotron homepage display

![Example ProGo Jumbotron homepage display](https://raw.github.com/progothemes/progo-jumbotron/master/screenshot-1.jpg)

Example ProGo Jumbotron Edit Post

![Example ProGo Jumbotron Edit Post](https://raw.github.com/progothemes/progo-jumbotron/master/screenshot-2.jpg)

## Installation

Download the ProGo Jumbotron plugin, upload it to your WordPress site, Activate it, and create a Jumbotron.

## Frequently Asked Questions

### Does the Jumbotron work with other themes besides ProGo Base?

At this time, the answer is, maybe, with some assembly required? Currently at this v0.1 the only way the Jumbotron outputs (without you adding custom PHP to your active Theme) is by

`add_action( 'pgb_block_header', 'progo_jumbotron_display' );`

### Custom PHP, you say?

Yes, I suppose you could just..

`<?php progo_jumbotron_display(); ?>`

.. but only on the front page. Otherwise it won't do anything, at least not right now. Unless...

### Can the Jumbotron appear on another page other than the front page?

At this time, the answer is ~~also No. But maybe in a future version...~~ now Yes, with custom coding! See comments in progo-jumbotron.php for more.

    function progo_jumbotron_check() {
      $show = is_front_page();
      return apply_filters( 'progo_jumbotron_check', $show );
    }

### Can I have more than 1 Jumbotron with a a slideshow through multiple ones on a single Page?

At this time, the answer is No. The Jumbotron is designed to promote 1 idea and only 1 idea, at the tip top of a Page, so it is the first thing that catches a visitor's attention. Keep it simple. Sliders are bad.

### PlaceKittens?

[PlaceKittens](http://placekitten.com/).

## Changelog

### 0.1.1
*Release Date  - 24th July, 2015*

* Maintenance release
* mainly cleaning up README(s) and plugin Description and comments.
* and also adding a filter so that perhaps a Jumbotron could appear on some other page if someone with php inclinations so desired

### 0.1
*Release Date  - 22nd May, 2015*

* Initial Release high fives. Some assembly may be required.
