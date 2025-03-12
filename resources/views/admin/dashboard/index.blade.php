@extends('admin.master')
@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.dashboard') - @lang('site.charity')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')

            {{-- first row --}}
            @include('admin.dashboard.includes.static')
            {{-- second row --}}
            <div class="row mb-2">

                <div class="col-lg-8 col-xxl-8 mb-4 order-1 order-xxl-1">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="mb-0">{{__('site.cases tracker')}}</h5>
                                <small class="text-muted">{{__('site.last year')}}</small>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                        <h1 class="mb-0">{{$total_cases->count()}}</h1>
                                        <p class="mb-0">{{__('site.total cases')}}</p>
                                    </div>

                                    <ul class="p-0 m-0">
                                        <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                            <div class="badge rounded bg-label-primary p-1">
                                                <i class="ti ti-ticket ti-sm"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap">{{__('site.archived cases')}}</h6>
                                                <small
                                                    class="text-muted">{{$casesTracker['archived_cases_count']}}</small>
                                            </div>
                                        </li>
                                        {{-- <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                            <div class="badge rounded bg-label-info p-1">
                                                <i class="ti ti-circle-check ti-sm"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap">{{__('site.recycled cases')}}</h6>
                                                <small
                                                    class="text-muted">{{$casesTracker['recycled_cases_count']}}</small>
                                               
                                            </div>
                                        </li> --}}
                                        <li class="d-flex gap-3 align-items-center pb-1">
                                            <div class="badge rounded bg-label-warning p-1">
                                                <i class="ti ti-circle-check ti-sm"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap">{{__('site.done cases')}}</h6>
                                                <small class="text-muted">{{$casesTracker['done_cases_count']}}</small>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8" style="position: relative;">
                                    <div id="supportTracker" style="min-height: 235.4px;"></div>

                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 402px; height: 236px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Card for Assignment Progress -->
                <div class="col-lg-4 col-xxl-4 mb-4 order-2 order-xxl-2">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Assignment Progress</h5>
                        </div>

                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-3" style="position: relative;">
                                    <div class="chart-progress me-4" data-color="primary" data-series="72"
                                        data-progress_variant="true" style="min-height: 62.7px;">
                                        <div id="apexcharts8c5gmpnb"
                                            class="apexcharts-canvas apexcharts8c5gmpnb apexcharts-theme-light"
                                            style="width: 58px; height: 62.7px;">
                                            <svg id="SvgjsSvg1556" width="58" height="62.7"
                                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1558" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(-18, -12)">
                                                    <defs id="SvgjsDefs1557">
                                                        <clipPath id="gridRectMask8c5gmpnb">
                                                            <rect id="SvgjsRect1560" width="98" height="91" x="-3"
                                                                y="-1" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMask8c5gmpnb"></clipPath>
                                                        <clipPath id="nonForecastMask8c5gmpnb"></clipPath>
                                                        <clipPath id="gridRectMarkerMask8c5gmpnb">
                                                            <rect id="SvgjsRect1561" width="96" height="93" x="-2"
                                                                y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g id="SvgjsG1562" class="apexcharts-radialbar">
                                                        <g id="SvgjsG1563">
                                                            <g id="SvgjsG1564" class="apexcharts-tracks">
                                                                <g id="SvgjsG1565"
                                                                    class="apexcharts-radialbar-track apexcharts-track"
                                                                    rel="1">
                                                                    <path id="apexcharts-radialbarTrack-0"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676"
                                                                        fill="none" fill-opacity="1" stroke="#a8aaae29"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="4.223048780487806"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1567">
                                                                <g id="SvgjsG1572"
                                                                    class="apexcharts-series apexcharts-radial-series"
                                                                    seriesName="" rel="1" data:realIndex="0">
                                                                    <path id="SvgjsPath1573"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 20.59141833088211 49.43892795959411"
                                                                        fill="none" fill-opacity="0.85"
                                                                        stroke="rgba(115,103,240,0.85)"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="4.3536585365853675"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                        data:angle="259" data:value="72" index="0" j="0"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 20.59141833088211 49.43892795959411">
                                                                    </path>
                                                                </g>
                                                                <circle id="SvgjsCircle1568" r="18.772621951219513"
                                                                    cx="46" cy="44.5"
                                                                    class="apexcharts-radialbar-hollow"
                                                                    fill="transparent"></circle>
                                                                <g id="SvgjsG1569" class="apexcharts-datalabels-group"
                                                                    transform="translate(0, 0) scale(1)"
                                                                    style="opacity: 1;">
                                                                    <text id="SvgjsText1570"
                                                                        font-family="Helvetica, Arial, sans-serif"
                                                                        x="46" y="44.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="16px"
                                                                        font-weight="500" fill="#7367f0"
                                                                        class="apexcharts-text apexcharts-datalabel-label"
                                                                        style="font-family: Helvetica, Arial, sans-serif;"></text>
                                                                    <text id="SvgjsText1571" font-family="Public Sans"
                                                                        x="46" y="50.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="15px"
                                                                        font-weight="500" fill="#cfcce4"
                                                                        class="apexcharts-text apexcharts-datalabel-value"
                                                                        style="font-family: &quot;Public Sans&quot;;">72%</text>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1574" x1="0" y1="0" x2="92" y2="0"
                                                        stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                                        stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1575" x1="0" y1="0" x2="92" y2="0"
                                                        stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                </g>
                                                <g id="SvgjsG1559" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend"></div>
                                        </div>
                                    </div>
                                    <div class="row w-100 align-items-center">
                                        <div class="col-9">
                                            <div class="me-2">
                                                <h6 class="mb-2">User experience Design</h6>
                                                <small>120 Tasks</small>
                                            </div>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-label-secondary waves-effect">
                                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 411px; height: 64px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3" style="position: relative;">
                                    <div class="chart-progress me-4" data-color="success" data-series="48"
                                        data-progress_variant="true" style="min-height: 62.7px;">
                                        <div id="apexcharts7z3twoojh"
                                            class="apexcharts-canvas apexcharts7z3twoojh apexcharts-theme-light"
                                            style="width: 58px; height: 62.7px;">
                                            <svg id="SvgjsSvg1576" width="58" height="62.7"
                                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1578" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(-18, -12)">
                                                    <defs id="SvgjsDefs1577">
                                                        <clipPath id="gridRectMask7z3twoojh">
                                                            <rect id="SvgjsRect1580" width="98" height="91" x="-3"
                                                                y="-1" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMask7z3twoojh"></clipPath>
                                                        <clipPath id="nonForecastMask7z3twoojh"></clipPath>
                                                        <clipPath id="gridRectMarkerMask7z3twoojh">
                                                            <rect id="SvgjsRect1581" width="96" height="93" x="-2"
                                                                y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g id="SvgjsG1582" class="apexcharts-radialbar">
                                                        <g id="SvgjsG1583">
                                                            <g id="SvgjsG1584" class="apexcharts-tracks">
                                                                <g id="SvgjsG1585"
                                                                    class="apexcharts-radialbar-track apexcharts-track"
                                                                    rel="1">
                                                                    <path id="apexcharts-radialbarTrack-0"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676"
                                                                        fill="none" fill-opacity="1" stroke="#a8aaae29"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="4.223048780487806"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1587">
                                                                <g id="SvgjsG1592"
                                                                    class="apexcharts-series apexcharts-radial-series"
                                                                    seriesName="" rel="1" data:realIndex="0">
                                                                    <path id="SvgjsPath1593"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 0 1 49.154483919236895 70.19120983974031"
                                                                        fill="none" fill-opacity="0.85"
                                                                        stroke="rgba(40,199,111,0.85)"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="4.3536585365853675"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                        data:angle="173" data:value="48" index="0" j="0"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 0 1 49.154483919236895 70.19120983974031">
                                                                    </path>
                                                                </g>
                                                                <circle id="SvgjsCircle1588" r="18.772621951219513"
                                                                    cx="46" cy="44.5"
                                                                    class="apexcharts-radialbar-hollow"
                                                                    fill="transparent"></circle>
                                                                <g id="SvgjsG1589" class="apexcharts-datalabels-group"
                                                                    transform="translate(0, 0) scale(1)"
                                                                    style="opacity: 1;">
                                                                    <text id="SvgjsText1590"
                                                                        font-family="Helvetica, Arial, sans-serif"
                                                                        x="46" y="44.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="16px"
                                                                        font-weight="500" fill="#28c76f"
                                                                        class="apexcharts-text apexcharts-datalabel-label"
                                                                        style="font-family: Helvetica, Arial, sans-serif;"></text>
                                                                    <text id="SvgjsText1591" font-family="Public Sans"
                                                                        x="46" y="50.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="15px"
                                                                        font-weight="500" fill="#cfcce4"
                                                                        class="apexcharts-text apexcharts-datalabel-value"
                                                                        style="font-family: &quot;Public Sans&quot;;">48%</text>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1594" x1="0" y1="0" x2="92" y2="0"
                                                        stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                                        stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1595" x1="0" y1="0" x2="92" y2="0"
                                                        stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                </g>
                                                <g id="SvgjsG1579" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend"></div>
                                        </div>
                                    </div>
                                    <div class="row w-100 align-items-center">
                                        <div class="col-9">
                                            <div class="me-2">
                                                <h6 class="mb-2">Basic fundamentals</h6>
                                                <small>32 Tasks</small>
                                            </div>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-label-secondary waves-effect">
                                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 411px; height: 64px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3" style="position: relative;">
                                    <div class="chart-progress me-4" data-color="danger" data-series="15"
                                        data-progress_variant="true" style="min-height: 62.7px;">
                                        <div id="apexcharts6stg10fej"
                                            class="apexcharts-canvas apexcharts6stg10fej apexcharts-theme-light"
                                            style="width: 58px; height: 62.7px;">
                                            <svg id="SvgjsSvg1596" width="58" height="62.7"
                                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1598" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(-18, -12)">
                                                    <defs id="SvgjsDefs1597">
                                                        <clipPath id="gridRectMask6stg10fej">
                                                            <rect id="SvgjsRect1600" width="98" height="91" x="-3"
                                                                y="-1" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMask6stg10fej"></clipPath>
                                                        <clipPath id="nonForecastMask6stg10fej"></clipPath>
                                                        <clipPath id="gridRectMarkerMask6stg10fej">
                                                            <rect id="SvgjsRect1601" width="96" height="93" x="-2"
                                                                y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g id="SvgjsG1602" class="apexcharts-radialbar">
                                                        <g id="SvgjsG1603">
                                                            <g id="SvgjsG1604" class="apexcharts-tracks">
                                                                <g id="SvgjsG1605"
                                                                    class="apexcharts-radialbar-track apexcharts-track"
                                                                    rel="1">
                                                                    <path id="apexcharts-radialbarTrack-0"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676"
                                                                        fill="none" fill-opacity="1" stroke="#a8aaae29"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="4.223048780487806"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1607">
                                                                <g id="SvgjsG1612"
                                                                    class="apexcharts-series apexcharts-radial-series"
                                                                    seriesName="" rel="1" data:realIndex="0">
                                                                    <path id="SvgjsPath1613"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 0 1 66.94071427513202 29.28568051230763"
                                                                        fill="none" fill-opacity="0.85"
                                                                        stroke="rgba(255,76,81,0.85)" stroke-opacity="1"
                                                                        stroke-linecap="round"
                                                                        stroke-width="4.3536585365853675"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                        data:angle="54" data:value="15" index="0" j="0"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 0 1 66.94071427513202 29.28568051230763">
                                                                    </path>
                                                                </g>
                                                                <circle id="SvgjsCircle1608" r="18.772621951219513"
                                                                    cx="46" cy="44.5"
                                                                    class="apexcharts-radialbar-hollow"
                                                                    fill="transparent"></circle>
                                                                <g id="SvgjsG1609" class="apexcharts-datalabels-group"
                                                                    transform="translate(0, 0) scale(1)"
                                                                    style="opacity: 1;">
                                                                    <text id="SvgjsText1610"
                                                                        font-family="Helvetica, Arial, sans-serif"
                                                                        x="46" y="44.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="16px"
                                                                        font-weight="500" fill="#ff4c51"
                                                                        class="apexcharts-text apexcharts-datalabel-label"
                                                                        style="font-family: Helvetica, Arial, sans-serif;"></text>
                                                                    <text id="SvgjsText1611" font-family="Public Sans"
                                                                        x="46" y="50.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="15px"
                                                                        font-weight="500" fill="#cfcce4"
                                                                        class="apexcharts-text apexcharts-datalabel-value"
                                                                        style="font-family: &quot;Public Sans&quot;;">15%</text>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1614" x1="0" y1="0" x2="92" y2="0"
                                                        stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                                        stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1615" x1="0" y1="0" x2="92" y2="0"
                                                        stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                </g>
                                                <g id="SvgjsG1599" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend"></div>
                                        </div>
                                    </div>
                                    <div class="row w-100 align-items-center">
                                        <div class="col-9">
                                            <div class="me-2">
                                                <h6 class="mb-2">React native components</h6>
                                                <small>182 Tasks</small>
                                            </div>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-label-secondary waves-effect">
                                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 411px; height: 64px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </li>
                                <li class="d-flex" style="position: relative;">
                                    <div class="chart-progress me-4" data-color="info" data-series="24"
                                        data-progress_variant="true" style="min-height: 62.7px;">
                                        <div id="apexchartsuv15qqk2"
                                            class="apexcharts-canvas apexchartsuv15qqk2 apexcharts-theme-light"
                                            style="width: 58px; height: 62.7px;">
                                            <svg id="SvgjsSvg1616" width="58" height="62.7"
                                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1618" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(-18, -12)">
                                                    <defs id="SvgjsDefs1617">
                                                        <clipPath id="gridRectMaskuv15qqk2">
                                                            <rect id="SvgjsRect1620" width="98" height="91" x="-3"
                                                                y="-1" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMaskuv15qqk2"></clipPath>
                                                        <clipPath id="nonForecastMaskuv15qqk2"></clipPath>
                                                        <clipPath id="gridRectMarkerMaskuv15qqk2">
                                                            <rect id="SvgjsRect1621" width="96" height="93" x="-2"
                                                                y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g id="SvgjsG1622" class="apexcharts-radialbar">
                                                        <g id="SvgjsG1623">
                                                            <g id="SvgjsG1624" class="apexcharts-tracks">
                                                                <g id="SvgjsG1625"
                                                                    class="apexcharts-radialbar-track apexcharts-track"
                                                                    rel="1">
                                                                    <path id="apexcharts-radialbarTrack-0"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676"
                                                                        fill="none" fill-opacity="1" stroke="#a8aaae29"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="4.223048780487806"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 1 1 45.99548236424567 18.615854052774676">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1627">
                                                                <g id="SvgjsG1632"
                                                                    class="apexcharts-series apexcharts-radial-series"
                                                                    seriesName="" rel="1" data:realIndex="0">
                                                                    <path id="SvgjsPath1633"
                                                                        d="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 0 1 71.82109386190825 42.69441322534261"
                                                                        fill="none" fill-opacity="0.85"
                                                                        stroke="rgba(0,186,209,0.85)" stroke-opacity="1"
                                                                        stroke-linecap="round"
                                                                        stroke-width="4.3536585365853675"
                                                                        stroke-dasharray="0"
                                                                        class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                        data:angle="86" data:value="24" index="0" j="0"
                                                                        data:pathOrig="M 46 18.615853658536583 A 25.884146341463417 25.884146341463417 0 0 1 71.82109386190825 42.69441322534261">
                                                                    </path>
                                                                </g>
                                                                <circle id="SvgjsCircle1628" r="18.772621951219513"
                                                                    cx="46" cy="44.5"
                                                                    class="apexcharts-radialbar-hollow"
                                                                    fill="transparent"></circle>
                                                                <g id="SvgjsG1629" class="apexcharts-datalabels-group"
                                                                    transform="translate(0, 0) scale(1)"
                                                                    style="opacity: 1;">
                                                                    <text id="SvgjsText1630"
                                                                        font-family="Helvetica, Arial, sans-serif"
                                                                        x="46" y="44.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="16px"
                                                                        font-weight="500" fill="#00bad1"
                                                                        class="apexcharts-text apexcharts-datalabel-label"
                                                                        style="font-family: Helvetica, Arial, sans-serif;"></text>
                                                                    <text id="SvgjsText1631" font-family="Public Sans"
                                                                        x="46" y="50.5" text-anchor="middle"
                                                                        dominant-baseline="auto" font-size="15px"
                                                                        font-weight="500" fill="#cfcce4"
                                                                        class="apexcharts-text apexcharts-datalabel-value"
                                                                        style="font-family: &quot;Public Sans&quot;;">24%</text>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1634" x1="0" y1="0" x2="92" y2="0"
                                                        stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                                        stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1635" x1="0" y1="0" x2="92" y2="0"
                                                        stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                </g>
                                                <g id="SvgjsG1619" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend"></div>
                                        </div>
                                    </div>
                                    <div class="row w-100 align-items-center">
                                        <div class="col-9">
                                            <div class="me-2">
                                                <h6 class="mb-2">Basic of music theory</h6>
                                                <small>56 Tasks</small>
                                            </div>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-label-secondary waves-effect">
                                                <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 411px; height: 64px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            {{-- third row --}}
            <div class="row mb-2">

                <div class="col-lg-8 col-xxl-8 mb-4 order-1 order-xxl-1">
                    <div class="card">

                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">{{__('site.Money Flow statistics For the Past 10 days')}}</h5>
                                <small class="text-muted"></small>
                            </div>

                            {{-- <div class="dropdown">
                                <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect"
                                    data-bs-toggle="dropdown" aria-expanded="false"> January </button>
                                <ul class="dropdown-menu" style="">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">January</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">February</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">March</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">April</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">May</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">June</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">July</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">August</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">September</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">October</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">November</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">December</a>
                                    </li>
                                </ul>
                            </div> --}}

                        </div>

                        <div class="card-body" style="position: relative;">
                            <div id="shipmentStatisticsChart" style="min-height: 415px;"></div>

                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 875px; height: 440px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-xxl-4 mb-4 order-2 order-xxl-2">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Items Tracker</h5>
                                <small class="text-muted">Most Purchased Items</small>
                            </div>
                        </div>

                        <div class="card-body" style="position: relative;">
                            <div id="donutChart" style="min-height: 357.3px;"></div>

                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 471px; height: 382px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            {{-- fourth row --}}
            {{-- <div class="row mb-4">

                <!-- Card for Most Category Case -->
                <div class="col-8 col-xl-8">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">@lang("site.most category case")</h5>
                        </div>
                        <div class="card-body row g-6">
                            <div class="col-md-6">
                                <div id="horizontalBarChart"></div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-around align-items-center">
                                @foreach ($topCategories->chunk(3) as $categoryPair)
                                <div>
                                    @foreach ($categoryPair as $category)
                                    <div class="d-flex align-items-baseline">
                                        <span class="text-{{ $category['color'] }} me-2">
                                            <i class="ti ti-circle-filled fs-6"></i>
                                        </span>
                                        <div>
                                            <p class="mb-2">{{ $category['name'] }}</p>
                                            <h5>{{ number_format($category['percentage'], 2) }}%</h5>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div> --}}

            {{-- fifth row --}}
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">@lang('site.donations')</h5>
                                <small class="text-muted">@lang('site.digram_donation_for_year')</small>
                            </div>
                            <div class="d-sm-flex d-none align-items-center">
                                <h5 class="mb-0 me-3">egp {{ $total_price_doner }}</h5>

                            </div>
                        </div>

                        <div class="card-body" style="position: relative;">
                            <div id="lineChart" style="min-height: 400px;"></div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 943px; height: 425px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var topCategories = @json($topCategories);
</script>
{{-- <script src="{{asset(" admin/assets/vendor/libs/apex-charts/apexcharts.js")}}"></script> --}}

<script>
    let donationsPerMonth = @json($donationsPerMonth);
    let donationsPer10Days = @json($tansfersToDonations['donationsPast10Days']);
    let transfersPer10Days = @json($tansfersToDonations['transfersPast10Days']);
    let doneCases = @json($done_cases->count());
    let totalCases = @json($total_cases->count());

        'use strict';
        (function () {
            let cardColor, headingColor, legendColor, labelColor, borderColor;
            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                labelColor = config.colors_dark.textMuted;
                legendColor = config.colors_dark.bodyColor;
                headingColor = config.colors_dark.headingColor;
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                labelColor = config.colors.textMuted;
                legendColor = config.colors.bodyColor;
                headingColor = config.colors.headingColor;
                borderColor = config.colors.borderColor;
            }

            // Chart Colors
            const chartColors = {
                donut: {
                    series1: config.colors.success,
                    series2: '#4fddaa',
                    series3: '#8ae8c7',
                    series4: '#c4f4e3'
                },
                bar: {
                    series1: config.colors.primary,
                    series2: '#7367F0CC',
                    series3: '#7367f099'
                },
                line: {
                series1: config.colors.warning,
                series2: config.colors.primary,
                series3: '#7367f029'
                }
            };

            // datatbale bar chart
            const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
                horizontalBarChartConfig = {
                    chart: {
                        height: 270,
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            barHeight: '70%',
                            distributed: true,
                            startingShape: 'rounded',
                            borderRadius: 7
                        }
                    },
                    grid: {
                        strokeDashArray: 10,
                        borderColor: borderColor,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: -35,
                            bottom: -12
                        }
                    },

                    colors: [
                        config.colors.primary,
                        config.colors.info,
                        config.colors.success,
                        config.colors.secondary,
                        config.colors.danger,
                        config.colors.warning
                    ],
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#fff'],
                            fontWeight: 200,
                            fontSize: '13px',
                            fontFamily: 'Public Sans'
                        },
                        formatter: function(val, opts) {
                            return horizontalBarChartConfig.labels[opts.dataPointIndex];
                        },
                        offsetX: 0,
                        dropShadow: {
                            enabled: false
                        }
                    },
                    labels: topCategories.map(category => category.name),

                    series: [{
                        data: topCategories.map(category => category.percentage)
                    }],

                    xaxis: {
                        categories: ['6', '5', '4', '3', '2', '1'],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '13px'
                            },
                            formatter: function(val) {
                                return `${val}%`;
                            }
                        }
                    },
                    yaxis: {
                        max: 35,
                        labels: {
                            style: {
                                colors: [labelColor],
                                fontFamily: 'Public Sans',
                                fontSize: '13px'
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        style: {
                            fontSize: '12px'
                        },
                        onDatasetHover: {
                            highlightDataSeries: false
                        },
                        custom: function({ series, seriesIndex, dataPointIndex, w }) {
                            return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '%</span>' + '</div>';
                        }
                    },
                    legend: {
                        show: false
                    }
                };
            if (typeof horizontalBarChartEl !== undefined && horizontalBarChartEl !== null) {
                const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
                horizontalBarChart.render();
            }

            // Shipment statistics Chart
            // --------------------------------------------------------------------
            const shipmentEl = document.querySelector('#shipmentStatisticsChart'),
                shipmentConfig = {
                series: [
                    {
                        name: 'Donations',
                        type: 'column',
                        data: donationsPer10Days
                    },
                    {
                        name: 'Transfers',
                        type: 'line',
                        data: transfersPer10Days
                    }
                ],
                chart: {
                    height: 380,
                    type: 'line',
                    stacked: false,
                    parentHeightOffset: 0,
                    toolbar: {
                    show: false
                    },
                    zoom: {
                    enabled: false
                    }
                },
                markers: {
                    size: 4,
                    colors: [config.colors.white],
                    strokeColors: chartColors.line.series2,
                    hover: {
                    size: 6
                    },
                    borderRadius: 4
                },
                stroke: {
                    curve: 'smooth',
                    width: [0, 3],
                    lineCap: 'round'
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    markers: {
                        width: 8,
                        height: 8,
                        offsetX: -3
                    },
                    height: 40,
                    offsetY: 10,
                    itemMargin: {
                        horizontal: 10,
                        vertical: 0
                    },
                    fontSize: '15px',
                    fontFamily: 'Public Sans',
                    fontWeight: 400,
                    labels: {
                    colors: headingColor,
                        useSeriesColors: false
                    },
                    offsetY: 10
                },
                grid: {
                    strokeDashArray: 8
                },
                colors: [chartColors.line.series1, chartColors.line.series2],
                fill: {
                    opacity: [1, 1]
                },
                plotOptions: {
                    bar: {
                    columnWidth: '30%',
                    startingShape: 'rounded',
                    endingShape: 'rounded',
                    borderRadius: 4
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    tickAmount: 10,
                    categories: @php
                        $categories = [];
                        for ($i = 9; $i >= 0; $i--) {
                            $date = date('d M', strtotime('-' . $i . ' days'));
                            $categories[] = $i < 10 ? ltrim($date, '0') : $date;
                        }
                        echo json_encode($categories);
                    @endphp,
                    labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '13px',
                        fontFamily: 'Public Sans',
                        fontWeight: 400
                    }
                    },
                    axisBorder: {
                    show: false
                    },
                    axisTicks: {
                    show: false
                    }
                },
                yaxis: {
                    tickAmount: 4,
                    min: 0,
                    max: {{$tansfersToDonations['maxDonationsPast10Days']}},
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '13px',
                            fontFamily: 'Public Sans',
                            fontWeight: 400
                        },
                        formatter: function (val) {
                            return val + 'egp';
                        }
                    }
                },
                responsive: [
                    {
                    breakpoint: 1400,
                    options: {
                        chart: {
                        height: 270
                        },
                        xaxis: {
                        labels: {
                            style: {
                            fontSize: '10px'
                            }
                        }
                        },
                        legend: {
                        itemMargin: {
                            vertical: 0,
                            horizontal: 10
                        },
                        fontSize: '13px',
                        offsetY: 12
                        }
                    }
                    },
                    {
                    breakpoint: 1399,
                    options: {
                        chart: {
                        height: 415
                        },
                        plotOptions: {
                        bar: {
                            columnWidth: '50%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 982,
                    options: {
                        plotOptions: {
                        bar: {
                            columnWidth: '30%'
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 480,
                    options: {
                        chart: {
                        height: 250
                        },
                        legend: {
                        offsetY: 7
                        }
                    }
                    }
                ]
                };
            if (typeof shipmentEl !== undefined && shipmentEl !== null) {
                const shipment = new ApexCharts(shipmentEl, shipmentConfig);
                shipment.render();
            }

             // Support Tracker - Radial Bar Chart
            // --------------------------------------------------------------------
            const supportTrackerEl = document.querySelector('#supportTracker'),
                supportTrackerOptions = {
                series: [doneCases / totalCases !== 0 ? Math.round((doneCases / totalCases) * 100) : 0],
                labels: ['{{__('site.done_cases')}}'],
                chart: {
                    height: 360,
                    type: 'radialBar'
                },
                plotOptions: {
                    radialBar: {
                    offsetY: 10,
                    startAngle: -140,
                    endAngle: 130,
                    hollow: {
                        size: '65%'
                    },
                    track: {
                        background: cardColor,
                        strokeWidth: '100%'
                    },
                    dataLabels: {
                        name: {
                        offsetY: -20,
                        color: labelColor,
                        fontSize: '13px',
                        fontWeight: '400',
                        fontFamily: 'Public Sans'
                        },
                        value: {
                        offsetY: 10,
                        color: headingColor,
                        fontSize: '38px',
                        fontWeight: '500',
                        fontFamily: 'Public Sans'
                        }
                    }
                    }
                },
                colors: [config.colors.primary],
                fill: {
                    type: 'gradient',
                    gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100]
                    }
                },
                stroke: {
                    dashArray: 10
                },
                grid: {
                    padding: {
                    top: -20,
                    bottom: 5
                    }
                },
                states: {
                    hover: {
                    filter: {
                        type: 'none'
                    }
                    },
                    active: {
                    filter: {
                        type: 'none'
                    }
                    }
                },
                responsive: [
                    {
                    breakpoint: 1025,
                    options: {
                        chart: {
                        height: 330
                        }
                    }
                    },
                    {
                    breakpoint: 769,
                    options: {
                        chart: {
                        height: 280
                        }
                    }
                    }
                ]
                };
            if (typeof supportTrackerEl !== undefined && supportTrackerEl !== null) {
                const supportTracker = new ApexCharts(supportTrackerEl, supportTrackerOptions);
                supportTracker.render();
            }


            const lineChartEl = document.querySelector('#lineChart'),
            lineChartConfig = {
                chart: {
                    height: 400,
                    type: 'line',
                    parentHeightOffset: 0,
                    zoom: {
                    enabled: false
                    },
                    toolbar: {
                    show: false
                    }
                },
                series: [
                    {
                        data:donationsPerMonth
                    }
                ],
                markers: {
                    strokeWidth: 7,
                    strokeOpacity: 1,
                    strokeColors: [cardColor],
                    colors: [config.colors.warning]
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                colors: [config.colors.warning],
                grid: {
                    borderColor: borderColor,
                    xaxis: {
                    lines: {
                        show: true
                    }
                    },
                    padding: {
                    top: -20
                    }
                },
                tooltip: {
                    custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                    return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + 'EGP</span>' + '</div>';
                    }
                },
                xaxis: {
                    categories: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
                    axisBorder: {
                    show: false
                    },
                    axisTicks: {
                    show: false
                    },
                    labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '13px'
                    }
                    }
                },
                yaxis: {
                    labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '13px'
                    }
                    }
                }
            };
            const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
            lineChart.render();

            // Donut Chart
            // --------------------------------------------------------------------
            const donutChartEl = document.querySelector('#donutChart'),
                donutChartConfig = {
                chart: {
                    height: 390,
                    type: 'donut'
                },
                labels: ['Operational', 'Networking', 'Hiring', 'R&D'],
                series: [42, 7, 25, 25],
                colors: [
                    chartColors.donut.series1,
                    chartColors.donut.series4,
                    chartColors.donut.series3,
                    chartColors.donut.series2
                ],
                stroke: {
                    show: false,
                    curve: 'straight'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val, opt) {
                    return parseInt(val, 10) + '%';
                    }
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    markers: { offsetX: -3 },
                    itemMargin: {
                    vertical: 3,
                    horizontal: 10
                    },
                    labels: {
                    colors: legendColor,
                    useSeriesColors: false
                    }
                },
                plotOptions: {
                    pie: {
                    donut: {
                        labels: {
                        show: true,
                        name: {
                            fontSize: '2rem',
                            fontFamily: 'Public Sans'
                        },
                        value: {
                            fontSize: '1.2rem',
                            color: legendColor,
                            fontFamily: 'Public Sans',
                            formatter: function (val) {
                            return parseInt(val, 10) + '%';
                            }
                        },
                        total: {
                            show: true,
                            fontSize: '1.5rem',
                            color: headingColor,
                            label: 'Operational',
                            formatter: function (w) {
                            return '42%';
                            }
                        }
                        }
                    }
                    }
                },
                responsive: [
                    {
                    breakpoint: 992,
                    options: {
                        chart: {
                        height: 380
                        },
                        legend: {
                        position: 'bottom',
                        labels: {
                            colors: legendColor,
                            useSeriesColors: false
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 576,
                    options: {
                        chart: {
                        height: 320
                        },
                        plotOptions: {
                        pie: {
                            donut: {
                            labels: {
                                show: true,
                                name: {
                                fontSize: '1.5rem'
                                },
                                value: {
                                fontSize: '1rem'
                                },
                                total: {
                                fontSize: '1.5rem'
                                }
                            }
                            }
                        }
                        },
                        legend: {
                        position: 'bottom',
                        labels: {
                            colors: legendColor,
                            useSeriesColors: false
                        }
                        }
                    }
                    },
                    {
                    breakpoint: 420,
                    options: {
                        chart: {
                        height: 280
                        },
                        legend: {
                        show: false
                        }
                    }
                    },
                    {
                    breakpoint: 360,
                    options: {
                        chart: {
                        height: 250
                        },
                        legend: {
                        show: false
                        }
                    }
                    }
                ]
                };
            if (typeof donutChartEl !== undefined && donutChartEl !== null) {
                const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
                donutChart.render();
            }

        })();
</script>
<script src={{ url("js/flashMessage.js")}}></script>


@endsection