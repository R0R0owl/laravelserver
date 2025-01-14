<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectElement = document.getElementById('select-id');
            const promptElement = document.getElementById('data-prompt');
            const negativePromptElement = document.getElementById('data-negative_prompt');
            const stepsElement = document.getElementById('data-steps');

            const hiddenPrompt = document.getElementById('hidden-prompt');
            const hiddenNegativePrompt = document.getElementById('hidden-negative_prompt');
            const hiddenSteps = document.getElementById('hidden-steps');

            selectElement.addEventListener('change', (event) => {
                const selectedOption = event.target.options[event.target.selectedIndex];

                const prompt = selectedOption.getAttribute('data-prompt') || 'データなし';
                promptElement.textContent = prompt;
                hiddenPrompt.value = prompt;

                const negativePrompt = selectedOption.getAttribute('data-negative_prompt') || 'データなし';
                negativePromptElement.textContent = negativePrompt;
                hiddenNegativePrompt.value = negativePrompt;

                const steps = selectedOption.getAttribute('data-steps') || 'データなし';
                stepsElement.textContent = steps;
                hiddenSteps.value = steps;
            });
        });
    </script>

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
                        <form action="{{ route('image.store') }}" method="POST" class="py-8">
                            @csrf
                            <div class="mb-16">
                                <label for="prompt">プロンプトID</label><br>
                                <select name="id" id="select-id" class="border-2 bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100" required>
                                    <option value="0">IDを選択</option>
                                    @foreach($prompt as $item)
                                    <option value="{{ $item->id }}" data-prompt="{{ $item->prompt }}" data-negative_prompt="{{ $item->negative_prompt }}" data-steps="{{ $item->step }}">{{ $item->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- 非表示で値を保持 -->
                            <input type="hidden" name="selected_prompt" id="hidden-prompt" value="">
                            <input type="hidden" name="selected_negative_prompt" id="hidden-negative_prompt" value="">
                            <input type="hidden" name="selected_steps" id="hidden-steps" value="">

                            <!-- 取得したデータを下に表示 -->
                            <div class="mt-8 bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">選択されたデータ</h3>
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="flex items-center">
                                        <span class="font-semibold text-gray-600 dark:text-gray-300 w-1/4">プロンプト:</span>
                                        <span id="data-prompt" class="text-gray-900 dark:text-gray-100">選択されていません</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="font-semibold text-gray-600 dark:text-gray-300 w-1/4">ネガティブプロンプト:</span>
                                        <span id="data-negative_prompt" class="text-gray-900 dark:text-gray-100">選択されていません</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="font-semibold text-gray-600 dark:text-gray-300 w-1/4">ステップ数:</span>
                                        <span id="data-steps" class="text-gray-900 dark:text-gray-100">選択されていません</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="mt-16 border border-blue-500 text-blue-500 font-semibold py-2 px-4 rounded-lg hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                画像を生成する
                            </button>

                            @if ($errors->any())
                                <div class="mt-5 bg-red-500 text-white p-4 rounded-lg mb-6">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
