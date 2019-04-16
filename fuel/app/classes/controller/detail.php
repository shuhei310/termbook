<?php

class Controller_Detail extends Controller_Template
{
	public function action_index()
	{
		$this->template->title = '用語詳細';
		$term_id               = Input::get('term_id');
		if ($term_id) {
			$data['term_data'] = Model_Detail::get_term_data($term_id);
			if (!$data['term_data']) {
				throw new HttpInvalidINputException('不正な値が入力されました。');
			}
		} else {
			throw new HttpInvalidINputException('不正な遷移です。');
		}
		// 更新用のデータをセッションに代入
		Session::set('term_id', $term_id);
		$data['reference_count']      = Model_Detail::count_reference_null($data['term_data']);
		$this->template->button_path  = '/list';
		$this->template->button_value = '一覧に戻る';
		$this->template->content      = View::forge('detail/index', $data);
	}
}
