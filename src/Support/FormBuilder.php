<?php

namespace Mhriad\Form\Support;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\HtmlString;

class FormBuilder
{
    public function open($options = [])
    {
        $method = strtoupper($options['method'] ?? 'POST');
        $action = $options['url'] ?? ($options['route'] ?? url()->current());
        $enctype = isset($options['files']) && $options['files'] ? 'multipart/form-data' : 'application/x-www-form-urlencoded';

        $html = '<form method="'.($method === 'GET' ? 'GET' : 'POST').'" action="'.$action.'" enctype="'.$enctype.'"';

        if (isset($options['class'])) {
            $html .= ' class="'.$options['class'].'"';
        }
        if (isset($options['id'])) {
            $html .= ' id="'.$options['id'].'"';
        }

        $html .= '>';

        if ($method !== 'GET' && $method !== 'POST') {
            $html .= method_field($method);
        }

        $html .= csrf_field();

        return new HtmlString($html);
    }

    public function close()
    {
        return new HtmlString('</form>');
    }

    public function text($name, $value = null, $attributes = [])
    {
        return $this->input('text', $name, $value, $attributes);
    }

    public function email($name, $value = null, $attributes = [])
    {
        return $this->input('email', $name, $value, $attributes);
    }

    public function number($name, $value = null, $attributes = [])
    {
        return $this->input('number', $name, $value, $attributes);
    }

    public function password($name, $attributes = [])
    {
        return $this->input('password', $name, '', $attributes);
    }

    public function file($name, $attributes = [])
    {
        return $this->input('file', $name, null, $attributes);
    }

    public function textarea($name, $value = null, $attributes = [])
    {
        $attr = $this->buildAttributes($attributes);
        return new HtmlString("<textarea name=\"$name\" $attr>$value</textarea>");
    }

    public function select($name, $list = [], $selected = null, $attributes = [])
    {
        $attr = $this->buildAttributes($attributes);
        $html = "<select name=\"$name\" $attr>";

        foreach ($list as $key => $value) {
            $isSelected = $selected == $key ? 'selected' : '';
            $html .= "<option value=\"$key\" $isSelected>$value</option>";
        }

        $html .= "</select>";

        return new HtmlString($html);
    }

    public function input($type, $name, $value, $attributes = [])
    {
        $attr = $this->buildAttributes($attributes);

        return new HtmlString("<input type=\"$type\" name=\"$name\" value=\"$value\" $attr>");
    }

    protected function buildAttributes($attributes)
    {
        $compiled = [];
        foreach ($attributes as $key => $value) {
            $compiled[] = "$key=\"$value\"";
        }
        return implode(' ', $compiled);
    }
}
