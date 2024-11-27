<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ユーザー情報編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="lg:px-8 max-w-7xl sm:px-6 mx-auto bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- 成功メッセージの表示 -->
                @if(session('success'))
                    <div class="text-lg bg-green-500 text-white p-4 mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="p-6 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                    <!-- 編集フォーム -->
                    <form action="{{ route('customer.update', ['id' => $customer->id]) }}" method="POST" class="lg:px-8 max-w-7xl sm:px-6 mx-auto dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        @csrf
                        @method('PUT')

                        <!-- 名前 -->
                        <label for="name" class="text-white text-xl block text-gray-700 text-sm font-bold mb-2">名前</label>
                        <input type="text" name="name" placeholder="名前" class="w-full mb-7 bg-transparent border border-gray-300 rounded-md p-2 text-white" value="{{ old('name', $customer->name) }}" required><br>
                        @error('name')
                            <p class="text-red-500 text-lg italic">{{ $message }}</p>
                        @enderror

                        <!-- メールアドレス -->
                        <label for="email" class="text-white text-xl block text-gray-700 text-sm font-bold mb-2">メールアドレス</label>
                        <input type="email" name="email" placeholder="メールアドレス" class="w-full mb-7 bg-transparent border border-gray-300 rounded-md p-2 text-white" value="{{ old('email', $customer->email) }}" required><br>
                        @error('email')
                            <p class="text-red-500 text-lg italic">{{ $message }}</p>
                        @enderror

                        <!-- パスワード -->
                        <label for="password" class="text-white text-xl block text-gray-700 text-sm font-bold mb-2">パスワード</label>
                        <input type="password" name="password" placeholder="パスワード" class="w-full mb-7 bg-transparent border border-gray-300 rounded-md p-2 text-white" required><br>
                        @error('password')
                            <p class="text-red-500 text-lg italic">{{ $message }}</p>
                        @enderror
                        <label for="password_confirmation" class="text-white text-xl block text-gray-700 text-sm font-bold mb-2">パスワード(確認用)</label>
                        <input type="password" name="password_confirmation" placeholder="半角英数字のみ" class="w-full mb-7 bg-transparent border border-gray-300 rounded-md p-2 text-white" required><br>
                        @error('password')
                            <p class="text-red-500 text-lg italic">{{ $message }}</p>
                        @enderror

                        <div class="flex justify-center max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <button type="submit" class="sm:px-6 lg:px-8 border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white focus:outline-none">
                                保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
