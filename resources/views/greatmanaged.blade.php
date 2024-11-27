<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            偉人管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>ここは偉人管理ページです</p>

                    <!-- 成功メッセージ -->
                    @if (session('success'))
                        <div class="bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- エラーメッセージ -->
                    @error('year')
                        <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror
                    @error('lastyear')
                        <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror

                    <!-- 偉人リスト -->
                    <div class="py-12">
                        <h2 class="text-xl font-semibold mb-4">偉人リスト</h2>
                        <table class="min-w-full w-full bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100 border-2 border-gray-300 border-collapse">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                    <th class="text-center py-2 px-4 border-b">ID</th>
                                    <th class="text-center py-2 px-4 border-b">名前</th>
                                    <th class="text-center py-2 px-4 border-b">出生年</th>
                                    <th class="text-center py-2 px-4 border-b">亡年</th>
                                    <th class="text-center px-6 border-b">アクション</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($greatmanaged->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-600 dark:text-gray-300">データが存在しません</td>
                                </tr>
                            @else
                                    @foreach($greatmanaged as $managed)
                                        <tr class="bg-white dark:bg-gray-800">
                                            <td class="py-2 px-4 text-center border-b">{{ $managed->id }}</td>
                                            <td class="py-2 px-4 text-center border-b">{{ $managed->name }}</td>
                                            <td class="py-2 px-4 text-center border-b">{{ $managed->year }}</td>
                                            <td class="py-2 px-4 text-center border-b">{{ $managed->lastyear }}</td>
                                            <td class="py-6 border-b text-center">
                                                <a href="{{ route('greatmanaged.edit', ['id' => $managed->id]) }}" 
                                                   class="my-2 border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white">
                                                    編集
                                                </a>
                                                <form action="{{ route('greatmanaged.delete', ['id' => $managed->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('本当に削除しますか？');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="my-3 ml-2 border border-red-500 text-red-500 font-semibold py-1 px-2 rounded-lg hover:bg-red-500 hover:text-white">
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

                    <!-- 新規偉人追加フォーム -->
                    <h3 class="text-xl font-semibold mb-4">偉人追加</h3>
                    <form action="{{ route('greatmanaged.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <label for="name">名前</label>
                            <input type="text" name="name" placeholder="名前" 
                                   class="mb-7 bg-transparent border border-gray-300 rounded-md p-2" required>

                            <label for="year">出生年</label>
                            <input type="number" name="year" placeholder="数字のみ(~2025)" 
                                   class="mb-7 bg-transparent border border-gray-300 rounded-md p-2" max="2025" required>

                            <label for="lastyear">亡年</label>
                            <input type="number" name="lastyear" placeholder="数字のみ(~2025)" 
                                   class="mb-7 bg-transparent border border-gray-300 rounded-md p-2" max="2025" required>
                        </div>
                        <button type="submit" 
                                class="border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            追加する
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
