@extends('dashboard')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily-Report</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('css/addDriver.css') }}" rel="stylesheet">
</head>
<body>
    @section('content')
<span class="title">Daily Driver's Report</span>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="infotable">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Pick Up
                </th>
                <th scope="col" class="px-6 py-3">
                    Destination
                </th>
                <th scope="col" class="px-6 py-3">
                    Fare
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $report)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                     {{$report->pickup}}
                </th>
                <td class="px-6 py-4">
                    {{$report->destination}}
                </td>
                <td class="px-6 py-4">
                    {{$report->fare}}
                </td>
            </tr>
            @endforeach
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th colspan="3" class="px-6 py-4 text-right">
                    Total fare : Nu. {{$totalfare}} /-
                </th>
            </tr>
        </tbody>
    </table>
</div>
@endsection
</body>
</html>