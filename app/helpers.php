<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 29.08.2019
 * Time: 10:43
 */
if (! function_exists('check_url')) {
    /**
     * Return valid url
     *
     * @return string
     */
    function check_url($url) {
        if (!preg_match('/^(https:\/\/|http:\/\/)/', $url)) {
            $url = 'https:' . $url;
        }
        return $url;
    }
}

if (! function_exists('get_json_by_regex')) {
    /**
     * Return finded json
     *
     * @param $regex
     * @param $text
     * @return string
     */
    function get_json_by_regex($regex, $text) {
        $matches = array();
        preg_match_all($regex, $text, $matches);
        return $matches;
    }
}

if (! function_exists('change_url_params')) {
    /**
     * Return valid url
     *
     * @return string
     */
    function change_url_params($url, $params) {
        $url_parts = parse_url($url);
        if (!empty($url_parts['query'])) {
            parse_str($url_parts['query'], $url_params);
            foreach ($params as $param_key => $param_value) {
                if (isset($url_params[$param_key])) {
                    $url_params[$param_key] = $param_value;
                }
            }
            
            $url = str_replace($url_parts['query'], http_build_query($url_params), $url);
        }
        
        return $url;
    }
}

if (! function_exists('get_random_proxy')) {
    /**
     * Return proxy
     *
     * @return string
     */
    function get_random_proxy($proxies) {
        $proxy_key = array_rand($proxies);
        return $proxies[$proxy_key];
    }
}
