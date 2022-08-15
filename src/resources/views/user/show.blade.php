<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品の詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex md:justify-around">

                        <div class="md:w-1/2">
                            {{-- カルーセル画像 --}}

                            {{-- swiper css --}}
                            <style>
                                .swiper {
                                /* width: 600px; */
                                }
                            </style>
                            <!-- Slider main container -->
                            <div class="swiper">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach ([
                                    $product->imageFirst->filename,
                                    $product->imageSecond->filename,
                                    $product->imageThird->filename,
                                    $product->imageForth->filename,
                                ] as $filename)
                                    @php
                                        if (empty($filename)) { $image = ''; }
                                        else {
                                            $image = asset('storage/products/' . $filename);
                                        }
                                    @endphp
                                    <div class="swiper-slide">
                                        <img src="{{ $image }}" alt="" class="pb-8">
                                    </div>
                                @endforeach
                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                                <!-- If we need scrollbar -->
                                <div class="swiper-scrollbar"></div>
                            </div>

                        </div>

                        <div class="md:w-1/2 ml-4">
                            <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">{{ $product->category->name }}</h2>
                            <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium">{{ $product->name }}</h1>
                            <p class="mb-4 leading-relaxed">{{ $product->information }}</p>
                            <div class="flex justify-around items-center">
                                <div>
                                    <span class="title-font font-medium text-2xl text-gray-900">
                                        {{ number_format($product->price) }}
                                    </span>
                                    <span class="text-sm text-gray-700">円（税込）</span>
                                </div>

                                <div class="flex items-center">
                                    <span class="mr-3">数量</span>
                                    <div class="">
                                      <select class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                        <option>SM</option>
                                        <option>M</option>
                                        <option>L</option>
                                        <option>XL</option>
                                      </select>
                                    </div>
                                  </div>

                                <button class="flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        {{-- swiper --}}
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper('.swiper', {
        // Optional parameters
        // direction: 'vertical',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        });
    </script>
</x-app-layout>
