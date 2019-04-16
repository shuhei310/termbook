<?php

class Model_Register extends Model
{
	/**
	 * 登録フォームに入力された値をDBにセットする
	 * 用語データテーブルと関連データテーブルにデータを入れる
	 *
	 * @param  assoc $data
	 * @return bool  処理判定
	 * @see set_reference()
	 */
	public static function set_term_data($data)
	{
		$query = DB::insert('tb_term')
			->set(array(
			'term_name'    => $data['term_name'],
			'meaning'      => $data['meaning'],
			'abbreviation' => $data['abbreviation'],
			'remarks'      => $data['remarks'],
			'create_date'  => date('Y-m-d H:i:s'),
			'update_date'  => date('Y-m-d H:i:s'),
		));
		$result = $query->execute();
		if ($result) {
			self::set_reference($data, $result[0]);
			return true;
		} else {
			return false;
		}
	}

	// tb_referenceにデータを入れる機能

	/**
	 * 登録フォームに入力された値をDBにセットする
	 * 用語データテーブルと関連データテーブルにデータを入れる
	 *
	 * @param  assoc  $data
	 * @param  string $term_id
	 * @return bool
	 */
	public static function set_reference($data, $term_id)
	{
		for ($i = 0; $i < 5; ++$i) {
			if ($data['reference' . $i]) {
				$query = DB::insert('tb_reference')
					->set(array(
					'reference'   => $data['reference' . $i],
					'term_id'     => $term_id,
					'create_date' => date('Y-m-d H:i:s'),
					'update_date' => date('Y-m-d H:i:s'),
				));
				if (!$query->execute()) {
					return false;
				}
			}
		}
	}
}
