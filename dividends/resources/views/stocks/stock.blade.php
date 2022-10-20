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

    <script>
        function number_format(num) {
            return '+' + num;
        }
    </script>
@endsection
<!-------------------------->

<?php

use App\Console\Constants;

// Текущая страница
$pageCurrent = 1;
if (isset($request['page'])){
    $pageCurrent = $request['page'];
}





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

function DateFormat($date){
    $date_parameters = explode('-', $date);
    return $date_parameters[2] . '-' . $date_parameters[1] . '-' . $date_parameters[0];
}


$iconUP = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16"><path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/></svg>';
$iconDOWN = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16"><path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>';

?>

@section('body')

    <script>

        pageCurrent = <?= $pageCurrent ?>

    </script>

    <br><br><br>

    <div class="container py-1">
        <div class="p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal text-light">Акции</h1>
        </div>

        <div class="block-filters">
            <table class="table table-shares table-borderless">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Сектор</th>
                    <th>Стоимость</th>
                    <th>Валюта</th>
                    <th>Дивиденды</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="text" class="form-control"
                               placeholder="Название или тикер" id="stock_name"
                               value="<?= (isset($request['stock_name'])) ? $request['stock_name'] : ''  ?>"
                        >
                    </td>
                    <td>
                        <select class="form-select" aria-label="Default select example" id="sector" onchange="find()">
                            <option value="all">Все</option>
                            @foreach(Constants::Sectors() as $sector => $name)
                                <option value="{{$sector}}"
                                <?= (isset($request['sector']) and $request['sector'] == $sector) ? 'selected' : ''  ?>
                                >{{$name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" placeholder="От:" id="cost_start"
                                value="<?= (isset($request['cost_start'])) ? $request['cost_start'] : ''  ?>">
                        <br>
                        <input type="number" class="form-control" placeholder="До:" id="cost_end"
                                value="<?= (isset($request['cost_end'])) ? $request['cost_end'] : ''  ?>">
                    </td>
                    <td>
                        <select class="form-select" aria-label="Default select example" id="currency" onchange="find()">
                            <option value="all">Все</option>
                            <option value="rub"
                            <?= (isset($request['currency']) and $request['currency'] == 'rub') ? 'selected' : ''  ?>
                            >₽ Рубли</option>
                            <option value="usd"
                            <?= (isset($request['currency']) and $request['currency'] == 'usd') ? 'selected' : ''  ?>
                            >$ Доллары</option>
                            <option value="eur"
                            <?= (isset($request['currency']) and $request['currency'] == 'eur') ? 'selected' : ''  ?>
                            >€ Евро</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" aria-label="Default select example" id="dividends" onchange="find()">
                            <option value="all">Все</option>
                            <option value="pay"
                            <?= (isset($request['dividends']) and $request['dividends'] == 'pay') ? 'selected' : ''  ?>
                            >Выплачивает дивиденды</option>
                            <option value="will_pay"
                            <?= (isset($request['dividends']) and $request['dividends'] == 'will_pay') ? 'selected' : ''  ?>
                            >Собирается выплатить дивиденды</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" onclick="find()">Применить</button>
                        <br><br>
                        <a href="/dividends/stock">
                            <button type="button" class="btn btn-danger">Сбросить</button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <table class="table table-shares table-borderless">
            <thead>
            <tr>
                <th class="align-middle" scope="col"></th>
                <th scope="col" class="stocks_colum_name" onclick="find({{$pageCurrent}}, 'name', '{{$sort}}', '{{$sort_dirrection}}')">
                    @if ($sort == 'name')
                        @if ($sort_dirrection == 'asc')
                            <?= $iconUP ?>
                        @else
                            <?= $iconDOWN ?>
                        @endif
                    @endif
                    Название
                </th>
                <th scope="col" class="stocks_colum_name" onclick="find({{$pageCurrent}}, 'ticker', '{{$sort}}', '{{$sort_dirrection}}')">
                    @if ($sort == 'ticker')
                        @if ($sort_dirrection == 'asc')
                            <?= $iconUP ?>
                        @else
                            <?= $iconDOWN ?>
                        @endif
                    @endif
                    Ticker
                </th>
                <th scope="col" class="stocks_colum_name" onclick="find({{$pageCurrent}}, 'sector', '{{$sort}}', '{{$sort_dirrection}}')">
                    @if ($sort == 'sector')
                        @if ($sort_dirrection == 'asc')
                            <?= $iconUP ?>
                        @else
                            <?= $iconDOWN ?>
                        @endif
                    @endif
                    Сектор
                </th>
                <th scope="col" class="stocks_colum_name" onclick="find({{$pageCurrent}}, 'price')">Стоимость</th>
                <th scope="col" class="stocks_colum_name" onclick="find({{$pageCurrent}}, 'lot')">Лот</th>
                @if ($dividends and $dividends == 'will_pay')
                    <th scope="col" class="stocks_colum_name">Дата выплат</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($shares as $share)
                <tr onclick="stockClick('{{ $share->ticker }}')">
                    <td class="align-middle"><img class="share-img" src="{{ $share->img }}"></td>
                    <td class="align-middle">{{ $share->name }}</td>
                    <td class="align-middle">{{ $share->ticker }}</td>
                    <td class="align-middle">{{ Sector($share->sector) }}</td>
                    <td class="align-middle">
                        @if($share->direction == 'up')
                            <span class="arrow-up">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg>
                            </span>
                        @elseif($share->direction == 'down')
                            <span class="arrow-down">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </span>
                        @endif
                        {{ NumberFormat($share->price) . ' ' . Currency($share->currency) }}
                    </td>
                    <td class="align-middle">{{ Sector($share->lot) }}</td>

                    @if ($dividends and $dividends == 'will_pay')
                        <td class="align-middle">{{ DateFormat(Sector($share->payment_date)) }}</td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>

        <br><br>


        <?php
        $pages = $count / $limit;
        $pages = round($pages) + ($pages > round($pages) ? 1 : 0);

        $space = true;
        ?>

        @if ($limit < $count)
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    @if ($pageCurrent > 1)
                        <li class="page-item">
                            <a class="page-link btn-page" onclick="pagination({{ $pageCurrent - 1  }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                                </svg>
                            </a>
                        </li>
                    @endif
                    @for ($i = 0; $i < $pages; $i++)
                        @if ($pages > 10)
                            @if (($i >= 3) and ($i < $pages - 3) and (($i < $pageCurrent - 1 - (1)) or ($i >= $pageCurrent + (1))))
                                @if ($space)
                                    <li class="page-space"><a class="page-link page-space" >...</a></li>
                                @endif
                                <?php
                                    $space = false;
                                ?>
                                @continue
                            @endif
                            <?php
                                $space = true;
                            ?>
                        @endif

                        @if($pageCurrent == ($i + 1))
                                <li class="page-item active"><a class="page-link">{{ $i + 1  }}</a></li>
                        @else
                                <li class="page-item"><a class="page-link btn-page" onclick="pagination({{ $i + 1  }})">{{ $i + 1  }}</a></li>
                        @endif
                    @endfor
                    @if ($pageCurrent < $pages)
                        <li class="page-item">
                            <a class="page-link btn-page" onclick="pagination({{ $pageCurrent + 1  }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif

        <?php

            //echo 'pages ' . $pages . '<br>' . 'count ' . $count . '<br>' . 'limit ' . $limit;
        ?>
    </div>


    <script type="text/javascript" src="{{ URL::to('dividends/resources/js/stocks/stocks.js') }}"></script>
@endsection
