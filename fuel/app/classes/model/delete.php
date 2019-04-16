<?php

class Model_Delete extends Model
{
	/**
	 * 指定した用語IDの削除フラグを立てる
	 * tb_termの指定したterm_idのdel_flagを立てる
	 *
	 * @param  string $id
	 * @return bool
	 */
	public static function set_del_flg($id)
	{
		$query = DB::update('tb_term')
			->set(array(
			'del_flg' => 1,
		))
			->where('term_id', '=', $id);
		return $query->execute();
	}
}
