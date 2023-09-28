<?php
class Choice
{
    public string $value = "";
    public string $label = "";
    public array $nemesisValue = [];

    public function __construct(string $value, string $label, array $nemesisValue)
    {
        $this->value = $value;
        $this->label = $label;
        $this->nemesisValue = $nemesisValue;
    }
}
