
//page_current = 1;
page = 1;

function find(){
    url = 'stock';
    getData = '';

    // Сортрировка
    /*
    if (sort){
        if (getData !== ''){ getData += '&' }
        getData += 'sort='+sort;

        if (getData !== ''){ getData += '&' }
        if (change_dirrection){
            if (sort === sort_now){
                if (sort_dirrection === 'asc'){
                    sort_dirrection = 'desc';
                }else{
                    sort_dirrection = 'asc';
                }
            }else{
                sort_dirrection = 'asc';
            }
        }

        getData += 'sort_dirrection='+sort_dirrection;
    }
     */

    // Название / Тикер
    stock_name = $('#stock_name').val();
    if (stock_name !== ''){
        if (getData !== ''){ getData += '&' }
        getData += 'stock_name='+stock_name;
    }

    // Сектор
    sector = $('#sector').val();
    if (sector !== '' && sector !== 'all'){
        if (getData !== ''){ getData += '&' }
        getData += 'sector='+sector;
    }

    // Стоимость
    cost_start = $('#cost_start').val();
    if (cost_start !== '' && cost_start !== 0){
        if (getData !== ''){ getData += '&' }
        getData += 'cost_start='+cost_start;
    }
    cost_end = $('#cost_end').val();
    if (cost_end !== '' && cost_end !== 0){
        if (getData !== ''){ getData += '&' }
        getData += 'cost_end='+cost_end;
    }

    // Валюта
    currency = $('#currency').val();
    if (currency !== '' && currency !== 'all'){
        if (getData !== ''){ getData += '&' }
        getData += 'currency='+currency;
    }

    // Дивиденды
    dividends = $('#dividends').val();
    if (dividends !== '' && dividends !== 'all'){
        if (getData !== ''){ getData += '&' }
        getData += 'dividends='+dividends;
    }

    // ПАГИНАЦИЯ
    if (page > 1) {
        if (getData !== '') {
            getData += '&'
        }
        getData += 'page=' + page;
    }



    window.location = url + '?' + getData;
}

function pagination(pageTo){
    page = pageTo;
    find();
}


$(document).ready(function(){
    $('#stock_name').keypress(function(e){
        if(e.keyCode===13){ find(); }
    });
    $('#cost_start').keypress(function(e){
        if(e.keyCode===13){ find(); }
    });
    $('#cost_end').keypress(function(e){
        if(e.keyCode===13){ find(); }
    });
});


function stockClick(ticker){
    window.location = 'stock/' + ticker;
}
