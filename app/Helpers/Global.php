<?php

use App\Models\Config;
use Illuminate\Support\Arr;

function wrap($value)
{
    return Arr::wrap($value);
}

function IDR($value)
{
    return 'Rp. ' . number($value);
}

function number($value)
{
    if ($value && is_numeric($value)) {
        return number_format($value, 0, ',', '.');
    }
    return $value;
}

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

function eventInfo($key = null){
    $config = new Config;

    return is_null($key)
            ? $config
            : $config->key($key);
}

function linkify($value, $protocols = array('http', 'mail'), array $attributes = array('target' => '_blank'))
{
    // Link attributes
    $attr = '';
    foreach ($attributes as $key => $val) {
        $attr .= ' ' . $key . '="' . htmlentities($val) . '"';
    }

    $links = array();

    // Extract existing links and tags
    $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);

    // Extract text links for each protocol
    foreach ((array)$protocols as $protocol) {
        switch ($protocol) {
            case 'http':
            case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3]; return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>'; }, $value); break;
            case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
            case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value); break;
            default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
        }
    }

    // Insert all link
    return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
}

function htmltotext($html, $enable = true)
{
    return $enable ? strip_tags($html) : $html;
}

function site($key = null, $default = null, $allowHtml = false)
{
    try {
        $file = file_get_contents(base_path('site.json'));
        $data = json_decode($file, true);

        return $data[$key]
                ? htmltotext($data[$key], ! $allowHtml)
                : $default;

    } catch (\Throwable $th) {

        return $default;
    }
}

function siteUpdate(array $data)
{
    return file_put_contents(base_path('site.json'), json_encode($data));
}