<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            プロンプト編集
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
            <form action="{{ route('prompts.update', ['id' => $prompt->id]) }}" method="POST" class="lg:px-8 max-w-7xl sm:px-6 mx-auto dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @csrf
                @method('PUT')

                <!-- プロンプト -->
                <div class="mb-4 p-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <label for="prompt" class="text-white text-xl block text-gray-700 text-sm font-bold mb-2">プロンプト:</label>
                    <textarea name="prompt" id="prompt" cols="75" rows="5"
                        class="bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100" required>{{ old('prompt', $prompt->prompt) }}</textarea>
                    @error('prompt')
                    <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ネガティブプロンプト -->
                <div class="mb-4 p-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <label for="negative_prompt" class="text-white text-xl block text-gray-700 text-sm font-bold mb-2">ネガティブプロンプト:</label>
                    <textarea name="negative_prompt" id="negative_prompt" cols="75" rows="5"
                        class="bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100">{{ old('negative_prompt', $prompt->negative_prompt) }}</textarea>
                    @error('negative_prompt')
                    <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ステップ数 -->
                <div class="mb-4 p-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <label for="step_count" class="text-white text-xl block text-gray-700 text-sm font-bold mb-2">ステップ数:</label>
                    <input type="number" name="step_count" id="step_count" value="{{ old('step_count', $prompt->step) }}"
                        class="bg-blue-200 text-gray-900 dark:bg-gray-800 dark:text-gray-100" min="1" max="1000" required>
                    @error('step_count')
                    <p class="text-red-500 text-lg italic">{{ $message }}</p>
                    @enderror
                </div>
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
