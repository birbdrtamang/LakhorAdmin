@extends('dashboard')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver-Reports</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('css/addDriver.css') }}" rel="stylesheet">

</head>
<body>
    @section('content')
        
    <span class="title">Driver Details</span>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" id="infotable">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contact No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($info as $info)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$info->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$info->cid}}
                    </td>
                    <td class="px-6 py-4">
                        {{$info->mobilenumber}}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('viewreport',['cid' => $info->cid])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View Report</a>
                    </td>
                </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>

    @endsection
</body>
</html>