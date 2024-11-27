<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>プロンプトテストページ</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <main>
  <form action="/generate-image" method="POST">
        @csrf
        <label for="prompt">Enter a prompt:</label><br>
        <!-- <input type="text" id="prompt" name="prompt" rows="10" required><br> -->
        <textarea name="prompt" id="prompt" cols="75" rows="10"></textarea><br>
        <label for="negative_prompt">Enter a negative_prompt:</label><br>
        <!-- <input type="text" id="negative_prompt" name="negative_prompt" required><br> -->
        <textarea name="negative_prompt" id="negative_prompt" cols="75" rows="10"></textarea><br>
        <label for="prompt">Enter a steps:</label>
        <input type="number" id="steps" name="steps" min="20" max="50" value="20" required><br>
        <button type="submit">create prompt setup</button>
    </form>
  </main>
</body>
</html>