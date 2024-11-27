<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            プロンプト管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>ここはプロンプト管理ページです</p><br>
                    @if (session('success'))
                        <div class="bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            {{ session('success') }}
                        </div>
                    @endif
                    @error('prompt')
                        <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror
                    @error('negative_prompt')
                        <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror

                    <!-- プロンプト一覧 -->
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="text-gray-900 dark:text-gray-100">
                                    <h2 class="text-xl font-semibold mb-4">プロンプト一覧</h2>
                                    <table class="min-w-full w-full bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100 border-2 border-gray-300 border-collapse">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                                <th class="text-center px-6 border-b">ID</th>
                                                <th class="text-center px-6 border-b">プロンプト</th>
                                                <th class="text-center px-6 border-b">ネガティブプロンプト</th>
                                                <th class="text-center px-6 border-b">ステップ</th>
                                                <th class="text-center px-6 border-b">アクション</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($prompt->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-gray-600 dark:text-gray-300">プロンプトがありません</td>
                                                </tr>
                                            @else
                                                @foreach($prompt as $prompt)
                                                    <tr class="bg-white dark:bg-gray-800">
                                                        <td class="py-6 px-6 border-b text-center">{{ $prompt->id }}</td>
                                                        <td class="py-6 px-6 border-b text-center">{{ $prompt->prompt }}</td>
                                                        <td class="py-6 px-6 border-b text-center">{{ $prompt->negative_prompt }}</td>
                                                        <td class="py-6 px-6 border-b text-center">{{ $prompt->step }}</td>
                                                        <td class="py-6 border-b text-center">
                                                            <a href="{{ route('prompts.edit', ['id' => $prompt->id]) }}" class="my-2 border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white">
                                                                編集
                                                            </a>
                                                            <form action="{{ route('prompts.destroy', ['id' => $prompt->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('本当に削除しますか？');">
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
                            </div>
                        </div>
                    </div>

                    <!-- 新規プロンプト作成フォーム -->
                    <div class="p-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2 class="text-xl font-semibold mb-4">プロンプト新規作成</h2>
                        <form action="{{ route('prompts.store') }}" method="POST">
                            @csrf
                            <label for="prompt">プロンプトを入力してください</label><br>
                            <textarea class="border-2 min-w-full w-full bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100" name="prompt" id="prompt" cols="75" rows="10"></textarea><br>

                            <label for="negative_prompt">ネガティブプロンプトを入力してください</label><br>
                            <textarea class="border-2 min-w-full w-full bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100" name="negative_prompt" id="negative_prompt" cols="75" rows="10"></textarea><br>

                            <label for="steps">ステップ数を入力してください(20~50):</label>
                            <input type="number" class="border-2 bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100" id="steps" name="steps" min="20" max="50" value="20" required><br>
                            @error('steps')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror

                            <button type="submit" class="border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                プロンプトセットアップを作成する
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
