<?php

if (!function_exists('chained_dropdown')) {

    /**
     * Chained Drop-down Menu
     *
     * @param mixed $data
     * @param mixed $options
     * @param mixed $selected
     * @param mixed $extra
     *
     * @return string
     */
    function chained_dropdown($data = '', $options = [], $selected = [], $extra = ''): string {
        $defaults = [];
        if (is_array($data)) {
            if (isset($data['selected'])) {
                $selected = $data['selected'];
                unset($data['selected']); // select tags don't have a selected attribute
            }
            if (isset($data['options'])) {
                $options = $data['options'];
                unset($data['options']); // select tags don't use an options attribute
            }
        } else {
            $defaults = ['name' => $data];
        }

        if (!is_array($selected)) {
            $selected = [$selected];
        }
        if (!is_array($options)) {
            $options = [$options];
        }

        // If no selected state was submitted we will attempt to set it automatically
        if (empty($selected)) {
            if (is_array($data)) {
                if (isset($data['name'], $_POST[$data['name']])) {
                    $selected = [$_POST[$data['name']]];
                }
            } elseif (isset($_POST[$data])) {
                $selected = [$_POST[$data]];
            }
        }

        // standardize selected as strings, like  the option keys will be.
        foreach ($selected as $key => $item) {
            $selected[$key] = (string) $item;
        }

        $extra = stringify_attributes($extra);
        $multiple = (count($selected) > 1 && stripos($extra, 'multiple') === false) ? ' multiple="multiple"' : '';
        $form = '<select ' . rtrim(parse_form_attributes($data, $defaults)) . $extra . $multiple . ">\n";
        foreach ($options as $key => $val) {
            $key = (string) $key;
            if (is_array($val)) {
                if (empty($val)) {
                    continue;
                }
                if (isset($val['chained']) && isset($val['name'])) {
                    $form .= '<option value="' . htmlspecialchars($key) . '" '
                            . 'data-chained="' . htmlspecialchars($val['chained']) . '"'
                            . (in_array($key, $selected, true) ? ' selected="selected"' : '') . '>'
                            . $val['name'] . "</option>\n";
                }
            } else {
                $form .= '<option value="' . htmlspecialchars($key) . '"'
                        . (in_array($key, $selected, true) ? ' selected="selected"' : '') . '>'
                        . $val . "</option>\n";
            }
        }

        return $form . "</select>\n";
    }

}
