<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            画像(AI)生成
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>ここはAI画像生成画面です</p>

                    <div class="p-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2 class="text-xl font-semibold mb-4">使用するプロンプトを選択</h2>
                        <form action="{{ route('prompts.store') }}" method="POST" class="py-8">
                            @csrf
                            <div class="mb-16">
                                <label for="prompt">プロンプトID</label><br>
                                <select name="id" id="promptid" class="border-2 bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100 " required>
                                    <option value="0">IDを選択</option>
                                    @foreach($prompt as $prompt)
                                        <!-- valueを$prompt->idに変更 -->
                                        <option value="{{ $prompt->id }}">{{ $prompt->id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 取得したデータを下に表示 -->
                            <div class="mt-8" id="selected-data" data-prompt-id="{{ $prompt->id }}">
                                <h3>選択されたデータ</h3>
                                
                            </div>

                            <button type="submit" class="mt-16 border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                画像を生成する
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('promptid').addEventListener('change', function() {
            var promptId = this.value;

            // AJAXリクエストを送信
            fetch(`/dashboad/image/${promptId}`)
                .then(response => response.json())
                .then(data => {
                    // 取得したデータを表示
                    if (data && !data.error) {
                        document.getElementById('selected-data').innerHTML = `
                            <h3>選択されたデータ</h3>
                            <p>ID: ${data.id}</p>
                            <p>ステップ数: ${data.steps}</p>
                            <p>その他の情報: ${data.other_info}</p>  <!-- 例えば、'other_info'がプロンプトに関連するデータの場合 -->
                        `;
                    } else {
                        document.getElementById('selected-data').innerHTML = `<p>データが見つかりませんでした。</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('selected-data').innerHTML = `<p>エラーが発生しました。</p>`;
                });
        });
    </script>
    
</x-app-layout>
