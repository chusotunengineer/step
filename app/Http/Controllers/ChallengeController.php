<?php

namespace App\Http\Controllers;

use App\User;
use App\Step;
use App\ChildStep;
use App\Challenge;

use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    // チャレンジページのviewと表示する子ステップ、子ステップ情報を返す
    public function challenge(){

        $id = $_GET['id'];
        $user_id = Auth::id();
        $step = Step::find($id);
        $challenge = Challenge::where('user_id', $user_id)->where('step_id', $id)->first();

        // もし現在のステップを示す$currentがなければ、まだクリアしていない直近の子ステップを、$currentがあればその子ステップを表示
        // ただし、クリアしていない子ステップは見られないように、進捗よりも先の子ステップが指定されていたら未指定でリダイレクトする（まだクリアしていない直近の子ステップが表示される）
        $current = (isset($_GET['current']) ? $_GET['current'] : $challenge['progress']);
        if($current > $challenge['progress']){
            return redirect('/steps/challenge?id='.$id);
            exit;
        }
        return view('challenge', compact('id', 'current', 'step'));
    }

    // チャレンジする親ステップ情報、子ステップ情報、現在の進捗情報を返す
    public function challengeAjax(){
        $id = $_GET['id'];
        $user_id = Auth::id();
        $step = Step::find($id);
        $child_step = ChildStep::where('parent_id', $id)->get();
        $challenge = Challenge::where('user_id', $user_id)->where('step_id', $id)->first();

        // 進捗がDBに保存されいればそれを、されていなければ0を変数に格納
        $progress = ($challenge['progress'] ? $challenge['progress'] : 0);
        // 親ステップの名前、子ステップの個数、進捗、子ステップ情報を配列に格納
        $res = array('title' => $step['name'], 'num' => $step['child_num'], 'progress' => $progress, 'childStep' => $child_step);

        return response()->json($res);
    }

    // 進捗を更新する
    public function clear(){
        // GETパラメータの情報とログインユーザー情報をもとに、進捗更新用の配列を作成
        $user_id = Auth::id();
        $step_id = $_GET['id'];
        $progress = $_GET['progress'] + 1;
        $record = array('user_id' => $user_id, 'step_id' => $step_id, 'progress' => $progress);

        // Challengeレコードを検索して、ユーザーIDとステップIDが一致するレコードがなければ新規作成する
        // レコードがあり、$progressの値がDBに保存されている値より大きければ更新する
        $challenge = Challenge::where('user_id', $user_id)->where('step_id', $step_id)->first();
        if(!$challenge){
            Challenge::create($record);
            return redirect('/steps/challenge?id='.$step_id);
            exit;
        }elseif($progress > $challenge['progress']){
            $challenge->fill($record)->save();
            return redirect('/steps/challenge?id='.$step_id);
            exit;
        }

        return redirect('/steps/challenge?id='.$step_id.'&current='.$progress);
    }

    // ステップの進捗を削除して、再挑戦する
    public function reset(){
        $user_id = Auth::id();
        $step_id = $_GET['id'];

        // ユーザーIDとステップIDが一致するレコードを削除
        Challenge::where('user_id', $user_id)->where('step_id', $step_id)->delete();

        return redirect('/steps/challenge?id='.$step_id);
    }

    // マイページで挑戦中のステップを表示するために挑戦中のステップ情報を返す
    public function challengeStep(){
        $user_id = Auth::id();
        $challenges = Challenge::where('user_id', $user_id)->get();

        $challenge_res = [];
        $steps = [];

        // 挑戦中のステップを1つずつ検索して、全ての子ステップをクリアしていない（挑戦中の）ステップだけを配列に格納
        foreach($challenges as $record){
            $step = Step::find($record['step_id']);
            if($step['child_num'] !== $record['progress']){
                array_push($steps, $step);
                array_push($challenge_res, $record);
            }
        }
        return response()->json(array('steps' => $steps, 'challenges' => $challenge_res));
    }
}
