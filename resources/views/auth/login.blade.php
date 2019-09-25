@extends('layouts.auth')

@section('content')
<div class="mt-20">
    <div class="w-224 border border-gray-500 rounded mx-auto flex h-96">
        <div class="w-96 bg-indigo-500 py-4 px-8">
            <h1 class="text-4xl  font-light text-white uppercase">Welcome</h1>
            <div class="text-white mt-20">
                <h1 class="text-2xl font-semibold">WoolHouse Reports</h1>
                <p>Sales Report Generator</p>
            </div>
        </div>
        <div class="flex-1 px-8 py-4">
            <div class="text-center mb-10 mt-5 flex justify-center items-center text-indigo-500">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-circle" 
                    class="w-12 h-12" role="img" xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 496 512">
                    <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 
                    8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 
                    18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 
                    40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"></path>
                </svg>
                <h1 class="text-3xl ml-2">Login To Get Started</h1>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-5">
                    <div class="flex items-center py-2 px-4 border border-gray-300 bg-gray-100 rounded-full">
                        <div class="mr-2 text-gray-500">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" 
                                class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 
                                0-48-21.5-48-48V195.6c0-5 5.7-7.8 
                                9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 
                                154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 
                                9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 
                                64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <input id="email" type="email" class="bg-gray-100 w-full focus:outline-none" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                                placeholder="E-Mail Address">
                        </div>
                    </div>
                </div>
                
                <div class="mb-2">
                    <div class="flex items-center py-2 px-4 border border-gray-300 bg-gray-100 rounded-full">
                        <div class="mr-2 text-gray-500">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock" 
                                class="h-5 w-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 
                                26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 
                                32.3-72 72-72s72 32.3 72 72v72z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <input id="password" type="password" class="bg-gray-100 w-full focus:outline-none" 
                            name="password" required autocomplete="current-password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="text-xs text-red-700 h-3 px-4 mb-2 font-semibold" role="alert">
                        @error('email')
                        {{ $message }}
                        @enderror
                </div>
    
                <div class="mb-5">
                    <div class="px-4 flex items-center">
                        <input class="mr-1 border border-gray-300 bg-white" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="text-sm text-gray-800" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
    
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="px-4 py-2 bg-indigo-700 shadow text-gray-100 rounded-full w-full shadow-lg uppercase">
                        {{ __('Login') }}
                    </button>

                    {{-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
