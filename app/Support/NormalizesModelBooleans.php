<?php

namespace App\Support;

trait NormalizesModelBooleans
{
    /**
     * @param  list<string>  $booleanAttributes
     */
    protected function normalizeNullBooleans(array $booleanAttributes): void
    {
        foreach ($booleanAttributes as $attribute) {
            if (array_key_exists($attribute, $this->getAttributes()) && $this->{$attribute} === null) {
                $this->{$attribute} = false;
            }
        }
    }
}
