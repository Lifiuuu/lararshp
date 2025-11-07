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

if (! function_exists('validate_unique_name')) {
    /**
     * Wrapper: validate unique name using CommonStringHelper::validateUniqueName
     */
    function validate_unique_name(string $modelClass, string $fieldName, $value, $excludeId = null): bool
    {
        return CommonStringHelper::validateUniqueName($modelClass, $fieldName, $value, $excludeId);
    }
}
