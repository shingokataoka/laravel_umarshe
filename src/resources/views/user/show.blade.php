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
                                        if (empty($filename)) { $imageSrc = ''; }
                                        else {
                                            $imageSrc = asset('storage/products/' . $filename);
                                        }
                                    @endphp
                                    <div class="swiper-slide">
                                        <img src="{{ $imageSrc }}" alt="" class="pb-8">
                                    </div>
                                @endforeach
                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                                <!-- If we need scrollbar -->
                                {{-- <div class="swiper-scrollbar"></div> --}}
                            </div>

                        </div>

                        <div class="md:w-1/2 ml-4">
                            <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">{{ $product->category->name }}</h2>
                            <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium">{{ $product->name }}</h1>
                            <p class="mb-4 leading-relaxed">{{ $product->information }}</p>

                            <form action="{{ route('user.cart.add') }}" method="post" class="flex justify-around items-center">
                                @csrf
                                <div>
                                    <span class="title-font font-medium text-2xl text-gray-900">
                                        {{ number_format($product->price) }}
                                    </span>
                                    <span class="text-sm text-gray-700">円（税込）</span>
                                </div>

                                <div class="flex items-center">
                                    <span class="mr-3">数量</span>
                                    <div class="">
                                        <select name="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                        @for ($i = 1; $i <= $quantity; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button class="flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                            </form>

                        </div>
                    </div>

                    <div class="border-t border-gray-400 my-8"></div>
                    <div class="mb-4 text-center">この商品を販売しているショップ</div>
                    <div class="mb-4 text-center">{{ $product->shop->name }}</div>
                    <div class="mb-4 text-center">
                        @php
                        if (empty($product->shop->filename)) { $shopImageSrc = ''; }
                        else {
                            $shopImageSrc = asset('storage/shops/' . $product->shop->filename);
                        }
                        @endphp
                        <img src="{{ $shopImageSrc }}" alt="" class="mx-auto w-40 h-40 object-cover rounded-full">
                    </div>
                    <div class="mb-4 text-center">
                        <button type="button" data-micromodal-trigger="modal-1" class="text-white bg-gray-400 border-0 py-2 px-6 focus:outline-none hover:bg-gray-500 rounded">ショップの詳細を見る</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ショップ詳細　モーダルウィンドウ mirco modal使用 --}}
    <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
              <h2 class="text-xl text-gray-700" id="modal-1-title">
                {{ $product->shop->name }}
              </h2>
              <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
              <p>{{ $product->shop->information }}</p>
            </main>
            <footer class="modal__footer">
              <button type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
            </footer>
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

        // microModalのjsソース
        'use strict';

        MicroModal.init({
            disableScroll: true
        });



        // swiperのjsソース
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
