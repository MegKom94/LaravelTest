<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <title></title>
  <h2>Главная страница</h2>
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <form name="create" method="POST" action="/create">
    @csrf
    <h3>Раздел</h3>
    <div class="form-group col-md-6">
      <input type="text" name='title' placeholder="Раздел">
    </div>
    <h3>Описание</h3>
    <div>
      <input type="text" name='description' placeholder="Описание">
    </div>
    <!-- <div>
      <input type="number" name='weight' placeholder="Вес">
    </div>
    <div>
      <input type="text" name='answer' placeholder="Варианты ответов">
    </div> -->
    <div>
      <input type="checkbox" name="radio1" value="Radio button">
      <span class="replyspan">Опрос для всех(включая не авторизованных)</span>
    </div>
    <div>
      <input type="checkbox" name="radio2" value='1'>
      <span class="replyspan">Опрос для учащихся</span>
    </div>
    <div>
      <input type="checkbox" name="radio3" value='1'>
      <span class="replyspan">Опрос для сотрудников</span>
    </div>
    <div>
      <input type="checkbox" name="radio4" value="1">
      <span class="replyspan">Опрос с привязкой к предметам и преподавателям</span>
    </div>
    <input type="submit" name='submit' value="Сохранить">
  </form>
</body>

</html>