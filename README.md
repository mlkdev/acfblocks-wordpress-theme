# ACF Blocks Theme

This demo theme is made available to the public for demonstration purposes, and has been stripped down to two basic Gutenberg block components; a Section block which can be configured with various visual elements, and Basic Card blocks that can contain content and have basic visual configuration options which can be inserted into Section blocks.

In order for the theme to work, ACF Pro must be included in the `/includes/acf/` directory. ACF Pro is _**NOT**_ included in this repository as per the ACF Pro rules which can be found [here](https://www.advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme/).

Field registrations are also made available in each `/includes/blocks/%name%/fields.x.php` file. These can either be imported or the `.x ` portion of the filename can be removed to have the `function.php` autoload the definition at runtime.

---

## Live Demo

A live demo of these blocks in action can be viewed at the following address:
[https://acfblocks-theme.mlk.dev/](https://acfblocks-theme.mlk.dev/)
