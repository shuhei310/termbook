<?php

class Model_Update extends Model
{
	/**
	 * 更新フォームに入力された値に用語データを更新する
	 * 用語データテーブルと関連データテーブルのデータを更新する
	 *
	 * @param  assoc $data
	 * @param  int   $id
	 * @return bool
	 * @update_reference_registration()
	 * @insert_reference_registration()
	 */
	public static function update_term_data($data, $id)
	{
		$query = DB::update('tb_term')
			->set(array(
			'meaning'      => $data['meaning'],
			'abbreviation' => $data['abbreviation'],
			'remarks'      => $data['remarks'],
			'update_date'  => date('Y-m-d H:i:s'),
		))
			->where('term_id', '=', $id);
		$result = $query->execute();
		if ($result) {
			$i = self::update_reference_registration($data, $id);
			self::insert_reference_registration($data, $i, $id);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 関連テーブルデータアップデート
	 * 関連テーブルから関連IDを用語IDを用いて取得し、その関連IDをアップデートする
	 *
	 * @param  assoc $data
	 * @param  int   $id
	 * @return int   $i
	 * @see get_reference_id()
	 */
	public static function update_reference_registration($data, $id)
	{
		$reference_ids = self::get_reference_id($id);
		$i             = 0;
		if ($reference_ids) {
			foreach ($reference_ids as $reference_id) {
				if (empty($data['reference' . $i])) {
					$data['reference' . $i] = null;
				}
				$query = DB::update('tb_reference')
					->set(array(
					'reference'   => $data['reference' . $i],
					'term_id'     => $id,
					'update_date' => date('Y-m-d H:i:s'),
				))
					->where('reference_id', $reference_id['reference_id']);
				$query->execute();
				++$i;
			}
		}
		return $i;
	}

	/**
	 * 関連テーブルデータインサート
	 * 関連テーブルから関連IDを用語IDを用いて取得した数以上フォームに入力されていた場合、データを挿入する
	 *
	 * @param  assoc $data
	 * @param  int   $i
	 * @param  int   $id
	 * @return bool
	 */
	public static function insert_reference_registration($data, $i, $id)
	{
		for ($j = $i; $j < 5; ++$j) {
			if ($data['reference' . $j]) {
				$query = DB::insert('tb_reference')
					->set(array(
					'reference'   => $data['reference' . $j],
					'term_id'     => $id,
					'create_date' => date('Y-m-d H:i:s'),
					'update_date' => date('Y-m-d H:i:s'),
				));
				if (!$query->execute()) {
					return false;
				}
			}
		}
		return true;
	}

	/**
	 * 登録されている参考URLの参考IDを取得
	 * 用語IDを用いて参考テーブルから参考IDを取得する
	 *
	 * @param  int   $id
	 * @return assoc
	 */
	public static function get_reference_id($id)
	{
		$query = DB::select('reference_id')
			->from('tb_reference')
			->where('term_id', '=', $id);
		return $query->execute()->as_array();
	}

	/**
	 * 用語IDから更新画面に必要なデータを取得する
	 * 用語IDを用いてDBからデータを取り出し、そのデータを整形する。失敗した場合、エラーを返す
	 *
	 * @param  int   $term_id
	 * @return assoc $terms
	 */
	public static function get_update_form($term_id)
	{
		if ($term_id) {
			$terms       = Model_Detail::get_term_data($term_id)[0];
			$terms_array = Model_Detail::get_term_data($term_id);
			if (!$terms) {
				throw new HttpInvalidINputException('不正な値が入力されました。');
			}
		} else {
			throw new HttpInvalidINputException('不正な遷移です。');
		}
		$reference_count = count($terms_array);
		for ($i = 0; $i < $reference_count; ++$i) {
			$terms['reference' . $i] = $terms_array[$i]['reference'];
		}
		return $terms;
	}

	/**
	 * 遷移が正しいかの確認と用語データの取得
	 * 更新ボタンが押された際、セッション情報が正しく遷移が正しいのか確認し、セッションの用語データを取得する
	 *
	 * @param  int   $term_id
	 * @return assoc $terms
	 */
	public static function check_update_form($term_id)
	{
		if ($term_id) {
			$terms = Model_Detail::get_term_data($term_id)[0];
			if (!$terms) {
				throw new HttpInvalidINputException('不正な値が入力されました。');
			}
		} else {
			throw new HttpInvalidINputException('不正な遷移です。');
		}
		return $terms;
	}
}
