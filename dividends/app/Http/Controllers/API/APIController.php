<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShareModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class APIController extends Controller
{
    // Получение списка акций
    public function getShare(Request $request){
        $columns_array = [];
        if (isset($request->figi)){
            array_push($columns_array, 'figi');
        }
        if (isset($request->name)){
            array_push($columns_array, 'name');
        }
        if (isset($request->ticker)){
            array_push($columns_array, 'ticker');
        }
        if (isset($request->price)){
            array_push($columns_array, 'price');
        }
        if (isset($request->lot)){
            array_push($columns_array, 'lot');
        }
        if (isset($request->currency)){
            array_push($columns_array, 'currency');
        }
        if (isset($request->pay_dividends)){
            array_push($columns_array, 'pay_dividends');
        }
        if (isset($request->direction)){
            array_push($columns_array, 'direction');
        }
        if (isset($request->sector)){
            array_push($columns_array, 'sector');
        }
        if (isset($request->img)){
            array_push($columns_array, 'img');
        }


        if (count($columns_array) == 0){
            $columns_array = ['*'];
        }
        return DB::table('share_models')->get($columns_array)->toJson();
    }

    // Установление новых акций
    public function setShare(Request $request){
        $data = json_decode($request->data, true);

        foreach ($data as $figi => $params){
            DB::insert('insert into share_models (figi, name, ticker, price, lot, currency, pay_dividends, direction, sector, img) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $params['figi'],
                    $params['name'],
                    $params['ticker'],
                    $params['price'],
                    $params['lot'],
                    $params['currency'],
                    $params['pay_dividends'],
                    'none',
                    $params['sector'],
                    $params['img'],
                ]);
        }

        echo 'OK';
    }


    // Установление новых дивидендов
    public function setDividends(Request $request){
        $data = json_decode($request->data, true);


        foreach ($data as $item){
            //$date = explode('+', $item['payment_date'])[0];
            //$today = new Carbon($item['payment_date']);

            DB::insert('insert into dividends_models (figi, dividend_net, payment_date, last_buy_date, yield_value, regularity, dividend_type) values (?, ?, ?, ?, ?, ?, ?)',
                [
                    $item['figi'],
                    $item['dividend_net'],
                    new Carbon($item['payment_date']),
                    new Carbon($item['last_buy_date']),
                    $item['yield_value'],
                    $item['regularity'],
                    $item['dividend_type'],
                ]);
        }

        echo 'OK';
    }


    // Получение списка акций
    public function getDididends(Request $request){
        return DB::table('dividends_models')->get()->toJson();
    }


    // Обновление цен на сохранённые акции
    public function updateStocksPrice(Request $request){
        function getDirectionName($data){
            if ($data == 0){
                return 'none';
            }elseif ($data > 0){
                return 'up';
            }elseif ($data < 0){
                return 'down';
            }
        }

        $data = json_decode($request->data, true);
        foreach ($data as $stock){
            DB::update('update share_models set price = ? , direction = ? where figi = ?',
                [
                    $stock['price'],
                    getDirectionName($stock['delta']),
                    $stock['figi']
                ]
            );
            /*
            ShareModel::where('figi', $stock['figi'])
                ->update(array(
                    'price' => $stock['price'],
                    'direction' => getDirectionName($stock['delta'])
                ));
            var_dump($stock);
            */
        }
        return 'OK';
    }
}
