@extends('layouts.app')

@section('content')
<div class="flex content-center flex-wrap bg-gray-200 h-24 border-b border-gray-300">
    <div class="px-4 py-2">
        <h1 class="text-4xl font-bold uppercase text-gray-800" >Home Page</h1>
    </div>
</div>
<div class="mt-10 px-10 flex flex-wrap w-256 mx-auto">
    <a href="{{ route('sales.create')}}"  class="p-10 border border-gray-400 rounded w-64 m-5">
        <div class="w-32 h-32 mx-auto text-white bg-green-700 p-8 rounded-full">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-invoice-dollar" 
                class="w-full h-full" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path fill="currentColor" d="M377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H24C10.7 0 0 10.7 0 
                24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zM64 72c0-4.42 3.58-8 
                8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8V72zm0 80v-16c0-4.42 3.58-8 
                8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8zm144 263.88V440c0 4.42-3.58 8-8 8h-16c-4.42 
                0-8-3.58-8-8v-24.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 
                10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 
                0-24.52 19.05-44.44 42.67-45.07V232c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v24.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 
                4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 
                0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07z"></path>
            </svg>
        </div>
        <div class="text-center mt-5">
           <h2 class="text-gray-800 font-bold text-lg" > Create Sales Report</h2>
        </div>
    </a>
    <a href="{{ route('summaries.create') }}" class="p-10 border border-gray-400 rounded w-64 m-5">
        <div class="w-32 h-32 mx-auto text-white bg-blue-700 p-8 rounded-full">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="scroll" 
                class="w-full h-full" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                <path fill="currentColor" d="M48 0C21.53 0 0 21.53 0 48v64c0 8.84 7.16 16 16 16h80V48C96 21.53 74.47 0 48 0zm208 
                412.57V352h288V96c0-52.94-43.06-96-96-96H111.59C121.74 13.41 128 29.92 128 48v368c0 38.87 34.65 69.65 74.75 63.12C234.22 474 
                256 444.46 256 412.57zM288 384v32c0 52.93-43.06 96-96 96h336c61.86 0 112-50.14 112-112 0-8.84-7.16-16-16-16H288z"></path>
            </svg>
        </div>
        <div class="text-center mt-5">
            <h2 class="text-gray-800 font-bold text-lg" > Create Summary Report</h2>
        </div>
    </a>
    <a href="{{ route('products.create') }} " class="p-10 border border-gray-400 rounded w-64 m-5">
        <div class="w-32 h-32 mx-auto text-white bg-orange-700 p-8 rounded-full">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-basket" 
                class="w-full h-full" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor" d="M576 216v16c0 13.255-10.745 24-24 24h-8l-26.113 182.788C514.509 462.435 494.257 480 470.37 
                480H105.63c-23.887 0-44.139-17.565-47.518-41.212L32 256h-8c-13.255 0-24-10.745-24-24v-16c0-13.255 10.745-24 
                24-24h67.341l106.78-146.821c10.395-14.292 30.407-17.453 44.701-7.058 14.293 10.395 17.453 30.408 7.058 44.701L170.477 
                192h235.046L326.12 82.821c-10.395-14.292-7.234-34.306 7.059-44.701 14.291-10.395 34.306-7.235 44.701 7.058L484.659 
                192H552c13.255 0 24 10.745 24 24zM312 392V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 
                24-24zm112 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm-224 0V280c0-13.255-10.745-24-24-24s-24 
                10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24z"></path>
            </svg>
        </div>
        <div class="text-center mt-5">
            <h2 class="text-gray-800 font-bold text-lg" > Add New Product</h2>
        </div>
    </a>
</div>
@endsection
