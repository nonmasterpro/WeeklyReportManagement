<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $question = Question::all();

        return view('question.index',['questions' => $question]);
    }
public function CalCoin(){

  return $ids = Auth::id();

  // $CoinUser = User::find($ids) with-> Question::$UserQId;



}


    public function indexid()
    {

        $ids = Auth::id();
        $ids = explode(",", $ids);
        $question = array();
        foreach($ids as $id) {
        $q = question::where('UserQId', $id)->get();
            // if(!is_null($q['questions'])) {
                // $question = array_merge($question, $q['questions']->toArray());
            // }
        }
        return view('question.indexid', ['questions' => $q]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validator
        // $this->validate($request,[
        //   'title'=>'require',
        //   'discription' => 'require',
        //   'Qcoin' => 'require',
        // ]);

        $titles = $request -> title;
        $discriptions = $request -> discription;
        $Qcoins = $request -> Qcoin;
        $UserQIds = $request -> UserQId;

        $userCoin= Auth::user()->coin;
        $result = $userCoin - $Qcoins;
        // return $result;

        $id = Auth::id();

        // return ($id);

        $questions = new question;

        $questions->title = $titles;
        $questions->discription = $discriptions;
        $questions->Qcoin = $Qcoins;
        $questions->UserQId = $id;

        $User = Auth::user();
        $User->coin = $result;

        $User->save();
        $questions->save();

        return redirect()->route('question.index')->with('alert-success','Data Hasbeen Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $u = Auth::user();
      $ids = $id;
      $ids = explode(",", $ids);

      foreach($ids as $i) {
      $q = answer::where('QId', $i)->get();
      }

      // ///////
      //       $idu = Auth::id();
      //
      //       $answers = $request -> answer;
      //
      //       $ans = new answer;
      //
      //       $ans->answer = $answers;
      //       $ans->UserId = $idu;
      //       $ans->QId = $id;
      //
      //       $ans->save();
      // ///////


      return view('question.show', ['questions' => question::findOrFail($id)],
                                   ['answers' => $q]);

    }

    public function createAns($id)
    {
        return view('question.answer', ['aaaa' => $id]);
    }

    public function storeAns(Request $request,$id)
    {
      ///////
            $idu = Auth::id();

          return  $answerss = $request -> answer;

            $ans = new answer;

            $ans->answer = $answerss;
            $ans->UserId = $idu;
            $ans->QId = $id;

            $ans->save();
      ///////

      return redirect()->route('question.show')->with('alert-success','Data Hasbeen Saved');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $question = Question::findOrFail($id);



        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // return ($id);
          $titles = $request -> title;
          $discriptions = $request -> discription;
          $Qcoins = $request -> Qcoin;
          $UserQIds = $request -> UserQId;
          // $idu = Auth::id();

          $question = Question::findOrFail($id);

          $question->title = $titles;
          $question->discription = $discriptions;
          $question->Qcoin = $Qcoins;
          // $question->UserQId = $idu;
          $question->save();

          // return view('question.indexid');

          return redirect()->route('question.index')->with('alert-success','Data Hasbeen Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $questions = Question::findOrFail($id);
        $questions->delete();
        return redirect()->route('question.index')->with('alert-success','Data Hasbeen Saved');

    }
}
