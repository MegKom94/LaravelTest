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
        //$result = DB::table("forms")->get();//все записи таблицы
        //$result = DB::table("forms")->pluck('text');//записи одного стобца из таблицы
        //$result = DB::table('forms')->select('text','date_create');//help!
        //$result = DB::table("forms")->join("forms_types","","=","")
        //dd($result);

        //$result = Form::where('id', '=',10)->count();
        //$result = Form::findOrFail(1,['text', 'weight']);
        // $result= Form::select("text","weight")->get();

        // foreach ($result as $key => $value) {

        //     echo $result[$key]["text"];
        // }

        // $result = Form::select('forms_types.title','forms_answers.text')
        //                 ->join('forms_types','forms.id_type','=','forms_types.id')
        //                 ->join('forms_answers','forms_answers.id_form','=','forms.id')
        //                 ->get();
        //     //dd($result);
        //    //print_r($result[1]);
        //    print_r($result[1]->title.' '.$result[1]->text);
        // $result = Form::select()->with('form_type','answer')->get()->toArray();
        //$result = Form::select('form_type:title','answer:text')->with('form_type','answer')->get()->toArray();

        //With() предназначен для быстрой загрузки
        //это означает, что в рамках основной модели Laravel предварительно загрузит указанные вами отношения.
        //при быстрой загрузке вы запускаете только один дополнительный запрос к БД вместо одного для каждой модели в коллекции
        $result = FormType::with('forms', 'forms.answers')->get();
        //dd($result[1]->toArray());
        //return view('home')->with('result', $result);
        //$titles = DB::table('forms_types')->get(['id','title']);
        // $questions = DB::table('forms')->get(['id','id_type','text']);
        // $answers = DB::table('forms_answers')->get(['id_form','text']);
        
        //dd($titles);
        // $array = [
        //     'titles' => (DB::table('forms_types')->where('id','=', '2')->take(1)->get(['id', 'title'])),
        //     'questions' => (DB::table('forms')->take(1)->get(['id', 'id_type', 'text'])),
        //     'answers' => (DB::table('forms_answers')->take(1)->get(['id_form', 'text']))
        // ];
        $id=2;
        $questions=(DB::table('forms')->where('id_type','=', $id)->get(['id', 'id_type', 'text']));
        $array = [
            'titles' => (DB::table('forms_types')->where('id','=', $id)->get(['id', 'title'])),
            'questions' => $questions,
            'answers' => (DB::table('forms_answers')->get(['id_form', 'text']))
        ];

        echo '<pre>';
        var_dump($array);
        echo '</pre>';
    }
    
    public function getViewRequest(){
        $result = FormType::with('forms', 'forms.answers')->get();
        return view('home')->with('result', $result);
    }
    //in id заголовка
    //out результат запроса список заголовков в бд по условию id
    public function getTitles($id){
        return DB::table('forms_types')->where('id','=', $id)->get(['id', 'title']);
    }
    //in id заголовка
    //out результат запроса на список вопросов в бд по условию id_type = id(заголовок)
    public function getQuestions($id){
        return Form::with()->where('id_type','=', $id)->get(['id', 'id_type', 'text']);
    }
    //in id вопроса
    //out результат запроса на список ответа к вопросу по условию 
    public function getAnswers($id){
        return DB::table('forms_answers')->where('id_form','=', $id)->get(['id_form', 'text']);
    }
}