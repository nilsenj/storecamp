<?php


if ( ! function_exists('resolveModelName'))
{
    function resolveModelName($model)
    {
        $reflection = new ReflectionClass($model);
        return $reflection->getShortName();

    }
}

function determineActiveDBandResolveUp($migrationClass) {

    if (env('database.default') == 'mysql') {

        return $migrationClass::mySQLDB();

    }

    if (config('database.default') == 'pgsql') {

        return $migrationClass::postgreSQL();
    }
}


function determineActiveDBandResolveDown($migrationClass) {

    if (config('database.default') == 'mysql') {
        return $migrationClass::downmySQLDB();
    }

    if (config('database.default') == 'pgsql') {

        return $migrationClass::downpostgreSQL();
    }
}

if ( ! function_exists('ruTolat')) {

    function ruTolat($str)
    {
        $tr = array(
            "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
            "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i",
            "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n",
            "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t",
            "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch",
            "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"",
            "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b",
            "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
            "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"j", "к"=>"k",
            "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p",
            "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f",
            "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch",
            "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu",
            "я"=>"ya", " "=>"-", "."=>"", ","=>"", "/"=>"-",
            ":"=>"", ";"=>"","—"=>"", "–"=>"-"
        );
        return strtr($str,$tr);
    }

}

