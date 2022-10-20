@extends('layout.main_layout')

@section('page_info')
    <?php

    $pageInfo = [
        'name' => 'stock'
    ];
    ?>
@endsection

@section('title')
    Акции
@endsection

<!---------- HEAD ---------->
@section('head')

    <link rel="stylesheet" type="text/css" href="{{ URL::to('dividends/resources/css/shares/shares.css') }}">
@endsection
<!-------------------------->

<?php

use App\Console\Constants;

function Currency($currency)
{
    if ($currency == 'usd') {
        return '$';
    } elseif ($currency == 'rub') {
        return '₽';
    } elseif ($currency == 'eur') {
        return '€';
    }
}

function Sector($sector)
{
    if (array_key_exists($sector, Constants::Sectors())) {
        return Constants::Sectors()[$sector];
    }
    return $sector;
}

function NumberFormat($number)
{
    return number_format($number, 1, ',', ' ');
}

?>

@section('body')

    <br><br><br>

    <div class="container py-1">
        <div class="p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal text-light">{{$ticker}}</h1>
        </div>
    </div>
@endsection
