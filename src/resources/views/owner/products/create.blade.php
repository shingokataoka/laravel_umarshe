<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品の登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mx-auto w-1/2">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    </div>

                    <form action="{{ route('owner.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="-m-2">

                            {{-- カテゴリ一覧 --}}
                            <div class="p-2 w-1/2  mx-auto">
                                <select name="category">
                                @foreach ($categories as $category)
                                    <optgroup label="{{ $category->name }}">
                                    @foreach ($category->secondaries as $secondary)
                                        <option value="{{ $secondary->id }}">
                                            {{ $secondary->name }}
                                        </option>
                                    @endforeach
                                    </optgroup>
                                @endforeach
                                </select>
                            </div>

                            {{-- 戻るボタン、登録するボタン --}}
                            <div class="p-2 w-full mt-4 flex justify-around">
                                <button type="button" onclick="location.href='{{ route('owner.products.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>