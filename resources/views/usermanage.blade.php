<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ユーザ管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>ここはユーザ管理画面です</p>
                    @if (session('success'))
                        <div class="bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            {{ session('success') }}
                        </div>
                    @endif
                    @error('name')
                        <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror
                    @error('email')
                        <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror
                    @error('password')
                        <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror

                    <!-- ユーザーリスト -->
                    <div class="py-12">
                        <h2 class="text-xl font-semibold mb-4">ユーザーリスト</h2>
                        <table class="min-w-full w-full bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100 border-2 border-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                    <th class="text-center py-2 px-4 border-b">ID</th>
                                    <th class="text-center py-2 px-4 border-b">名前</th>
                                    <th class="text-center py-2 px-4 border-b">メールアドレス</th>
                                    <th class="text-center py-2 px-4 border-b">パスワード</th>
                                    <th class="text-center py-2 px-4 border-b">アクション</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($customer->isEmpty())
                                    <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-600 dark:text-gray-300">ユーザが存在しません</td>
                                    </tr>
                                @else
                                @foreach($customer as $customer)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $customer->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $customer->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $customer->email }}</td>
                                    <td class="py-2 px-4 border-b">{{ $customer->password }}</td>
                                    <td class=" pt-4 py-2 px-4 border-b">
                                        <a href="{{ route('customer.edit', ['id' => $customer->id]) }}" class="flex items-center my-2 border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white">
                                            編集
                                        </a>
                                    <form action="{{ route('customer.destroy', ['id' => $customer->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="m-2 border border-red-500 text-red-500 font-semibold py-1 px-2 rounded-lg hover:bg-red-500 hover:text-white">
                                            削除
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- 新規ユーザー追加フォーム -->
                    <h3 class="text-xl font-semibold mb-4">新規ユーザー追加</h3>
                    <form action="{{ route('customer.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <label for="name">名前</label><br>
                            <input type="text" name="name" placeholder="名前" class="mb-7 bg-transparent border border-gray-300 rounded-md p-2" required><br>

                            <label for="email">メールアドレス</label><br>
                            <input type="email" name="email" placeholder="メールアドレス" class="mb-7 bg-transparent border border-gray-300 rounded-md p-2" required><br>

                            <label for="password">パスワード</label><br>
                           <input type="password" name="password" placeholder="半角英数字のみ" class="mb-7 bg-transparent border border-gray-300 rounded-md p-2" required><br>

                            <label for="password_confirmation">パスワード(確認用)</label><br>
                            <input type="password" name="password_confirmation" placeholder="半角英数字のみ" class="mb-7 bg-transparent border border-gray-300 rounded-md p-2" required><br>

                            @error('password')
                                <p class="text-red-500 text-lg italic">{{ $message }}</p>
                            @enderror
                        </div>
    
                        <button type="submit" class="border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            ユーザーを追加
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
