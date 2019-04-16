<?php

class Model_List extends Model
{
	/**
	 * 用語一覧のデータ取得
	 * keyにソートのキーにしたいカラム名 orderにdescまたはascで順序選択
	 *
	 * @param  string $key
	 * @param  string $order
	 * @return assoc
	 */
	public static function get_query_sort($key, $order)
	{
		$query = DB::select('term_id', 'term_name', 'meaning', 'abbreviation', 'del_flg', 'update_date')
			->from('tb_term')
			->where('del_flg', '=', 0)
			->order_by($key, $order);

		return $query->execute()->as_array();
	}

	/**
	 * 完全一致検索をする機能
	 * 用語名と略語に対して完全一致検索を行う
	 *
	 * @param  string $word
	 * @return assco
	 */
	public static function get_query_perfect_search($word)
	{
		$query = DB::select('term_id', 'term_name', 'meaning', 'abbreviation', 'del_flg', 'update_date')
			->from('tb_term')
			->where_open()
			->where('term_name', 'like', $word)
			->or_where('abbreviation', 'like', $word)
			->where_close()
			->and_where('del_flg', '=', 0)
			->order_by('update_date', 'desc');

		return $query->execute()->as_array();
	}

	/**
	 * 部分一致検索をする機能
	 * 用語名と略語、意味に対して部分一致検索を行う
	 *
	 * @param  string $word
	 * @return assoc
	 */
	public static function get_query_partial_search($word)
	{
		$query = DB::select()->from('tb_term')
			->where_open()
			->where('term_name', 'like', '%' . $word . '%')
			->or_where('meaning', 'like', '%' . $word . '%')
			->or_where('abbreviation', 'like', '%' . $word . '%')
			->where_close()
			->and_where('del_flg', '=', 0)
			->order_by('update_date', 'desc');

		return $query->execute()->as_array();
	}

	/**
	 * ソートボタンで送られているgetの値が正しいか判断
	 * ソート項目は更新日時、登録日時、文字列のみなのでそれ以外のに変えられていた場合のエラー処理
	 *
	 * @param  string $key
	 * @return bool
	 * @todo ソートの項目を決めるのにGETを使っているが、POSTにした方がよい
	 */
	public static function check_get_sort($key)
	{
		if ($key !== 'update_date' && $key !== 'create_date' && $key !== 'term_name') {
			return false;
		}
		return true;
	}
}
