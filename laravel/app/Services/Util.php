<?php
namespace App\Services;

class Util
{

    public static function ua_app()
    {
		//ユーザーエージェントを取得
		$ua = $_SERVER['HTTP_USER_AGENT'];
		//スマホと判定する文字リスト
		$ua_list = array('IosApp');
		foreach ($ua_list as $ua_smt) {
			//ユーザーエージェントに文字リストの単語を含む場合はTRUE、それ以外はFALSE
			if (strpos($ua, $ua_smt) !== false) {
				return true;
			}
		} return false;
    }


}
