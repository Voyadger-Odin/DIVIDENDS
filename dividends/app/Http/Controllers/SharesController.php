<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOption\None;

class SharesController extends Controller
{
    public function getAllShares(Request $request){
        $limit = 20;

        if ($request->limit) {
            $limit = $request->limit;
        }

        $where = [];
        $whereSQL = '';

        // НАЗВАНИЕ / ТИКЕР
        if (isset($request['stock_name']) and $request['stock_name'] != ''){
            $where[] = 'ticker LIKE "' . $request['stock_name'] . '%"'
                . ' OR name LIKE "' . $request['stock_name'] . '%"';
        }

        // СЕКТОР
        if (isset($request['sector']) and $request['sector'] != 'none'){
            $where[] = 'sector = "' . $request['sector'] . '"';
        }

        // ЦЕНА
        if (isset($request['cost_start']) and $request['cost_start'] != ''){
            $where[] = 'price >= ' . $request['cost_start'];
        }
        if (isset($request['cost_end']) and $request['cost_end'] != ''){
            $where[] = 'price <= ' . $request['cost_end'];
        }

        // ВАЛЮТА
        if (isset($request['currency']) and $request['currency'] != '' and $request['currency'] != 'all'){
            $where[] = 'currency = "' . $request['currency'] . '"';
        }

        // ДИВИДЕНДЫ
        if (isset($request['dividends']) and $request['dividends'] != '' and $request['dividends'] != 'all'){
            if ($request['dividends'] == 'pay'){
                $where[] = 'pay_dividends = true';
            }elseif ($request['dividends'] == 'will_pay'){
                $where[] = 'share_models.figi IN (SELECT figi FROM dividends_models)';
            }
        }


        // Сортировка


        foreach ($where as $sql){
            if ($whereSQL != ''){
                $whereSQL .= ' AND';
            }
            $whereSQL = $whereSQL . '( ' . $sql . ' )';
        }


        $sqlBody = '';
        if ($whereSQL != ''){
            $sqlBody = $sqlBody . ' WHERE ' . $whereSQL;
        }

        $from = 'share_models';
        if (isset($request['dividends']) and $request['dividends'] == 'will_pay'){
            $from = 'share_models LEFT JOIN dividends_models ON share_models.figi = dividends_models.figi';
        }

        $sqlQuery = 'SELECT DISTINCT * FROM ' . $from . ' ' . $sqlBody;
        // Сортировка
        if (isset($request['sort']) and isset($request['sort_dirrection'])){
            $sqlQuery = $sqlQuery . ' ORDER BY ' . $request['sort'];
            if ($request['sort_dirrection'] == 'desc'){
                $sqlQuery = $sqlQuery . ' DESC';
            }
        }
        // Лимит
        $sqlQuery = $sqlQuery . ' LIMIT ' . $limit;
        if (isset($request['page']) and $request['page'] > 1){
            $sqlQuery = $sqlQuery . ' OFFSET ' . ($limit * ($request['page'] - 1));
        }

        $sqlQueryCount = 'SELECT DISTINCT COUNT(*) as count FROM ' . $from . ' ' . $sqlBody;
        //var_dump($sqlQueryCount);
        //die();
        $count = DB::select($sqlQueryCount)[0]->count;


        $results = DB::select($sqlQuery);

        return view('stocks/stock',
            [
                'shares' => $results,
                'request' => $request,
                'count' => $count,
                'limit' => $limit,
                'dividends' => (isset($request['dividends']) ? $request['dividends'] : false),
                'sort' => (isset($request['sort']) ? $request['sort'] : false),
                'sort_dirrection' => ((isset($request['sort_dirrection']) ) ? $request['sort_dirrection'] : false)
            ]
        );
    }

    public function getDividends(){

        $dividends = DB::table('dividends_models')
            ->join('share_models','share_models.figi','=','dividends_models.figi')
            ->select('*')
            ->get()
            ->toJson();


        return view(
            'dividends_calendar',
            ['dividends' => $dividends]
        );
    }


    public function getStockInfo($ticker){
        return view('stocks/stock_info',
        ['ticker' => $ticker]);
    }
}
