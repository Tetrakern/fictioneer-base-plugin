# Fictioneer Base Plugin

This is an example plugin for the [Fictioneer](https://github.com/Tetrakern/fictioneer) WordPress theme to work off. It works exactly as any other plugin, just with some ready-made functions to properly link it to the theme. Do not forget to change any names, prefixes, constants, and the text domain.

## Ready-Made Functions

### `fcnbp_make_plugin_meta_protected( $protected, $meta_key )`

Hooked into `is_protected_meta`, this function prevents meta fields from being changed in the editor. The interface is disabled in Fictioneer by default, but that does not mean a tech-savvy user cannot get around it. The function checks whether a meta key starts with a certain prefix (`fcnbp_` for the example) and protects it from such manipulation. Alternatively, you can start your meta keys with an underscore (e.g. `_my_meta_field`) to achieve the same without the need for this function.

### `fcnbp_check_theme()`

Hooked into `after_setup_theme`, this function checks whether Fictioneer or a child theme is active. If not, the plugin is deactivated to prevent errors.

### `fcnbp_admin_notice_wrong_theme()`

Displays an admin notice if the theme is forcefully deactivated by `fcnbp_check_theme()`.

### `fcnbp_settings_card()`

Hooked into `fictioneer_admin_settings_plugins`, this function adds a card to the Fictioneer settings plugins page. Any options and configurations should be done here, unless you add a completely new admin menu page. The look is mostly left to you.

### `fcnbp_enqueue_frontend_scripts()`

An example on how to add frontend styles and scripts for the plugin.

### `fcnbp_enqueue_admin_scripts()`

An example on how to add admin styles and scripts for the plugin.
