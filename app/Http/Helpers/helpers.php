<?php

use App\Http\Helpers\CommonStringHelper;

if (! function_exists('normalize_name')) {
    /**
     * Wrapper: normalize name using CommonStringHelper
     */
    function normalize_name(string $name): string
    {
        return CommonStringHelper::normalizeName($name);
    }
}
