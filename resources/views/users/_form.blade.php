
    @csrf
    <h1 class="mb-2 text-lg font-light" >Enter User Information</h1>
    <div class="border border-gray-700">
        <div class="flex">
            <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                <label  class="text-sm font-semibold text-gray-800 uppercase" for="name">Name</label>
            </div>
            <div  class="flex-1 border-b border-gray-700" >
                <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm  @error('name') bg-red-200 @enderror"
                    type="text" id="name" name="name" placeholder=" Enter User's Name" 
                    value="{{ old('name', $user->name) }}" >
            </div>
        </div>
        <div class="flex">
            <div class="border-r py-2  border-gray-700 w-48 text-center @if($new) border-b @endif">
                <label  class="text-sm font-semibold text-gray-800 uppercase" for="email">E-Mail Address</label>
            </div>
            <div  class="flex-1 border-gray-700 @if($new) border-b @endif" >
                <input class="w-full focus:outline-none py-3 pl-10 text-gray-800 text-sm @error('email') bg-red-200 @enderror"
                    type="text" id="email" name="email" placeholder="user@email.com" 
                    value="{{ old('email', $user->email) }}" >
            </div>
        </div>
        @if ($new)
            <div class="flex">
                <div class="border-r border-b py-2  border-gray-700 w-48 text-center">
                    <label  class="text-sm font-semibold text-gray-800 uppercase" for="password">Password</label>
                </div>
                <div  class="flex-1 border-b border-gray-700" >
                    <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm @error('password') bg-red-200 @enderror" 
                        type="password" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="flex">
                <div class="border-r py-2  border-gray-700 w-48 text-center">
                    <label  class="text-sm font-semibold text-gray-800 uppercase" for="password-confirm">Confirm Password</label>
                </div>
                <div  class="flex-1 border-gray-700" >
                    <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm @error('password') bg-red-200 @enderror" 
                        type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password">
                </div>
            </div>
        @endif
    </div>
    <button type="submit"
            class="flex items-center w-full mt-5 py-2 px-4 text-white 
                        rounded-full justify-center focus:outline-none bg-indigo-600 hover:bg-indigo-700">
        Submit 
    </button>

    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
    @enderror