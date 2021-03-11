<?php

/**
 * @file
 * TiniT theme file.
 * 
 * Demo description with code and link
 *  '#description' => t('Demo code <code>.theme-colors</code> and link @demo_link.', [
 *    '@demo_link' => Link::fromTextAndUrl('Containers',
 *                    Url::fromUri('https://getbootstrap.com/docs/5.0/layout/containers/', [
 *                      'absolute' => TRUE,
 *                      'fragment' => 'containers'
 *                     ]))->toString(),
 *  ]),
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function tinit_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {
  if (isset($form_id)) {
    return;
  }

  $options_theme = [
    'none' => 'do not apply theme',
    'light' => 'light (dark text/links against a light background)',
    'dark' => 'dark (light/white text/links against a dark background)',
  ];

  $options_colour = [
    'default' => 'Use default color',
    'primary' => 'primary',
    'secondary' => 'secondary',
    'light' => 'light',
    'dark' => 'dark',
  ];

  $options_container = [
    'container' => 'Fixed',
    'container-fluid' => 'Fluid',
  ];

  $form['tinit'] = [
    '#type' => 'vertical_tabs',
    '#title' => t('TiniT settings'),
    // '#prefix' => '<div class="h2">' . t('Some text before title') . '</div>',
    '#weight' => -10,
  ];

    // Theme settings
    $form['settings'] = array(
      '#type'         => 'details',
      '#title'        => t('Main Settings'),
      //'#description'  => t('some description'),
      '#group' => 'tinit',
      '#weight' => 1,
    );

      $form['settings']['global'] = [
        '#type' => 'details',
        '#title' => t('Global settings'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
      ];

        $form['settings']['global']['ts--container'] = [
          '#type' => 'select',
          '#title' => t('Container type'),
          '#default_value' => theme_get_setting('ts--container'),
          '#description' => t('More details @demo_link.', [
            '@demo_link' => Link::fromTextAndUrl('Containers',
                            Url::fromUri('https://getbootstrap.com/docs/5.0/layout/containers/', [
                              'absolute' => TRUE,
                            ]))->toString(),
          ]),
          '#options' => $options_container,
        ];

    // Navbar settings
    $form['navbar'] = array(
      '#type'         => 'details',
      '#title'        => t('Nav Bar'),
      '#group' => 'tinit',
      '#weight' => 4,
    );

      $form['navbar']['settings'] = [
        '#type' => 'details',
        '#title' => t('General settings'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
      ];

        $form['navbar']['settings']['tt--navbar-type'] = [
          '#type' => 'select',
          '#title' => t('Select header type'),
          '#default_value' => theme_get_setting('tt--navbar-type'),
          '#description' => t('some regions can\'t be used independently of the chosen header.'),
          '#options' => [
            'default' => 'Default',
            'floating' => 'Floating',
            'topbar' => 'Topbar',
          ],
        ];

        $form['navbar']['settings']['tt--navbar-position'] = [
          '#type' => 'select',
          '#title' => t('Select header type'),
          '#default_value' => theme_get_setting('tt--navbar-position'),
          '#description' => t('Header position'),
          '#options' => [
            '0' => 'Default',
            'sticky-top' => 'Sticky top',
            'fixed-top' => 'Fixed top',
            'fixed-bottom' => 'Fixed bottom',
          ],
        ];

        $form['navbar']['settings']['tt--navbar-expand'] = [
          '#type' => 'select',
          '#title' => t('Expand breakpoint'),
          '#default_value' => theme_get_setting('tt--navbar-expand'),
          '#description' => t('Select breakpoint.'),
          '#options' => [
            'navbar-expand-sm' => 'Expand Extra small screen',
            'navbar-expand-sm' => 'Expand Small screen',
            'navbar-expand-md' => 'Expand Medium screen',
            'navbar-expand-lg' => 'Expand Large screen',
            'navbar-expand-xl' => 'Expand Extra large screen',
            'navbar-expand-xxl' => 'Expand Extra extra large screen',
          ],
        ];

        $form['navbar']['settings']['tt--navbar-align'] = [
          '#type' => 'select',
          '#title' => t('Expand breakpoint'),
          '#default_value' => theme_get_setting('tt--navbar-align'),
          '#description' => t(''),
          '#options' => [
            'me-auto' => 'Align left',
            'mx-auto' => 'Align center',
            'ms-auto' => 'Align right'
          ],
        ];

        $form['navbar']['settings']['tt--navbar-color'] = [
          '#type' => 'select',
          '#title' => t('Text color'),
          '#default_value' => theme_get_setting('tt--navbar-color'),
          '#description' => t(''),
          '#options' => [
            'navbar-light' => 'Color dark',
            'navbar-dark' => 'Color light'
          ],
        ];

        $form['navbar']['settings']['tt--navbar-bg'] = [
          '#type' => 'select',
          '#title' => t('Background color'),
          '#default_value' => theme_get_setting('tt--navbar-bg'),
          '#description' => t(''),
          '#options' => [
            '0' => 'None',
            'bg-white' => 'Background White',
            'bg-primary' => 'Background Primary',
            'bg-dark' => 'Background Dark',
          ],
        ];

        $form['navbar']['settings']['tt--navbar-out'] = [
          '#type' => 'select',
          '#title' => t('Delimiter'),
          '#default_value' => theme_get_setting('tt--navbar-out'),
          '#description' => t(''),
          '#options' => [
            '0' => 'None',
            'shadow-sm' => 'Small shadow',
            'shadow' => 'Regular shadow',
            'shadow-lg' => 'Larger shadow',
            'border-bottom' => 'Border bottom',
          ],
        ];

    $form['form'] = array(
      '#type'         => 'details',
      '#title'        => t('Form Settings'),
      '#group' => 'tinit',
      '#weight' => 1,
    );

      $form['form']['settings'] = [
        '#type' => 'details',
        '#title' => t('Form settings'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
      ];

        $form['form']['settings']['tt--form-input-group'] = [
          '#type' => 'textarea',
          '#title' => t('Form input group list'),
          '#default_value' => theme_get_setting('tt--form-input-group'),
          '#description'  => t('Add form id in line'),
        ];

  $form['body_details'] = [
    '#type' => 'details',
    '#title' => t('Body options'),
    '#description' => t("Combination of theme/background colour may affect background colour/text colour contrast. To fix any contrast issues, override corresponding variables in scss(refer to dist/boostrap/scss/_variables.scss)"),
    '#open' => TRUE,
  ];

  $form['body_details']['ttvar_top_container'] = [
    '#type' => 'select',
    '#title' => t('Website container type'),
    '#default_value' => theme_get_setting('ttvar_top_container'),
    '#description' => t("Type of top level container: fluid (eg edge to edge) or fixed width"),
    '#options' => $options_container,
  ];

  $form['body_details']['ttvar_body_schema'] = [
    '#type' => 'select',
    '#title' => t('Body theme:'),
    '#default_value' => theme_get_setting('ttvar_body_schema'),
    '#description' => t("Text colour theme of the body."),
    '#options' => $options_theme,
  ];

  $form['body_details']['ttvar_body_bg_schema'] = [
    '#type' => 'select',
    '#title' => t('Body background:'),
    '#default_value' => theme_get_setting('ttvar_body_bg_schema'),
    '#description' => t("Background color of the body."),
    '#options' => $options_colour,
  ];

  $form['nav_details'] = [
    '#type' => 'details',
    '#title' => t('Navbar options'),
    '#description' => t("Combination of theme/background colour may affect background colour/text colour contrast. To fix any contrast issues, override \$navbar-light-*/\$navbar-dark-* variables (refer to dist/boostrap/scss/_variables.scss)"),
    '#open' => TRUE,
  ];

  $form['footer_details'] = [
    '#type' => 'details',
    '#title' => t('Footer options'),
    '#description' => t("Combination of theme/background colour may affect background colour/text colour contrast. To fix any contrast issues, override corresponding variables in scss (refer to dist/boostrap/scss/_variables.scss)"),
    '#open' => TRUE,
  ];

  $form['footer_details']['ttvar_footer_schema'] = [
    '#type' => 'select',
    '#title' => t('Footer theme:'),
    '#default_value' => theme_get_setting('ttvar_footer_schema'),
    '#description' => t("Text colour theme of the footer."),
    '#options' => $options_theme,
  ];

  $form['footer_details']['ttvar_footer_bg_schema'] = [
    '#type' => 'select',
    '#title' => t('Footer background:'),
    '#default_value' => theme_get_setting('ttvar_footer_bg_schema'),
    '#description' => t("Background color of the footer."),
    '#options' => $options_colour,
  ];
}
