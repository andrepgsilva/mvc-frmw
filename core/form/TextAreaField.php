<?php


namespace App\Core\Form;

/**
 * Class TextAreaField
 *
 * @package App\Core\Form
 */
class TextAreaField extends BaseField
{

    /**
     * @return string
     */
    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" class="form-control%s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute ? ' is-invalid': ''),
            $this->model->{$this->attribute},
        );
    }
}
