<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Worktest - Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="w-50">
        <p>You will be gettings questions in pairs of 3. For each page you need to answere all the questions before you can
            goto the next page.

            Good luck!
        </p>
        <form method="get" action="quiz.php">
            <input name="quiz" value="1" hidden>
            <button type="submit" class="btn-primary">Start Quiz</button>
        </form>
    </div>
</div>
</body>
</html>