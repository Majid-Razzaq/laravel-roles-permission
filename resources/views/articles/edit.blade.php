<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article / Edit
            </h2>
            <a href="{{ route('articles.index') }}" class="bg-slate-700 text-sm text-white rounded-md px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('articles.update', $article->id) }}" method="post">
                        @csrf
                        <div> 
                            <label for="" class="text-lg font-medium">Title: </label>
                            <div class="my-3">
                                <input value="{{ old('title',$article->title) }}" placeholder="Title" name="title" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg" >
                                @error('title')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <label for="" class="text-lg font-medium">Content: </label>
                            <div class="my-3">
                                <textarea name="text" placeholder="Content" id="text" cols="30" rows="10" class="border-gray-300 shadow-sm w-1/2 rounded-lg">{{ old('text',$article->text) }}</textarea>
                            </div>

                            <div class="my-3">
                                <input value="{{ old('author',$article->author) }}" placeholder="Author" name="author" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg" >
                                @error('author')
                                    <p class="text-red-400 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button class="bg-slate-700 text-sm text-white rounded-md px-5 py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
