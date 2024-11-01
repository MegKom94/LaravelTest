<?php
namespace App\Http\Controllers;

use DB;
use App\Models\Form;
use App\Models\FormType;
use App\Models\FormAnswer;

class AdminController extends Controller
{
    public function index()
    {
        //$result = Form::where('id', '=',10)->count();
        //$result = Form::findOrFail(1,['text', 'weight']);

        // foreach ($result as $key => $value) {
        //     echo $result[$key]["text"];
        // }

        // $result = Form::select('forms_types.title','forms_answers.text')
        //                 ->join('forms_types','forms.id_type','=','forms_types.id')
        //                 ->join('forms_answers','forms_answers.id_form','=','forms.id')
        //                 ->get();
        // print_r($result[1]->title.' '.$result[1]->text);
        //$result = Form::select('form_type:title','answer:text')->with('form_type','answer')->get()->toArray();

        //код в блейд<!-- @foreach($result as $header)
//     <h3>{{$header->title}}</h3>
//     @foreach ($header->forms as $form)
//         <div>{{$form->text}}</div>
//         @foreach ($form->answers as $answer)
//           <h5>{{$answer->text}}</h5>
//         @endforeach
//     @endforeach
// @endforeach
// action="FormTypeController.php" -->


        //With() предназначен для быстрой загрузки
        //это означает, что в рамках основной модели Laravel предварительно загрузит указанные вами отношения.
        //при быстрой загрузке вы запускаете только один дополнительный запрос к БД вместо одного для каждой модели в коллекции
        //$result = FormType::with('forms', 'forms.answers')->get();
        //return view('home')->with('result', $result);

        // $array = [
        //     'titles' => (DB::table('forms_types')->where('id','=', '2')->take(1)->get(['id', 'title'])),
        //     'questions' => (DB::table('forms')->take(1)->get(['id', 'id_type', 'text'])),
        //     'answers' => (DB::table('forms_answers')->take(1)->get(['id_form', 'text']))
        // ];
        $id = 3;
        $questions = (DB::table('forms')->where('id_type', '=', $id)->get(['id', 'id_type', 'text']));
        $questions_array = $questions->toArray();
        $res = [];
        foreach ($questions_array as $question) {
            //foreach((array)$question as $key => $value) {
            // print_r( $value);
            // }
            array_push($res, $question->id);
            //var_dump($res);
        }
        //dd($questions_array);

        $array = [
            'titles' => (DB::table('forms_types')->where('id', '=', $id)->get(['id', 'title'])),
            'questions' => $questions,
            'answers' => (DB::table('forms_answers')->whereIn('id_form', $res)->get(['id_form', 'text']))
        ];


        // echo '<pre>';
        // var_dump($array);
        // echo '</pre>';
        return view('home');

    }

    public function getViewRequest()
    {
        $result = FormType::with('forms', 'forms.answers')->get();
        return view('home')->with('result', $result);
    }
    //in id заголовка
    //out результат запроса список заголовков в бд по условию id
    public function getTitles($id)
    {
        return DB::table('forms_types')->where('id', '=', $id)->get(['id', 'title']);
    }

}