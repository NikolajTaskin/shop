<?php

namespace Core\Views;

use Core\View;

class Form extends View
{

    public function render($template_path = ROOT . '/core/templates/form.tpl.php')
    {
        return parent::render($template_path); // TODO: Change the autogenerated stub
    }


    /**
     * Get form inputs and filter them (e.g. sanitize special characters).
     *
     */
    public function values(): ?array
    {
        $parameters = [];

        foreach ($this->data['fields'] as $index => $input) {
            $parameters[$index] = FILTER_SANITIZE_SPECIAL_CHARS;
        }

        return filter_input_array(INPUT_POST, $parameters);
    }


    public function isSubmitted(): bool
    {
        return (bool)$this->values();
    }


    public function fill($values)
    {

    }

    /**
     * Helper function to run validation functions of forms and fields
     *
     */
    public function validate(): bool
    {

        if (!$this->isSubmitted()){
            return false;
        }
        $is_valid = true;
        $form_values = $this->values();

        foreach ($this->data['fields'] as $field_index => &$field) {
            foreach ($field['validators'] ?? [] as $validator_index => $validator) {
                if (is_array($validator)) {
                    $field_is_valid = $validator_index($form_values[$field_index], $field, $params = $validator);
                } else {
                    $field_is_valid = $validator($form_values[$field_index], $field);
                }
                if (!$field_is_valid) {
                    $is_valid = false;
                    break;
                }
            }
        }

        if (isset($this->data['validators'])) {
            foreach ($this->data['validators'] as $validator_index => $validator) {
                if (is_array($validator)) {
                    $field_is_valid = $validator_index($form_values, $this->data, $params = $validator);
                } else {
                    $field_is_valid = $validator($form_values, $this->data);
                }

                if (!$field_is_valid) {
                    $is_valid = false;
                    break;
                }
            }
        }

        return $is_valid;
    }


}