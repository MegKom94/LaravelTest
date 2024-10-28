<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <title></title>
  <h1>главная страница</h1>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  
  @foreach($result as $header)
    <h3>{{$header->title}}</h3>
      @foreach ($header->forms as $form)
          <div>{{$form->text}}</div>
          @foreach ($form->answers as $answer)
            <h5>{{$answer->text}}</h5>
          @endforeach
      @endforeach
  @endforeach

</body>

</html>