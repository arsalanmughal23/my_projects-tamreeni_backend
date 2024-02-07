<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('no_zeros_or_whitespace', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/^[0\s]+$/', $value);
        });
    
        Validator::replacer('no_zeros_or_whitespace', function ($message, $attribute, $rule, $parameters) {
            return str_replace(
                ':attribute',
                $attribute,
                'The :attribute field cannot consist only of zeros or whitespace characters.'
            );
        });

        Validator::extend('no_multiple_zeros_or_whitespace', function ($attribute, $value, $parameters, $validator) {
            // Use a regular expression to match multiple zeros (0) or whitespace
            return !preg_match('/^([0\s])\1+$/', $value);
        });
        
        Validator::replacer('no_multiple_zeros_or_whitespace', function ($message, $attribute, $rule, $parameters) {
            return str_replace(
                ':attribute',
                $attribute,
                'The :attribute field cannot consist of consecutive zeros or whitespace characters.'
            );
            
        });

        Validator::extend('no_zeros_whitespace_or_numeric', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/^(0+|\s+|\d+)$/', $value);
        });
        
        Validator::replacer('no_zeros_whitespace_or_numeric', function ($message, $attribute, $rule, $parameters) {
            return str_replace(
                ':attribute',
                $attribute,
                'The :attribute field cannot consist only of zeros, whitespace, or numeric characters.'
            );
            
        });
        Validator::extend('no_zeros_whitespace_or_numeric_in_editor', function ($attribute, $value, $parameters, $validator) {
            // Replace any HTML tags to ensure we are only working with plain text
            $plainText = strip_tags($value);
        
            // Check for multiple consecutive &nbsp; sequences
            if (preg_match('/(&nbsp;\s*){4,}/', $plainText)) {
                return false;
            }
        
            // Check for <br /> exactly four times or more (consecutively)
            if (preg_match('/(<br \/>\s*){4,}/', $value)) {
                return false;
            }
        
            // Use a regular expression to check for non-numeric characters
            return !preg_match('/^(0+|\d+)$/', $plainText);
        });
        
        Validator::replacer('no_zeros_whitespace_or_numeric_in_editor', function ($message, $attribute, $rule, $parameters) {
            return str_replace(
                ':attribute',
                $attribute,
                'The :attribute field cannot consist only of zeros, whitespace, or numeric characters and cannot contain multiple consecutive new lines'
            );
            
        });
        
        Validator::extend('four_digit_year', function ($attribute, $value, $parameters, $validator) {
            // Check if the input matches the 'YYYY-MM-DD' format and the year is exactly four digits
            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $value);
        });
        Validator::replacer('four_digit_year', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The year field needs to contain 4 digits.');
        });
    }
}
