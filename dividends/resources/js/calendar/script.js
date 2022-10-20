

/*
| ------------------------------------------------------------------------------
| Calendar plugin (rough draft)
| ------------------------------------------------------------------------------
*/


//var companyList;

/*
var companyList = {
    '2022-06-26': {
        'stock': [
            {"name": "zaebumba", "FIGI": "BBG000BHJSC4", "profitability": 53, "gap": 22.5, "amount_days": 30, "good_company": true, 'income': 0.5}
        ]
    }
};
*/

/*
var companyList_DB = [
    {"id":2,"figi":"BBG0029SFXB3","dividend_net":3.9699999999999998,"payment_date":"1970-01-01","last_buy_date":"2022-07-07","yield_value":5.8,"regularity":"","dividend_type":""}
];
 */

//var companyList_test = {};

var companyList = {};




function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous
    xmlHttp.send(null);
}


(function($){

    var Calendar = function (elem, options) {
        this.elem = elem;
        this.options = $.extend({}, Calendar.DEFAULTS, options);
        this.init();
    };

    Calendar.DEFAULTS = {
        datetime: undefined,
        dayFormat: 'DDD',
        weekFormat: 'DDD',
        monthFormat: 'MM/DD/YYYY',
        view: undefined,
    };

    Calendar.prototype.init = function () {
        if (! this.options.datetime || this.options.datetime == 'now') {
            this.options.datetime = moment();
        }
        if (! this.options.view) {
            this.options.view = 'month';
        }
        this.initScaffold()
            .initStyle()
            .render();
    }

    Calendar.prototype.initScaffold = function () {

        var $elem = $(this.elem),
            $view = $elem.find('.calendar-view'),
            $currentDate = $elem.find('.calendar-current-date');

        if (! $view.length) {
            this.view = document.createElement('div');
            this.view.className = 'calendar-view';
            this.elem.appendChild(this.view);
        } else {
            this.view = $view[0];
        }

        if ($currentDate.length > 0) {
            var dayFormat = $currentDate.data('day-format'),
                weekFormat = $currentDate.data('week-format'),
                monthFormat = $currentDate.data('month-format');
            this.currentDate = $currentDate[0];
            if (dayFormat) {
                this.options.dayFormat = dayFormat;
            }
            if (weekFormat) {
                this.options.weekFormat = weekFormat;
            }
            if (monthFormat) {
                this.options.monthFormat = monthFormat;
            }
        }
        return this;
    }

    Calendar.prototype.initStyle = function () {
        return this;
    }

    Calendar.prototype.render = function () {
        switch (this.options.view) {
            case 'day': this.renderDayView(); break;
            case 'week': this.renderWeekView(); break;
            case 'month': this.renderMonthView(); break;
                befault: this.renderMonth();
        }
    }

    Calendar.prototype.renderDayView = function () {
        $(this.elem).append('Day View');
    }

    Calendar.prototype.renderWeekView = function () {
        $(this.elem).append('Week View');
    }

    Calendar.prototype.renderMonthView = function () {

        var datetime = this.options.datetime.clone(),
            month = datetime.month();

        datetime.startOf('month').startOf('week');
        datetime.add(-7 + 1, 'day');
        if (parseInt(datetime.format('D')) + 7 <= datetime.daysInMonth()){
            datetime.add(7, 'day');
        }

        var $view = $(this.view),
            table = document.createElement('table'),
            thead = document.createElement('thead');
        tbody = document.createElement('tbody');

        var weekDays = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
        tr = document.createElement('tr');
        weekDays.forEach((elem) => {
            td = document.createElement('th');
            td.className = 'calendar-head-day';
            td.appendChild(document.createTextNode(elem));
            tr.appendChild(td);
        })
        thead.appendChild(tr);

        $view.html('');
        table.appendChild(thead);
        table.appendChild(tbody);
        table.className = 'table';

        var week = 0, i;
        while (week < 6) {
            tr = document.createElement('tr');
            tr.className = 'calendar-month-row';
            for (i = 0; i < 7; i++) {
                td = document.createElement('td');
                td.className = 'calendar-day';
                //td.onclick = function(){ dayClick(datetime.format('D')); }

                td.appendChild(document.createTextNode(datetime.format('D')));
                //console.log(datetime.format('D'));
                if (month !== datetime.month()) {
                    td.className = 'calendar-prior-months-date';
                }else{
                    td.setAttribute(
                        "onclick",
                        "dayClick('" + datetime.format('YYYY-MM-DD') + "')"
                    );

                    // Points
                    if (
                        companyList[datetime.format('YYYY-MM-DD')]
                        && companyList[datetime.format('YYYY-MM-DD')]['stock'].length > 0){
                        td.appendChild(document.createElement('br'));
                        td.appendChild(document.createElement('br'));
                        let point;

                        if (companyList[datetime.format('YYYY-MM-DD')]['stock'].length > 4){
                            var pointText = document.createElement('div');
                            pointText.className = 'pointText';
                            pointText.appendChild(document.createTextNode(
                                companyList[datetime.format('YYYY-MM-DD')]['stock'].length
                            ));
                            td.appendChild(pointText);

                        }else{
                            companyList[datetime.format('YYYY-MM-DD')]['stock'].forEach((elem) => {
                                point = document.createElement('div');
                                point.className = 'point';
                                td.appendChild(point);
                            });
                        }
                    }
                }
                if (
                    datetime.format('MM/DD/YYYY') === moment().format('MM/DD/YYYY')){
                    td.className = 'calendar-day calendar-current-day';
                }


                tr.appendChild(td);
                datetime.add(1, 'day');
            }
            tbody.appendChild(tr);
            week++;
        }

        $view[0].appendChild(table);

        if (this.currentDate) {
            $(this.currentDate).html(
                this.options.datetime.format(this.options.monthFormat)
            );
        }

    }

    Calendar.prototype.next = function () {
        switch (this.options.view) {
            case 'day':
                this.options.datetime.add(1, 'day');
                this.render();
                break;
            case 'week':
                this.options.datetime.endOf('week').add(1, 'day');
                this.render();
                break;
            case 'month':
                this.options.datetime.endOf('month').add(1, 'day');
                this.render();
                break;
            default:
                break;
        }
    }

    Calendar.prototype.prev = function () {
        switch (this.options.view) {
            case 'day':
                break;
            case 'week':
                break;
            case 'month':
                this.options.datetime.startOf('month').subtract(1, 'day');
                this.render();
                break;
            default:
                break;
        }
    }

    Calendar.prototype.today = function () {
        this.options.datetime = moment();
        this.render();
    }

    function Plugin(option) {
        return this.each(function () {
            var $this = $(this),
                data  = $this.data('bs.calendar'),
                options = typeof option == 'object' && option;
            if (! data) {
                data = new Calendar(this, options);
                $this.data('bs.calendar', data);
            }

            switch (option) {
                case 'today':
                    data.today();
                    break;
                case 'prev':
                    data.prev();
                    break;
                case 'next':
                    data.next();
                    break;
                default:
                    break;
            }
        });
    };

    var noConflict = $.fn.calendar;

    $.fn.calendar             = Plugin;
    $.fn.calendar.Constructor = Calendar;

    $.fn.calendar.noConflict = function () {
        $.fn.calendar = noConflict;
        return this;
    };

    // Public data API.
    $('[data-toggle="calendar"]').click(function(){
        var $this = $(this),
            $elem = $this.parents('.calendar'),
            action = $this.data('action');
        if (action) {
            $elem.calendar(action);
        }
    });

})(jQuery);

/*
| ------------------------------------------------------------------------------
| Installation
| ------------------------------------------------------------------------------
*/


function modalAlert(title, body){

    let modalBody = document.getElementsByClassName('modalBody-p');
    if (modalBody.length > 0){
        modalBody[0].remove();
    }


    $('.modal-title').text(title);
    var elements = document.getElementsByClassName('modal-body');
    elements[0].appendChild(body);

    $("#exampleModal").modal('show');
}

function dayClick(data){
    //alert(data);
    //return;

    let title = 'Сводка на ' + data;
    let body;
    var thead;
    var tbody;
    var tr;
    var th;
    var td;
    var center;

    if (companyList[data]){
        body = document.createElement('p')
        body.className = 'modalBody-p';
        var tableCompanys = document.createElement('table');
        tableCompanys.className = 'companyList';
        thead = document.createElement('thead');
        tbody = document.createElement('tbody');
        tr = document.createElement('tr');

        th = document.createElement('th');
        th.appendChild(document.createTextNode(''));
        tr.appendChild(th);

        th = document.createElement('th');
        th.appendChild(document.createTextNode('Компания'));
        tr.appendChild(th);

        th = document.createElement('th');
        center = document.createElement('center');
        center.appendChild(document.createTextNode('Цена бумаги'));
        th.appendChild(center);
        tr.appendChild(th);

        th = document.createElement('th');
        center = document.createElement('center');
        center.appendChild(document.createTextNode('Доход'));
        th.appendChild(center);
        tr.appendChild(th);


        thead.appendChild(tr);

        tableCompanys.appendChild(thead);
        tableCompanys.appendChild(tbody);
        body.appendChild(tableCompanys);


        var company;
        companyList[data]['stock'].forEach((elem) => {
            tr = document.createElement('tr');

            // Ссылка
            company = document.createElement('a');
            company.setAttribute('href', 'https://www.tinkoff.ru/invest/stocks/' + elem['ticker'] + '/');
            company.setAttribute('target', '_blank');
            company.appendChild(document.createTextNode(elem['name']));

            // Иконка
            img = document.createElement('img');
            img.setAttribute('src', elem['img']);
            img.setAttribute('class', 'share-img');

            td = document.createElement('td');
            td.appendChild(img);
            tr.appendChild(td);

            td = document.createElement('td');
            td.appendChild(company);
            tr.appendChild(td);

            td = document.createElement('td');
            center = document.createElement('center');
            center.appendChild(document.createTextNode(elem['price'].toFixed(2) + elem['currency']));
            td.appendChild(center);
            tr.appendChild(td);

            td = document.createElement('td');
            center = document.createElement('center');
            center.appendChild(document.createTextNode(elem['income'].toFixed(2) + '%'));
            td.appendChild(center);
            tr.appendChild(td);


            tbody.appendChild(tr);

        });

    }else{
        body = document.createElement('p');
        body.className = 'modalBody-p';
        body.appendChild(document.createTextNode('Список компаний пуст'));
        body.appendChild(document.createElement('br'));
    }
    modalAlert(title, body);
}


$(window).load(function() {
    //companyList_DB
    //companyList_test

    function Currency(currency)
    {
        if (currency === 'usd') {
            return '$';
        } else if (currency === 'rub') {
            return '₽';
        } else if (currency === 'eur') {
            return '€';
        }
    }

    for (var i=0; i<companyList_DB.length; i++){
        if (!companyList[companyList_DB[i]['last_buy_date']]){
            companyList[companyList_DB[i]['last_buy_date']] = {'stock': []};
        }
        companyList[companyList_DB[i]['last_buy_date']]['stock'].push({
            'img': companyList_DB[i]['img'],
            'name': companyList_DB[i]['name'],
            'FIGI': companyList_DB[i]['figi'],
            'ticker': companyList_DB[i]['ticker'],
            'price': companyList_DB[i]['price'],
            'currency': Currency(companyList_DB[i]['currency']),
            'income': companyList_DB[i]['yield_value'],
        })
    }

    $('#calendar').calendar();
});
