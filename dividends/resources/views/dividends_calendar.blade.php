@extends('layout.main_layout')

@section('page_info')
    <?php

    $pageInfo = [
        'name' => 'calendar'
    ];
    ?>
@endsection

@section('title')
    Календарь
@endsection

<!---------- HEAD ---------->
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('dividends/resources/css/calendar/style.css') }}">

    <script>
        var companyList_DB = <?php echo $dividends; ?>
    </script>
@endsection
<!-------------------------->

<!---------- BODY ---------->
@section('body')

    <!--
    <div class="preload-block" id="preload-block">
        <div class="preload-point">
            <div class="spinner-grow" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
    </div>
    -->

    <!--
    <base target="_blank">
    -->


    <h1 class="page-header">
        Календарь дивидендов
    </h1>

    <div class="calendar" id="calendar">

        <!-- Calendar toolbar -->
        <div class="calendar-toolbar">

            <!-- Calendar "today" button -->
            <button data-toggle="calendar" data-action="today" class="btn btn-dark" type="button">
                Сегодня
            </button>

            <!-- Calendar "prev" button -->
            <button data-toggle="calendar" data-action="prev" class="btn btn-dark" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                </svg>
            </button>

            <!-- Calendar "date-indicator" span -->
            <div class="calendar-current-date"
                 data-day-format="MM/DD/YYYY"
                 data-week-format="MM/DD/YYYY"
                 data-month-format="MMMM, YYYY">
                (placeholder)
            </div>

            <!-- Calendar "next" button -->
            <button data-toggle="calendar" data-action="next" class="btn btn-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                </svg>
            </button>

        </div>

    </div>








    <script type="text/javascript" src="{{ URL::to('dividends/resources/js/calendar/moment.js') }}"></script>


    <!-- Latest compiled and minified JavaScript -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    -->

    <script type="text/javascript" src="{{ URL::to('dividends/resources/js/calendar/script.js') }}"></script>
@endsection
<!-------------------------->
