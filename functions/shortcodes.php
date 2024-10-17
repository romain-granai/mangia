<?php
    function overline_shortcode($atts, $content = null)
    {

        $return_string = '<p class="overline">'. $content .'</p>';

        return $return_string;
    };

    

    function button_shotcode($atts){

        // Attributes
        $atts = shortcode_atts(
            array(
                'url' => null,
                'label' => 'Ajouer un titre',
                'size' => null,
                'align' => 'center',
                'target' => '_self',
                'bg-shadow' => '#FFD12D'
            ),
            $atts
        );

        $url = $atts['url'];
        $label = $atts['label'];
        $sizeClass = $atts['size'] != null ? 'btn--big' : '';
        $align = 'cta--' . $atts['align'];
        $target = $atts['target'];
        $bgShadow = $atts['bg-shadow'];

        $return_string = '<div class="cta '. $align .'"><a href="'. $url .'" target="'. $target .'" class="btn '. $sizeClass .'" title="'. $label .'" style="--bg-shadow:'. $bgShadow .'"><span style="font-weight: 400">'. $label .'</span></a></div>';

        return $return_string;
    }

    add_shortcode('overline', 'overline_shortcode');
    add_shortcode('btn', 'button_shotcode');