# Bootstrap 5 theme

## INTRODUCTION

This is a very non-prescriptive vanilla Bootstrap 4 theme 
with simple configuration. It can be used out of the box or 
as a subtheme for creating very flexible web designs with 
minimal changes (just override Bootstrap 4 variables.scss 
and recompile css!)

## FEATURES

* Bootstrap 5 library (5.0 beta 1) included
* Bootstrap 5 style guide (view all Bootstrap 5 components on one page)
* Bootstrap 5 breakpoints
* Bootstrap 5 integration with CKEditor
* Bootstrap 5 configuration within admin user interface
* Interface for creating subtheme
* Can be used as is (subtheme is required for template overrides)
* Drupal 8 and 9 compatible

## SASS compilation:

* SASS compilation is no longer in the theme.

## REQUIREMENTS

### Installation: composer
INSTALLATION

`composer require drupal/tinit`

Head to `Appearance` and install tinit theme.

## CONFIGURATION

Head to `Appearance` and clicking tinit `settings`.

### Subtheme

* If you require subtheme (usually if you want to override templates), 
    see [subtheme docs](_SUBTHEME/README.md).

## Development and patching

- Install development dependencies by running `npm install`
- To lint SASS files run `npm run lint:sass` (it will fail build if lint fails)
- To lint JS files run `npm run lint:js` (it will fail build if lint fails)
- To compile SASS (for Bootstrap 4.5.3) run `sass scss/style.scss css/style.css` (requires [SASS compiler](https://sass-lang.com/install))
- To compile JS: run `npm run build:js`
- optional: create symlink from tinit repo folder to a local Drupal installation to simplify development `ln -s /path/to/tinit /path/to/local-drupal-site/web/themes/contrib`

## FAQ

### FAQ - Menu subnesting

Nesting is considered bad practice in Bootstrap 5. It is bad for UX, mobile 
usage and accessibility.

Hence, there are no examples in the [current documentation](https://getbootstrap.com/docs/5.0/components/dropdowns/#menu-items).

Read more: 

* https://github.com/twbs/bootstrap/issues/27659
* https://github.com/twbs/bootstrap/issues/16387#issuecomment-97153831

Theme developers need to implement their own solution if they are catering 
for multi level menus.

To get started copy `templates/navigation/menu--main.html.twig` to your 
subtheme and modify as follows:

```
{% import _self as menus %}

{#
We call a macro which calls itself to render the full tree.
@see http://twig.sensiolabs.org/doc/tags/macro.html
#}
{{ menus.build_menu(items, attributes, 0) }}

{% macro build_menu(items, attributes, menu_level) %}
  {% import _self as menus %}
  {% if items %}
    {% if menu_level == 0 %}
    <ul{{ attributes.addClass('navbar-nav mr-auto') }}>
    {% else %}
    <ul class="dropdown-menu">
    {% endif %}
    {% for item in items %}
      {{ menus.add_link(item, attributes, menu_level) }}
    {% endfor %}
    </ul>
  {% endif %}
{% endmacro %}

{% macro add_link(item, attributes, menu_level) %}
  {% import _self as menus %}
  {%
    set list_item_classes = [
      'nav-item',
      item.is_expanded ? 'dropdown',
      item.is_expanded and (menu_level > 0) ? 'dropdown-submenu',
    ]
  %}
  {%
    set link_class = [
      'nav-item',
      'nav-link',
      item.in_active_trail ? 'active',
      menu_level == 0 and (item.is_expanded or item.is_collapsed) ? 'dropdown-toggle',
    ]
  %}
  {%
    set toggle_class = [
    ]
  %}
  <li{{ item.attributes.addClass(list_item_classes) }}>
    {% if menu_level == 0 %}
      {{ link(item.title, item.url, { 'class': link_class, 'data-toggle' : 'dropdown', 'title': ('Expand menu' | t) ~ ' ' ~ item.title }) }}
    {% else %}
      {{ link(item.title, item.url, { 'class': link_class }) }}
    {% endif %}
    {% if item.below %}
      {{ menus.build_menu(item.below, attributes, menu_level + 1) }}
    {% endif %}
  </li>
{% endmacro %}
```
