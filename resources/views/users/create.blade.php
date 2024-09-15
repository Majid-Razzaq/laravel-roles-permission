<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User / Create
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm text-white rounded-md px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-lg font-medium">Name: </label>
                            <div class="my-3">
                                <input value="{{ old('name') }}" placeholder="Enter Name" name="name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg" >
                                @error('name')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">Email: </label>
                            <div class="my-3">
                                <input value="{{ old('email') }}" placeholder="Enter Email" name="email" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg" >
                                @error('email')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">Password: </label>
                            <div class="my-3">
                                <input value="{{ old('password') }}" placeholder="Enter Password" name="password" type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg" >
                                @error('password')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            <label for="" class="text-lg font-medium">Confirm Password: </label>
                            <div class="my-3">
                                <input value="{{ old('confirm_password') }}" placeholder="Confirm your Password" name="confirm_password" type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg" >
                                @error('confirm_password')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-4 mb-3">
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                    <div class="mt-3">
                                        <input  type="checkbox" class="rounded" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}">
                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                    @endforeach
                                @endif
                            </div>


                            <button class="bg-slate-700 hover:bg-slate-600 text-sm text-white rounded-md px-5 py-3">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
