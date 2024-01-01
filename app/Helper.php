<?php

if (!function_exists('getDurationPrice')) {
    function getDurationPrice($request)
    {
        $durations = $request->validated()['duration'];
        $prices = $request->validated()['price'];
        unset($request->validated()['duration'], $request->validated()['price']);
        if (count($durations) !== count($prices)) {
            return redirect()->back()->withErrors('message', 'Kiểm tra thời gian và giá');
        }

        return array_map(function ($duration, $price) {
            return [
                "duration" => $duration,
                "price" => $price,
            ];
        }, $durations, $prices);
    }
}
