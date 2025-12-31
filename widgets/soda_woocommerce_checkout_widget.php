<?php
namespace SodaAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class WooCommerce_Checkout extends Widget_Base {

    public function get_name() {
        return 'soda-woo-checkout';
    }

    public function get_title() {
        return esc_html__('WooCommerce Checkout (Shopify Style)', 'soda-elementor-addons');
    }

    public function get_icon() {
        return 'eicon-cart-light';
    }

    public function get_categories() {
        return ['soda-addons'];
    }

    public function get_keywords() {
        return ['checkout', 'woocommerce', 'shopify', 'cart', 'form'];
    }

    public function get_style_depends() {
        return ['soda-woo-checkout'];
    }

    public function get_script_depends() {
        return ['soda-woo-checkout'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'soda-elementor-addons'),
            ]
        );

        $this->add_control(
            'show_progress_steps',
            [
                'label'        => esc_html__('Show Progress Steps', 'soda-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'soda-elementor-addons'),
                'label_off'    => esc_html__('No', 'soda-elementor-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'step_label',
            [
                'label'       => esc_html__('Label', 'soda-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Contact information', 'soda-elementor-addons'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'step_state',
            [
                'label'   => esc_html__('State', 'soda-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'pending'  => esc_html__('Pending', 'soda-elementor-addons'),
                    'current'  => esc_html__('Current', 'soda-elementor-addons'),
                    'complete' => esc_html__('Complete', 'soda-elementor-addons'),
                ],
                'default' => 'current',
            ]
        );

        $this->add_control(
            'progress_steps',
            [
                'label'         => esc_html__('Steps', 'soda-elementor-addons'),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'default'       => [
                    [
                        'step_label' => esc_html__('Information', 'soda-elementor-addons'),
                        'step_state' => 'complete',
                    ],
                    [
                        'step_label' => esc_html__('Shipping', 'soda-elementor-addons'),
                        'step_state' => 'current',
                    ],
                    [
                        'step_label' => esc_html__('Payment', 'soda-elementor-addons'),
                        'step_state' => 'pending',
                    ],
                ],
                'title_field'   => '{{{ step_label }}}',
                'condition'     => [
                    'show_progress_steps' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'summary_heading',
            [
                'label'       => esc_html__('Summary Heading', 'soda-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Order summary', 'soda-elementor-addons'),
                'placeholder' => esc_html__('Order summary', 'soda-elementor-addons'),
            ]
        );

        $this->add_control(
            'enable_summary_toggle',
            [
                'label'        => esc_html__('Mobile Summary Toggle', 'soda-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Enable', 'soda-elementor-addons'),
                'label_off'    => esc_html__('Disable', 'soda-elementor-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'mobile_summary_label',
            [
                'label'       => esc_html__('Mobile Toggle Label', 'soda-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Show order summary', 'soda-elementor-addons'),
                'condition'   => [
                    'enable_summary_toggle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mobile_summary_label_hide',
            [
                'label'       => esc_html__('Mobile Toggle Label (Open)', 'soda-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Hide order summary', 'soda-elementor-addons'),
                'condition'   => [
                    'enable_summary_toggle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'assurance_heading',
            [
                'label'       => esc_html__('Assurance Heading', 'soda-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Why customers trust us', 'soda-elementor-addons'),
            ]
        );

        $this->add_control(
            'assurance_content',
            [
                'label'       => esc_html__('Assurance Content', 'soda-elementor-addons'),
                'type'        => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__('Add badges, security messaging or guarantees here.', 'soda-elementor-addons'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_colors',
            [
                'label' => esc_html__('Colors', 'soda-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'body_background_color',
            [
                'label'     => esc_html__('Canvas Background', 'soda-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f4f4f4',
                'selectors' => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-body-bg: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'panel_background_color',
            [
                'label'     => esc_html__('Form Panel Background', 'soda-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-panel-bg: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'summary_background_color',
            [
                'label'     => esc_html__('Summary Background', 'soda-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fafafa',
                'selectors' => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-summary-bg: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label'     => esc_html__('Accent Color', 'soda-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5c6ac4',
                'selectors' => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-accent: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'soda-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(18, 24, 40, 0.08)',
                'selectors' => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-border: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_muted_color',
            [
                'label'     => esc_html__('Muted Text', 'soda-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5c5f6a',
                'selectors' => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-muted: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_dimensions',
            [
                'label' => esc_html__('Spacing', 'soda-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'outer_padding',
            [
                'label'      => esc_html__('Outer Padding', 'soda-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '32',
                    'right'  => '32',
                    'bottom' => '32',
                    'left'   => '32',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .soda-woo-checkout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'      => esc_html__('Column Gap', 'soda-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 96,
                    ],
                ],
                'default'    => [
                    'size' => 32,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'panel_radius',
            [
                'label'      => esc_html__('Panel Radius', 'soda-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 48,
                    ],
                ],
                'default'    => [
                    'size' => 12,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'summary_sticky_offset',
            [
                'label'      => esc_html__('Sticky Offset', 'soda-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'size' => 32,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .soda-woo-checkout' => '--soda-woo-checkout-sticky-offset: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_typography',
            [
                'label' => esc_html__('Typography', 'soda-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'progress_typography',
                'label'    => esc_html__('Progress', 'soda-elementor-addons'),
                'selector' => '{{WRAPPER}} .soda-woo-checkout__progress-step-label',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'summary_heading_typography',
                'label'    => esc_html__('Summary Heading', 'soda-elementor-addons'),
                'selector' => '{{WRAPPER}} .soda-woo-checkout__summary-heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'assurance_heading_typography',
                'label'    => esc_html__('Assurance Heading', 'soda-elementor-addons'),
                'selector' => '{{WRAPPER}} .soda-woo-checkout__assurance-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'assurance_body_typography',
                'label'    => esc_html__('Assurance Body', 'soda-elementor-addons'),
                'selector' => '{{WRAPPER}} .soda-woo-checkout__assurance-content',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        if (!class_exists('WooCommerce')) {
            echo '<div class="soda-woo-checkout__notice">' . esc_html__('WooCommerce is required for this widget.', 'soda-elementor-addons') . '</div>';
            return;
        }

        if (!shortcode_exists('woocommerce_checkout')) {
            echo '<div class="soda-woo-checkout__notice">' . esc_html__('The WooCommerce checkout shortcode is not available.', 'soda-elementor-addons') . '</div>';
            return;
        }

        $settings = $this->get_settings_for_display();

        $enable_toggle = isset($settings['enable_summary_toggle']) && 'yes' === $settings['enable_summary_toggle'];
        $show_steps = isset($settings['show_progress_steps']) && 'yes' === $settings['show_progress_steps'];

        $wrapper_classes = ['soda-woo-checkout'];
        if ($enable_toggle) {
            $wrapper_classes[] = 'has-summary-toggle';
        } else {
            $wrapper_classes[] = 'is-summary-open';
        }

        $data_attrs = '';
        if (!empty($settings['summary_heading'])) {
            $data_attrs .= ' data-summary-heading="' . esc_attr($settings['summary_heading']) . '"';
        }

        if ($enable_toggle) {
            $show_label = !empty($settings['mobile_summary_label']) ? $settings['mobile_summary_label'] : esc_html__('Show order summary', 'soda-elementor-addons');
            $hide_label = !empty($settings['mobile_summary_label_hide']) ? $settings['mobile_summary_label_hide'] : esc_html__('Hide order summary', 'soda-elementor-addons');
            $data_attrs .= ' data-summary-toggle="1"';
            $data_attrs .= ' data-summary-toggle-show="' . esc_attr($show_label) . '"';
            $data_attrs .= ' data-summary-toggle-hide="' . esc_attr($hide_label) . '"';
        }

        $progress_markup = '';
        if ($show_steps && !empty($settings['progress_steps'])) {
            $progress_markup .= '<div class="soda-woo-checkout__progress">';
            foreach ($settings['progress_steps'] as $step) {
                $state = isset($step['step_state']) ? $step['step_state'] : 'pending';
                $label = isset($step['step_label']) ? $step['step_label'] : '';
                $step_classes = ['soda-woo-checkout__progress-step'];
                if ('current' === $state) {
                    $step_classes[] = 'is-current';
                } elseif ('complete' === $state) {
                    $step_classes[] = 'is-complete';
                }
                $progress_markup .= '<span class="' . esc_attr(implode(' ', $step_classes)) . '">';
                $progress_markup .= '<span class="soda-woo-checkout__progress-bullet" aria-hidden="true"></span>';
                if (!empty($label)) {
                    $progress_markup .= '<span class="soda-woo-checkout__progress-step-label">' . esc_html($label) . '</span>';
                }
                $progress_markup .= '</span>';
            }
            $progress_markup .= '</div>';
        }

        $assurance_markup = '';
        if (!empty($settings['assurance_content'])) {
            $assurance_markup .= '<div class="soda-woo-checkout__assurance">';
            if (!empty($settings['assurance_heading'])) {
                $assurance_markup .= '<h3 class="soda-woo-checkout__assurance-title">' . esc_html($settings['assurance_heading']) . '</h3>';
            }
            $assurance_markup .= '<div class="soda-woo-checkout__assurance-content">' . wp_kses_post($settings['assurance_content']) . '</div>';
            $assurance_markup .= '</div>';
        }

        echo '<div class="' . esc_attr(implode(' ', $wrapper_classes)) . '"' . $data_attrs . '>';
        echo $progress_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        if ($enable_toggle) {
            $show_label = !empty($settings['mobile_summary_label']) ? $settings['mobile_summary_label'] : esc_html__('Show order summary', 'soda-elementor-addons');
            echo '<button type="button" class="soda-woo-checkout__summary-toggle" aria-expanded="false">';
            echo '<span class="soda-woo-checkout__summary-toggle-label">' . esc_html($show_label) . '</span>';
            echo '<span class="soda-woo-checkout__summary-toggle-icon" aria-hidden="true"></span>';
            echo '</button>';
        }

        echo '<div class="soda-woo-checkout__container">';
        echo do_shortcode('[woocommerce_checkout]'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</div>';

        echo $assurance_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '</div>';
    }
}
