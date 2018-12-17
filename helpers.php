<?php


class GarchiveHelpers
{
    public static function get_creators()
    {
        if (!function_exists('rwmb_meta'))
            return null;

        return rwmb_meta('garchive_metabox_creators');
    }

    public static function get_source() {
        if (!function_exists('rwmb_meta'))
            return null;
            
        return rwmb_meta('garchive_metabox_source');
    }
}